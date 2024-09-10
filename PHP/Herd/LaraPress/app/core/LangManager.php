<?php

namespace App\Core;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

//TODO: rename to languageManager
class LangManager
{
    /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $disk;

    /**
     * Path to the language files.
     *
     * @var string
     */
    private $languageFilesPath;

    /**
     * Paths we will look inside to find translations.
     *
     * @var array
     */
    private $lookupPaths;

    /**
     * Available translations.
     *
     * @var array
     */
    private $translations = [];

    private $app_locales = [];

    private $locales_by_code=[];

    /**
     * Manager constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $disk
     * @param string $languageFilesPath
     * @param array $lookupPaths
     */
    public function __construct(Filesystem $disk, $languageFilesPath, array $lookupPaths)
    {
        $this->disk = $disk;
        $this->languageFilesPath = $languageFilesPath;
        $this->lookupPaths = $lookupPaths;
    }

    /**
     * Get all the available lines that have been translated.
     * NOTE: These are already saved as $lang.json files
     * so we just read what is in the files into array:
     * [
     *   '$locale1' => ['original text' : 'translation1'],
     *   '$locale2' => ['original text' : 'translation2'],
     *   '$locale3' => ['original text' : 'translation3'],
     * 
     * ]
     * locale1,2,3 like 'ar', 'es', 'fr'...
     * this shows only the lines with translations in the array
     *
     * @param bool $reload
     * @return array
     */
    public function getExistingTranslationsFromLanguageJsonFiles($reload = false)
    {
        if ($this->translations && ! $reload) {
            return $this->translations;
        }

        collect($this->disk->allFiles($this->languageFilesPath))
            ->filter(function ($file) {
                return $this->disk->extension($file) == 'json';
            })
            ->each(function ($file) {
                $this->translations[str_replace('.json', '', $file->getFilename())]
                    = json_decode($file->getContents());
            });

        return $this->translations;
    }

    /**
     * Get all the  lines that have not been translated.
     * an array of all the lines with no translations
     */
    public function getOnlyNotTranslated()
    {
        $output = [];
        $translations = $this->getExistingTranslationsFromLanguageJsonFiles();

        //$keysFromFiles = array_unique(Arr::collapse($this->getAllTranslationLinesFromSourceFiles()));
        $keysFromFiles = $this->getOnlyUniqueTranslationLinesFromSourceFiles();
        foreach ($keysFromFiles as $index => $key) {
            foreach ($translations as $lang => $keys) {
                // Ensure $keys is an array
                if (is_object($keys)) {
                    $keys = (array) $keys;
                }
                if (! array_key_exists($key, $keys)) {
                    $output[] = $key;
                }
            }
        }
        return array_values(array_unique($output));
    }

    /**
     * Get all the localizable __() lines from files.
     * This will get ALL lines, regardless whether translated or not
     * But will not show duplicate values (unique ones only)
     */
    public function getOnlyUniqueTranslationLinesFromSourceFiles()
    {
        $keysFromFiles = array_values(array_unique(Arr::collapse($this->getAllTranslationLinesFromSourceFiles())));
        return $keysFromFiles;
    }

    /**
     * List all translations with their locales
     * [
     *  'text1': [  'ar'->'',
     *              'es'->''
	 *  	        'fr'->'']
     *  'text2':[   'ar'->'',
     *              'es'->''
	 *  	        'fr'->'']
    *   ]
     *
     * @return array
     */
    public function getAllTranslationsWithLocales($locales, $default_locale)
    {
        $output = [];

        //make sure to exclude default_locale from the given array
        $translation_locales = array_diff($locales, [$default_locale]);
        
        //get all existing translations
        $translations = $this->getExistingTranslationsFromLanguageJsonFiles();

        $keysFromFiles = array_unique(Arr::collapse($this->getAllTranslationLinesFromSourceFiles()));
        
        $newIndex = 0;
        foreach ($keysFromFiles as  $key) {
            $output[$newIndex]['#'] = ++$newIndex;
            foreach($translation_locales as $locale){
                $output[$newIndex][$default_locale]=$key; //initialize an empty slot
                $output[$newIndex][$locale]=''; //initialize an empty slot
            }
            //Find existing translation
            foreach ($translations as $lang => $keys) {
                // Ensure $keys is an array
                if (is_object($keys)) {
                    $keys = (array) $keys;
                }
                if (array_key_exists($key, $keys)) {
                    $output[$newIndex][$lang] = $keys[ $key ];  //get the translation
                }
                else{
                    $output[$newIndex][$lang] = '';  //no translation, just blank
                }
            }
        }

        //reindex the array
        //return array_values($output);
        //make it start from 1
        //return array_combine(range(1, count($output)), $output);
        return $output;
    }

    /**
     * Save the given translations.
     *
     * @param $translations
     */
    public function saveTranslations($translations)
    {
        $this->backup();

        foreach ($translations as $lang => $lines) {
            $filename = $this->languageFilesPath . DIRECTORY_SEPARATOR . "$lang.json";

            ksort($lines);

            file_put_contents($filename, json_encode($lines, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }

    /**
     * Add a new JSON language file.
     *
     * @param $language
     */
    public function addLanguage($language)
    {
        $this->backup();

        file_put_contents(
            $this->languageFilesPath . DIRECTORY_SEPARATOR . "$language.json",
            json_encode((object) [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
    }


    /**
     * Get found translation lines found per file.
     *
     * @return array
     */
    private function getAllTranslationLinesFromSourceFiles()
    {
        /*
         * This pattern is derived from Barryvdh\TranslationManager by Barry vd. Heuvel <barryvdh@gmail.com>
         *
         * https://github.com/barryvdh/laravel-translation-manager/blob/master/src/Manager.php
         */
        $functions =  ['__'];

        $pattern =
            // See https://regex101.com/r/jS5fX0/5
            '[^\w]' . // Must not start with any alphanum or _
            '(?<!->)' . // Must not start with ->
            '(' . implode('|', $functions) . ')' . // Must start with one of the functions
            "\(" . // Match opening parentheses
            "[\'\"]" . // Match " or '
            '(' . // Start a new group to match:
            '.+' . // Must start with group
            ')' . // Close group
            "[\'\"]" . // Closing quote
            "[\),]"  // Close parentheses or new parameter
        ;

        $allMatches = [];

        foreach ($this->lookupPaths as $path){
            foreach ($this->disk->allFiles($path) as $file) {
                if (preg_match_all("/$pattern/siU", $file->getContents(), $matches)) {
                    $allMatches[$file->getRelativePathname()] = $matches[2];
                }
            }
        }
        return $allMatches;
    }

    /**
     * Backup the existing translation files
     */
    private function backup()
    {
        if (! $this->disk->exists(storage_path('LangBackup'))) {
            $this->disk->makeDirectory(storage_path('LangBackup'));

            $this->disk->put(storage_path('LangBackup' . '/.gitignore'), "*\n!.gitignore");
        }

        $this->disk->copyDirectory(resource_path('lang'), storage_path('LangBackup/' . time()));
    }

    public function getAppLocales()
    {
        return $this->app_locales;
    }

    public function setAppLocales($localesArray)
    {
        $this->app_locales = $localesArray;
    }

    public function getLocaleName($locales)
    {
        //TODO: switch this code to a hard-coded array since it
        // is always fixed
        if (!count($this->locales_by_code)){
            $allLocales = $this->getLocalesArray();

            foreach ($allLocales as $element) {
                $this->locales_by_code[$element['id']] = $element['name'];
            }
        }

        $names=[];
        foreach ($locales as $locale)
        {
            if (array_key_exists($locale, $this->locales_by_code)){
                $names[$locale] = $this->locales_by_code[$locale];
            }
        }
        return $names;
    }

    public function getLocalesArray()
    {
        //TODO: move the array to a separate file 
        //Shortened list
        return [
            ['id' => "af", 'name' => "Afrikaans"],
            ['id' => "ak", 'name' => "Akan"],
            ['id' => "sq", 'name' => "Albanian"],
            ['id' => "am", 'name' => "Amharic"],
            ['id' => "ar", 'name' => "Arabic"],
            ['id' => "hy", 'name' => "Armenian"],
            ['id' => "as", 'name' => "Assamese"],
            ['id' => "asa", 'name' => "Asu"],
            ['id' => "az", 'name' => "Azerbaijani"],
            ['id' => "bm", 'name' => "Bambara"],
            ['id' => "eu", 'name' => "Basque"],
            ['id' => "be", 'name' => "Belarusian"],
            ['id' => "bem", 'name' => "Bemba"],
            ['id' => "bez", 'name' => "Bena"],
            ['id' => "bn", 'name' => "Bengali"],
            ['id' => "bs", 'name' => "Bosnian"],
            ['id' => "bg", 'name' => "Bulgarian"],
            ['id' => "my", 'name' => "Burmese"],
            ['id' => "yue_Hant_HK", 'name' => "Cantonese"],
            ['id' => "ca", 'name' => "Catalan"],
            ['id' => "tzm", 'name' => "Central Morocco Tamazight"],
            ['id' => "chr", 'name' => "Cherokee"],
            ['id' => "cgg", 'name' => "Chiga"],
            ['id' => "zh", 'name' => "Chinese"],
            ['id' => "kw", 'name' => "Cornish"],
            ['id' => "hr", 'name' => "Croatian"],
            ['id' => "cs", 'name' => "Czech"],
            ['id' => "da", 'name' => "Danish"],
            ['id' => "nl", 'name' => "Dutch"],
            ['id' => "ebu", 'name' => "Embu"],
            ['id' => "en", 'name' => "English"],
            ['id' => "eo", 'name' => "Esperanto"],
            ['id' => "et", 'name' => "Estonian"],
            ['id' => "ee", 'name' => "Ewe"],
            ['id' => "fo", 'name' => "Faroese"],
            ['id' => "fil", 'name' => "Filipino"],
            ['id' => "fi", 'name' => "Finnish"],
            ['id' => "fr", 'name' => "French"],
            ['id' => "ff", 'name' => "Fulah"],
            ['id' => "gl", 'name' => "Galician"],
            ['id' => "lg", 'name' => "Ganda"],
            ['id' => "ka", 'name' => "Georgian"],
            ['id' => "de", 'name' => "German"],
            ['id' => "el", 'name' => "Greek"],
            ['id' => "gu", 'name' => "Gujarati"],
            ['id' => "guz", 'name' => "Gusii"],
            ['id' => "ha", 'name' => "Hausa"],
            ['id' => "haw", 'name' => "Hawaiian"],
            ['id' => "he", 'name' => "Hebrew"],
            ['id' => "hi", 'name' => "Hindi"],
            ['id' => "hu", 'name' => "Hungarian"],
            ['id' => "is", 'name' => "Icelandic"],
            ['id' => "ig", 'name' => "Igbo"],
            ['id' => "id", 'name' => "Indonesian"],
            ['id' => "ga", 'name' => "Irish"],
            ['id' => "it", 'name' => "Italian"],
            ['id' => "ja", 'name' => "Japanese"],
            ['id' => "kea", 'name' => "Kabuverdianu"],
            ['id' => "kab", 'name' => "Kabyle"],
            ['id' => "kl", 'name' => "Kalaallisut"],
            ['id' => "kln", 'name' => "Kalenjin"],
            ['id' => "kam", 'name' => "Kamba"],
            ['id' => "kn", 'name' => "Kannada"],
            ['id' => "kk", 'name' => "Kazakh"],
            ['id' => "km", 'name' => "Khmer"],
            ['id' => "ki", 'name' => "Kikuyu"],
            ['id' => "rw", 'name' => "Kinyarwanda"],
            ['id' => "kok", 'name' => "Konkani"],
            ['id' => "ko", 'name' => "Korean"],
            ['id' => "khq", 'name' => "Koyra Chiini"],
            ['id' => "ses", 'name' => "Koyraboro Senni"],
            ['id' => "lag", 'name' => "Langi"],
            ['id' => "lv", 'name' => "Latvian"],
            ['id' => "lt", 'name' => "Lithuanian"],
            ['id' => "luo", 'name' => "Luo"],
            ['id' => "luy", 'name' => "Luyia"],
            ['id' => "mk", 'name' => "Macedonian"],
            ['id' => "jmc", 'name' => "Machame"],
            ['id' => "kde", 'name' => "Makonde"],
            ['id' => "mg", 'name' => "Malagasy"],
            ['id' => "ms", 'name' => "Malay"],
            ['id' => "ml", 'name' => "Malayalam"],
            ['id' => "mt", 'name' => "Maltese"],
            ['id' => "gv", 'name' => "Manx"],
            ['id' => "mr", 'name' => "Marathi"],
            ['id' => "mas", 'name' => "Masai"],
            ['id' => "mer", 'name' => "Meru"],
            ['id' => "mfe", 'name' => "Morisyen"],
            ['id' => "naq", 'name' => "Nama"],
            ['id' => "ne", 'name' => "Nepali"],
            ['id' => "nd", 'name' => "North Ndebele"],
            ['id' => "nb", 'name' => "Norwegian Bokmål"],
            ['id' => "nn", 'name' => "Norwegian Nynorsk"],
            ['id' => "nyn", 'name' => "Nyankole"],
            ['id' => "or", 'name' => "Oriya"],
            ['id' => "om", 'name' => "Oromo"],
            ['id' => "ps", 'name' => "Pashto"],
            ['id' => "fa", 'name' => "Persian"],
            ['id' => "pl", 'name' => "Polish"],
            ['id' => "pt", 'name' => "Portuguese"],
            ['id' => "pa", 'name' => "Punjabi"],
            ['id' => "ro", 'name' => "Romanian"],
            ['id' => "rm", 'name' => "Romansh"],
            ['id' => "rof", 'name' => "Rombo"],
            ['id' => "ru", 'name' => "Russian"],
            ['id' => "rwk", 'name' => "Rwa"],
            ['id' => "saq", 'name' => "Samburu"],
            ['id' => "sg", 'name' => "Sango"],
            ['id' => "seh", 'name' => "Sena"],
            ['id' => "sr", 'name' => "Serbian"],
            ['id' => "sn", 'name' => "Shona"],
            ['id' => "ii", 'name' => "Sichuan Yi"],
            ['id' => "si", 'name' => "Sinhala"],
            ['id' => "sk", 'name' => "Slovak"],
            ['id' => "sl", 'name' => "Slovenian"],
            ['id' => "xog", 'name' => "Soga"],
            ['id' => "so", 'name' => "Somali"],
            ['id' => "es", 'name' => "Spanish"],
            ['id' => "sw", 'name' => "Swahili"],
            ['id' => "sv", 'name' => "Swedish"],
            ['id' => "gsw", 'name' => "Swiss German"],
            ['id' => "shi", 'name' => "Tachelhit"],
            ['id' => "dav", 'name' => "Taita"],
            ['id' => "ta", 'name' => "Tamil"],
            ['id' => "te", 'name' => "Telugu"],
            ['id' => "teo", 'name' => "Teso"],
            ['id' => "th", 'name' => "Thai"],
            ['id' => "bo", 'name' => "Tibetan"],
            ['id' => "ti", 'name' => "Tigrinya"],
            ['id' => "to", 'name' => "Tonga"],
            ['id' => "tr", 'name' => "Turkish"],
            ['id' => "uk", 'name' => "Ukrainian"],
            ['id' => "ur", 'name' => "Urdu"],
            ['id' => "uz", 'name' => "Uzbek"],
            ['id' => "vi", 'name' => "Vietnamese"],
            ['id' => "vun", 'name' => "Vunjo"],
            ['id' => "cy", 'name' => "Welsh"],
            ['id' => "yo", 'name' => "Yoruba"],
            ['id' => "zu", 'name' => "Zulu"],
        ];
    }
}
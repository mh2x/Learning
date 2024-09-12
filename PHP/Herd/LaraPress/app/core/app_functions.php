<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Core\SettingsManager;
use App\Core\LangManager;
use Illuminate\Foundation\Application;

function isRTL()
{
    $locale = app()->getLocale();
    return in_array($locale, ["ar", "dv", "fa", "ha", "he", "iw", "ji", "ps", "ur", "yi"]);
}

function Logout($str): void
{
    dd($str);
    Auth::guard('web')->logout();

    Session::invalidate();
    Session::regenerateToken();

    header('Location: /', true);
    die();
}

//-----------------------------------------------------------------------------
// Settings
//-----------------------------------------------------------------------------
function Settings($key, $default = null)
{
    //Register the settings manager
    if (!app()->bound(SettingsManager::class)) {
        app()->singleton(SettingsManager::class, function ($app) {
            //dd($app['path.base']);
            return new SettingsManager($app['path.base']);
        });
    }

    $settingsManager = app(SettingsManager::class);
    //dd($SettingsManager);
    return $settingsManager->getValueOrDefault($key, $default);
}

function updateSettingsValue($key, $value, $save = true)
{
    $settingsManager = app(SettingsManager::class);
    $settingsManager->setValue($key, $value, $save);
}

//-----------------------------------------------------------------------------
// Locales
//-----------------------------------------------------------------------------
function getAllLocales(): array
{
    $langManager = app(LangManager::class);
    return $langManager->getLocalesArray();
}

function getLocaleName(array $locale): array
{
    $langManager = app(LangManager::class);
    return $langManager->getLocaleName($locale);
}

function getAllowedLocaleNames(): array
{
    $locales = Settings('allowed_locales', ['en']);
    return getLocaleName($locales);
}

function setAppLocale($locale)
{

    $locales = Settings('allowed_locales', ['en']);
    if (!in_array($locale, $locales)) {
        dd("'$locale' not allowed!");
        return;
    }
    //Update settings
    updateSettingsValue('default_locale', $locale);
    app()->setLocale($locale);
}

//-----------------------------------------------------------------------------
//Theme support
//-----------------------------------------------------------------------------
function getAllThemes()
{
    $themes = (require 'themes.php');
    return $themes;
}

function getThemesStyleValidValues()
{
    $themes_style = (require 'themes_style.php');
    return $themes_style;
}

function getThemesStyle()
{
    //can be one of:
    //[light, dark, toggle, list]
    $themes_style = Settings('themes_style', 'light');
    return $themes_style;
}

function setThemeStyle($style)
{
    $allowed = ['light', 'dark', 'toggle', 'list'];

    if (!in_array($style, $allowed)) {
        throw new Exception("wrong value used for setThemeStyle. Allowed values are: $allowed");
    }
    updateSettingsValue('themes_style', $style);
}

function getThemesList()
{
    $supported_themes = Settings('themes_list', ['light', 'dark']);
    return $supported_themes;
}

function setThemesList($list)
{
    updateSettingsValue('themes_list', $list ?? ["light", 'dark']);
}


function getActiveTheme()
{
    $active_theme = Settings('active_theme', 'light');
    return $active_theme;
}

function setActiveTheme($theme)
{
    updateSettingsValue('active_theme', $theme ?? "light");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

//-----------------------------------------------------------------------------
//general for arrays
//-----------------------------------------------------------------------------

/**
 * Convert an array of strings into an array of associative arrays with 'id' and 'name' keys.
 *
 * @param array $strings Array of strings to be converted.
 * @return array Converted array.
 */
function convertArray($strings, $capital1st = false, $keyName = 'id', $valueName = "name")
{
    $result = [];

    foreach ($strings as $index => $string) {
        $result[] = [
            "$keyName" => $index,
            "$valueName" => $capital1st ? ucfirst(__($string)) : $string
        ];
    }
    return $result;
}

/**
 * arrayKeys2ArrayValues($keys, $bigArray) 
 *
 * @param array $keys array of $keys to be within the array 
 * @param array $bigArray The larger array to search within.
 * @return array Array of values from $bigArray
 */
function arrayKeys2ArrayValues($keys, $bigArray)
{
    // Create an array with just the keys to use for filtering
    $keysArray = array_flip($keys);
    // Filter the original array to get only the values for the given keys
    $filteredArray = array_intersect_key($bigArray, $keysArray);
    return $filteredArray;
}

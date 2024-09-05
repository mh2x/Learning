<?php

namespace App\Core;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SettingsManager
{
    public $settings = [];

    /**
     * Path to the language files.
     *
     * @var string
     */
    private $settingsFilePath;

    /**
     * Manager constructor.
     *
     * @param string $settingsFilePath
     */
    public function __construct($settingsFilePath)
    {
        $this->settingsFilePath = $settingsFilePath . DIRECTORY_SEPARATOR . "appsettings.json";
        $this->load();
    }

    /**
     * Load the settings
     *
     * @return array
     */
    private function load()
    {
        // Read the JSON file into a string
        $jsonString = file_get_contents($this->settingsFilePath);

        // Decode the JSON string into a PHP associative array
        $this->settings = json_decode($jsonString, true);
    }

    /**
     * Save the given settings.
     *
     */
    public function save()
    {
        file_put_contents(
            $this->settingsFilePath,
            json_encode($this->settings, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
    }
}
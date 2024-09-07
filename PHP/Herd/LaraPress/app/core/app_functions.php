<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Core\SettingsManager;
use App\Core\LangManager;

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
    App::setLocale($locale);
    // Redirect back to the same page
    //header("Location: " . $_SERVER['HTTP_REFERER'] . "?lang=$locale");
    header("Location: " . $_SERVER['HTTP_REFERER']);
    // Refresh the page immediately
    //header("Refresh:0");
    exit();
}
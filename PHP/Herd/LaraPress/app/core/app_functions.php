<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Core\SettingsManager;

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

    $SettingsManager = app(SettingsManager::class);
    //dd($SettingsManager);
    return $SettingsManager->getValueOrDefault($key, $default);
}
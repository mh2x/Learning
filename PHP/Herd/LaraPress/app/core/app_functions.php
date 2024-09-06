<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

function Settings($key, $default)
{
    return $default;
}
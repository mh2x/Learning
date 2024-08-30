<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function Logout($str): void
{
    dd($str);
    Auth::guard('web')->logout();

    Session::invalidate();
    Session::regenerateToken();

    header('Location: /', true);
    die();
}

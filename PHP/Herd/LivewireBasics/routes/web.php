<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "<h1>Coming soon!</h1>";
});

Route::get('/welcome', function () {
    return view('welcome');
});
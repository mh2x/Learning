<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tailwind', function () {
    return view('twexample');
});

Route::get('/daisyui', function () {
    return view('daisyui');
});

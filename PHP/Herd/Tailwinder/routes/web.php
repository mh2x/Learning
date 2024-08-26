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

Route::get('/flowbite', function () {
    return view('flowbite');
});

Route::get('/materialize', function () {
    return view('materialize');
});

Route::get('/preline', function () {
    return view('preline');
});

Route::get('/tailgrids', function () {
    return view('tailgrids');
});

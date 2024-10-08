<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tailwind', function () {
    return view('tailwind');
});

Route::get('/tails', function () {
    return view('tails');
});

Route::get('/daisyui', function () {
    return view('daisyui');
});

Route::get('/flowbite', function () {
    return view('flowbite');
});

Route::get('/material', function () {
    return view('material');
});

Route::get('/preline', function () {
    return view('preline');
});

Route::get('/tailgrids', function () {
    return view('tailgrids');
});

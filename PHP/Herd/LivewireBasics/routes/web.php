<?php

use App\Livewire\Register;
use Illuminate\Support\Facades\Route;


//livewire
Route::get('/register', Register::class); //Route::livewire points to livewire components


Route::get('/', function () {
    return "<h1>Coming soon!</h1>";
});

Route::get('/welcome', function () {
    return view('welcome');
});
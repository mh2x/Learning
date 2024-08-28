<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('playground', 'playground')->name('playground');
Route::view('facedetection', 'facedetection')->name('facedetection');

Route::group(['middleware' => ["auth", "verified",]], function () {
    Route::view('chirper', 'chirper')->name('chirper');
    Route::view('todo', 'todo')->name('todo');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\LivewireView;

Route::view('/', "livewire.pages.welcome.welcome");

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'livewire.pages.profile.profile')
    ->middleware(['auth'])
    ->name('profile');

//Admin
Volt::route('languages', 'pages.admin.languages')
    ->middleware(['auth', 'verified'])
    ->name('languages');

//Test stuff
Route::view('normalview', 'normal-view'); //normal blade view
Route::get('livewireview', LivewireView::class); //livewire blade view

require __DIR__ . '/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\LivewireView;

Route::view('/', "pages.welcome.welcome")
    ->middleware(['guest'])
    ->name("welcome");

Route::view('dashboard', 'pages.user.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'livewire.pages.profile.profile')
    ->middleware(['auth'])
    ->name('profile');

//volt sample - folio replaces this
/*Volt::route('/admin/languages', 'languages')
    ->middleware(['auth', 'verified'])
    ->name('languages');
*/

//Test stuff
Route::view('normalview', 'pages.samples.normal-view'); //normal blade view
Route::get('livewireview', LivewireView::class); //livewire blade view
//Folio is handling this
//Volt::route('voltview', 'voltview'); //Livewire / volt view


require __DIR__ . '/auth.php';
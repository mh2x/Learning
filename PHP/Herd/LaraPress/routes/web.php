<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\LivewireView;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::view('/', "pages.welcome.welcome")
    ->middleware(['guest'])
    ->name("welcome");

Route::view('dashboard', 'pages.user.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//auth
Route::middleware('auth')->group(function () {
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

//profile
Route::view('profile', 'pages.profile.profile')
    ->middleware(['auth'])
    ->name('profile');

//Admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/admin/languages', "pages.admin.languages")
            ->name("admin.languages");
});

//Test stuff
Route::view('normalview', 'pages.samples.normal-view'); //normal blade view
Route::get('livewireview', LivewireView::class); //livewire blade view

<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

//Home page
Route::get('/', [JobController::class, 'index']);

//Post a Job
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

//Search
//NOTE: without array, this is called invoke-able controller
Route::post('/search', SearchController::class);

//Route::get('/tags/{tag}', TagController::class); //{tag} Laravel will think this is id
Route::get('/tags/{tag:name}', TagController::class);

//Authentication

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name("login");
    Route::post('/login', [SessionController::class, 'store']);
});


Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

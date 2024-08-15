<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use Mockery\Generator\Method;
use App\Models\Job;

Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello'
    ]);
});

//Use this or use Route::view below
/*
Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
*/
Route::view("/about", "about");
Route::view("/contact", "contact");

//Route Model Binding
//Route::get('/posts/{post:slug}', function (Post $post) {...}


//============JOB ROUTES====================
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
Route::post('/jobs', [JobController::class, 'store']);
Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

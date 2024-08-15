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
/*
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/create', 'create');
    Route::get('/jobs/{job}', 'show');
    Route::get('/jobs/{job}/edit', 'edit');
    Route::post('/jobs', 'store');
    Route::patch('/jobs/{job}', 'update');
    Route::delete('/jobs/{job}', 'destroy');
});
*/
//This is equivalent to the above!
Route::resource("jobs", JobController::class);

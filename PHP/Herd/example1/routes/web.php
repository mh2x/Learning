<?php

use Illuminate\Support\Facades\Route;
use Mockery\Generator\Method;
use App\Models\Job;

Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello'
    ]);
});

Route::get('/jobs', function () {
    return view(
        'jobs',
        [
            'jobs' => Job::all()
        ]
    );
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    //dd($job);   //dump and die!
    return view('job', ['job' => $job]);
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

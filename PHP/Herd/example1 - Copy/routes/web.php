<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Arr;

//define a global array
//you can pass it to functions (closures) with use()
$jobs = [
    [
        'id' => '1',
        'title' => 'Director',
        'salary' => '$50,000'
    ],
    [
        'id' => '2',
        'title' => 'Programmer',
        'salary' => '$20,000'
    ],
    [
        'id' => '3',
        'title' => 'Teacher',
        'salary' => '$40,000'
    ]
];


Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello'
    ]);
});

Route::get('/jobs', function () use ($jobs) {
    return view(
        'jobs',
        [
            'jobs' => $jobs
        ]
    );
});

Route::get('/jobs/{id}', function ($id) use ($jobs) {
    //instead of foreach here, use laravel helper Arr for arrays
    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);

    //dd($job);   //dump and die!
    return view('job', ['job' => $job]);
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

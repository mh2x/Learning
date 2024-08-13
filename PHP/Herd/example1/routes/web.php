<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Arr;

Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello'
    ]);
});

Route::get('/jobs', function () {
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

    return view(
        'jobs',
        [
            'jobs' => $jobs
        ]
    );
});

Route::get('/jobs/{id}', function ($id) {

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

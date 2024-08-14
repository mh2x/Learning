<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Arr;
use Mockery\Generator\Method;

//define a global array
//you can pass it to functions (closures) with use()
class Job
{

    public static function all()
    {
        return
            [
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
    }
}

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
    //instead of foreach here, use laravel helper Arr for arrays
    $job = Arr::first(Job::all(), fn($job) => $job['id'] == $id);

    //dd($job);   //dump and die!
    return view('job', ['job' => $job]);
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

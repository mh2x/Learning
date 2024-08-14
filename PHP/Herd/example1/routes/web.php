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
    //NOTE: employer is the relation found inside the Job class
    //This fixes N+1 Problem for Select * from Employer where id=?
    //However, this doesn't scale if you have millions of records!
    //We will need pagination

    //This is called EAGER LOADING --> i.e. [Select * from Employer]!!!
    //We will need a pagination method soon...
    //$jobs = Job::with('employer')->get();

    //Use pagination
    $jobs = Job::with('employer')->simplePaginate(10);

    return view('jobs', ['jobs' => $jobs]);
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

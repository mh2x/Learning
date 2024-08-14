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

    //Use CURSOR pagination ==> BEST PERFORMANCE!!
    $jobs = Job::with('employer')->cursorPaginate(10);

    return view('jobs.index', ['jobs' => $jobs]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    //dd($job);   //dump and die!
    return view('jobs.show', ['job' => $job]);
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

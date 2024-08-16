<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Route;
use Mockery\Generator\Method;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;

Route::get("test", function () {
    //Mail::to("a@b.com")->send(new JobPosted());
    //One way to queue jobs is to use
    dispatch(function () {
        logger('hello from the queue!');
    });

    dispatch(function () {
        logger('hello from the queue after 5 seconds!');
    })->delay(5);

    return 'Done.';
});

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
if (false /*authorization not required*/) {
    //This is equivalent to the above!
    Route::resource("jobs", JobController::class);
    //middleware routing is NOT good to use with resource as it applies to all routes :(
    //Route::resource("jobs", JobController::class)->middleware('auth');
    //That's why we need to go back to individual routes...

    //->middleware('auth'); this means you need to be signed in
}

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])
    ->middleware('auth'); //this means you need to be signed in;

Route::get('/jobs/{job}', [JobController::class, 'show'])
    ->middleware('auth'); //this means you need to be signed in;

//Route::get('/jobs/{job}/edit', 'edit')->middleware(['auth', 'can:edit-job,job']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job'); //we're now using JobPolicy

Route::post('/jobs', [JobController::class, 'store'])
    ->middleware('auth')
    ->can('edit-job', 'job');  //gate edit-job

Route::patch('/jobs/{job}', [JobController::class, 'update'])
    ->middleware('auth')
    ->can('edit-job', 'job');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
    ->middleware('auth')
    ->can('edit-job', 'job');

//1 - In case you need only a few to map, do:
/*
Route::resource("jobs", JobController::class,[
    'only'=>['index', 'show', 'create', 'store']
]);
*/

//2- In case you need to ignore some, do:
/*
Route::resource("jobs", JobController::class,[
    'except'=>['edit', 'destroy']
]);
*/

//============AUTH Management our way for learning!====================
Route::get("/register", [RegisteredUserController::class, 'create']);
Route::post("/register", [RegisteredUserController::class, 'store']);


//============Session Management our way for learning!====================
Route::get("/login", [SessionController::class, 'create'])->name('login');  //laravel needs to know a route by the name 'login' to redirect to it.
Route::post("/login", [SessionController::class, 'store']);
Route::post("/logout", [SessionController::class, 'destroy']);

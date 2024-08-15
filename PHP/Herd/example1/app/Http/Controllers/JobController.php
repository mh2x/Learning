<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //
    public function index()
    {
        //NOTE: employer is the relation found inside the Job class
        //This fixes N+1 Problem for Select * from Employer where id=?
        //However, this doesn't scale if you have millions of records!
        //We will need pagination

        //This is called EAGER LOADING --> i.e. [Select * from Employer]!!!
        //We will need a pagination method soon...
        //$jobs = Job::with('employer')->get();

        //Use CURSOR pagination ==> BEST PERFORMANCE!!
        //latest --> order by created desc
        $jobs = Job::with('employer')->latest()->simplePaginate(10);
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }
    public function show(Job $job)
    {
        //dd($job);   //dump and die!
        return view('jobs.show', ['job' => $job]);
    }
    public function store()
    {
        //dd(request()->all());   //dump and die!

        //Validation ....
        //For more details on Laravel provided validations:
        //see: https://laravel.com/docs/11.x/validation

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        //back to job list
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        //dd($job);   //dump and die!
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        //dd($job);   //dump and die!

        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // authorize (on hold...)
        // update the job
        $job->title = request('title');
        $job->salary = request('salary');

        // and persist
        $job->save();
        /*
        We can also do this:

        $Job->update([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);
    */

        // redirect to the job page
        return redirect("/jobs/$job->id");
    }

    public function destroy(Job $job)
    {
        // authorize (on hold...)
        // delete the job
        $job->delete();
        //redirect
        return redirect('/jobs');
    }
}

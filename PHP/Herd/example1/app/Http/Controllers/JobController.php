<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        //instead of ->send we ->queue the email because it takes time to send it.
        
        Mail::to($job->employer->user)->queue(new JobPosted($job));

        //back to job list
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        //inline Authorization
        //We need to make sure the user is authenticated and authorized to do this

        /*: Look at AppServiceProvider.php to see the Gate definitions.
            since we are using gates, no need to check for guest as this will not be invoked
            unless user is logged-in

                //is user logged in?
                if (Auth::guest()) {
                    return redirect('/login');
                }
        */

        if (false /*not using GATES*/) {
            //does the job belong to the user?
            if ($job->employer->user->isNot(Auth::user())) {

                //$model->is() compares two models
                //if they have same id and belong to same table --> returns true
                abort(403); //not authorized
            }
        } else if (false /*not using middleware*/) { //GATE

            //This will run the logic 'edit-job' and if it fails, Laravel aborts with 403
            Gate::authorize('edit-job', ['job' => $job]); //403 automatic by Laravel :)

            //Conditional
            if (Gate::denies('edit-job', $job)) {
                //do some of your own logic for denied access
            }
            //Another option
            if (Gate::allows('edit-job', $job)) {
                //do some of your own logic for allowed access
            }

            //We also can use can and cannot for our User model:
            if (Auth::user()->can('edit-job', $job)) {
                //User can edit job
            }

            //We also can use can and cannot for our User model:
            if (Auth::user()->cannot('edit-job', $job)) {
                //User cannot edit job
            }
        } //GATE

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

<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
        // NOTE: Always eager load your queries using with()
        // to avoid N+1 problem
        //$jobs = Job::all()->groupBy("featured");
        return view('jobs.index', [
            'jobs' => Job::latest()->with(['employer', 'tags'])->get()->all(), //in real project, you would paginate this!
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //Look at https://laravel.com/docs/11.x/validation#form-request-validation
    //public function store(StoreJobRequest $request)
    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in('Part Time', 'Full Time')],
            'url' => ['required', 'active_url'], //You can also do 'url'
            'tags' => ['nullable'],
        ]);

        //unchecked checkboxes will not get passed
        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tag'] ?? false /*if null assume false*/) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tags($tag);
            }
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}

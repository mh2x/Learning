<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function __invoke(Tag $tag)
    {
        //Get me all jobs for with this tag!
        //NOTE: this jobs() caused me a bug I couldn't figure out easily :(
        //return view("results", ['jobs' => $tag->jobs()]);
        return view('results', ['jobs' => $tag->jobs]);
        //return view('results', ['jobs' => $tag->jobs->load(['employer', 'tags'])]);
    }
}

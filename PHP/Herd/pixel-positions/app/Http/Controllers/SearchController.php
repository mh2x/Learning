<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function __invoke()
    {
        //dd(request("q"));
        // search for title has(*'q'*)...

        $jobs = Job::query()  //query is optional, you can also do Job::with
            ->with(['employer', 'tags'])
            ->where("title", "LIKE", "%" . request("q") . "%")
            ->get();
        return view("results", ["jobs" => $jobs]);
    }
}

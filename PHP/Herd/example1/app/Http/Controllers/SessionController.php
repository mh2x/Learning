<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function create()
    {
        //dd("Register new user..");
        return view("auth.login");
    }

    public function store()
    {
        dd(request()->all());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        //validate
        $attributes = request()->validate([
            "email" => ['required'],
            "password" => ['required']
        ]);

        //attempt to login
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages(
                [
                    'email' => trans('Sorry, invalid credentials provided.')
                ]
            );
        }

        //regenerate session token
        //this protects against session hacking!
        //because if someone has an old token, this invalidates it ;)
        request()->session()->regenerate();

        //redirect
        return redirect('/jobs');

        //dd(request()->all());
    }
    public function destroy()
    {
        Auth::logout();
        return redirect("/");
    }
}

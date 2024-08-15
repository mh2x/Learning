<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    //
    public function create()
    {
        //dd("Register new user..");
        return view("auth.register");
    }
    public function store()
    {
        //$info = implode("\n", request()->all());
        //dd("TODO: Register $info");
        //Validate

        $validatedAttributes = request()->validate([
            "name" => ['required'],
            "email" => ['required', 'email', 'max:254'],
            "password" => ['required', Password::min(6), 'confirmed']
            //"password" => ['required', Password::default()]
        ]); //NOTE: using confimed validation expects to have the same field name with field_confirmation name


        //Create in DB
        $newUser = User::create($validatedAttributes);

        //Log in
        Auth::login($newUser);
        //redirect somewhere
        return redirect('/jobs');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $usersAttribute = $request->validate([
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        if (! Auth::attempt($usersAttribute)) {
            throw ValidationException::withMessages([
                'email' => trans('Sorry, invalid credentials.')
            ]);
        }

        //good practice to regenerate
        $request->session()->regenerate();
        return redirect('/jobs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Logout
        Auth::logout();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $usersAttribute = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        $employerAttribute = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg', 'webp'])]
        ]);

        $user = User::create($usersAttribute);

        //store the image file
        $logoPath = $request->logo->store('logos');

        //link employer to user directly from user object!
        $user->employer()->create([
            "name" => $employerAttribute['employer'],
            'logo' => $logoPath
        ]);

        Auth::login($user);

        return redirect('/');
    }
}

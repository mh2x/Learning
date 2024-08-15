<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $info = implode("\n", request()->all());
        dd("TODO: Register $info");
    }
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}

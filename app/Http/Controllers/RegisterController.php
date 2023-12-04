<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required']
        ]);

        $validateData['password'] = bcrypt($request->password);

        User::create($validatedData);

        return redirect('/login')->with('succes', 'Register Succesfully');
    }
}

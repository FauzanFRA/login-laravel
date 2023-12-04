<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\ValidatedData;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required']
        ]);

        $validatedData['password'] = bcrypt($request->password);

        User::create($validatedData);

        return redirect('/login')->with('succes', 'Registered Succesfully');
    }
}

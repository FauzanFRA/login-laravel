<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Function_;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    //method verifikasi user
    public function aunthenticate (Request $request): RedirectResponse
    {
        $credentials = $request -> validate([
            'email'=>['required','email'],
            'password'=> ['required'],
        ]);

        if (Auth::attempt ($credentials)) {
            $request -> session()->regenerate();
            return redirect()->intended('/');
        
    }

    return back ()
    ->withErrors([
        'emails'=>'credentialnya kagak cocok',
    ]) -> onlyInput('email');
}


//method untuk Logout/keluar
public function logout(Request $request): RedirectResponse
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}}

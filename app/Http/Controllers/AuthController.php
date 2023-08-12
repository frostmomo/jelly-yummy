<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login()
    {
        if(Auth::check()) 
        {
            return redirect('/home');
        }

        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password')))
        {
            return redirect('/home');
        }

        return redirect('/login')->with('failed', 'Email atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

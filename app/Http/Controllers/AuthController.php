<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signupPage()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.signup');
    }

    public function loginPage()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        // Authentication Attempt
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()
                ->withErrors(['error' => 'Incorrect email or password'])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

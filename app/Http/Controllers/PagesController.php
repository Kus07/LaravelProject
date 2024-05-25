<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function login()
    {
        return view('Pages/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/dashboard');
        } else {
            // Authentication failed
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid email or password.');
        }
    }

    public function register()
    {
        return view('Pages/register');
    }

    public function contact()
    {
        return view('Pages/contact');
    }
}

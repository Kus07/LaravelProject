<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            return view('Pages/dashboard', compact('userEmail'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
        }
    }
}

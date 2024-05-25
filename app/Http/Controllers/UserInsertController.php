<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserInsertController extends Controller
{
    public function insertform()
    {
        $registeredUsername = session('registered_username');
    
        return view('Pages/login', ['registeredUsername' => $registeredUsername]);
    }   

    public function insert(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        // Check if passwords match
        if ($password !== $passwordConfirmation) {
            return redirect()->back()->with(['error' => 'Passwords do not match.', 'email' => $email]);
        }

        // Hash the password
        $hashedPassword = bcrypt($password);

        $data = array(
            'email' => $email,
            'password' => $hashedPassword,
        );

        DB::table('users')->insert($data);

        return redirect()->route('login')->with('success', 'User registered successfully. You may now log in.');
    }
}

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

        return view('Pages/login');
    }

    public function insert(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        if ($password !== $passwordConfirmation) {
            return redirect()->back()->with(['error' => 'Passwords do not match.', 'email' => $email]);
        }

        if ($this->isEmailDuplicate($email)) {
            return redirect()->back()->with(['error' => 'The email address is already registered.', 'email' => $email]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with(['error' => 'The email address is not valid.', 'email' => $email]);
        }

        $hashedPassword = bcrypt($password);

        $data = array(
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user',
        );

        DB::table('users')->insert($data);

        return redirect()->route('login')->with('success', 'User registered successfully. You may now log in.');
    }

    private function isEmailDuplicate($email)
    {
        $existingUser = DB::table('users')
            ->where('email', $email)
            ->first();

        return $existingUser !== null;
    }
}

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

        // Check if passwords match
        if ($password !== $passwordConfirmation) {
            return redirect()->back()->with(['error' => 'Passwords do not match.', 'email' => $email]);
        }

        // Check if the email already exists
        if ($this->isEmailDuplicate($email)) {
            return redirect()->back()->with(['error' => 'The email address is already registered.', 'email' => $email]);
        }

        // Validate the email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with(['error' => 'The email address is not valid.', 'email' => $email]);
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

    private function isEmailDuplicate($email)
    {
        // Implement your own logic to check if the email is a duplicate
        // This is just a placeholder, you'll need to replace it with your own implementation
        $existingUser = DB::table('users')
            ->where('email', $email)
            ->first();

        return $existingUser !== null;
    }
}

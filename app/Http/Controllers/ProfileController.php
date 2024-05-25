<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        $user = User::find($userId);
        return view('Pages/profile', compact('user'));
    }

    public function editProfile(Request $request)
    {
        $userId = session('user_id');
        $user = User::find($userId);

        if ($request->isMethod('post')) {
            // Validate the form input
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email,' . $userId,
                'firstName' => 'nullable',
                'lastName' => 'nullable',
                'shopName' => 'nullable',
            ], [
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
            ]);

            // Update the user information
            $user->email = $validatedData['email'];
            $user->firstName = $validatedData['firstName'];
            $user->lastName = $validatedData['lastName'];
            $user->shopName = $validatedData['shopName'];
            $user->save();

            // Redirect or return a response
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }

        return view('Pages/profile', compact('user'));
    }
}
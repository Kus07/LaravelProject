<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function login()
    {
        return view('Pages/login');
    }

    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $request->session()->regenerate();
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_email', $user->email);

            if ($user->role === 'admin') {
                return redirect()->route('adminPage');
            }

            $cartItems = Cart::where('user_id', $user->id)->get();
            $totalCount = 0;
            $totalPrice = 0;

            foreach ($cartItems as $item) {
                $totalCount += $item->quantity;
                $totalPrice += $item->quantity * $item->price;
            }

            $request->session()->put('cart_total_count', $totalCount);
            $request->session()->put('cart_total_price', $totalPrice);

            return redirect()->intended('/dashboard');
        } else {
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

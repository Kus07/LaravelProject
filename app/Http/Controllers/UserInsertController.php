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
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $data=array('username'=>$username,'email'=>$email,"password"=>$password);
        DB::table('users')->insert($data);

        session(['registered_username' => $username]);
        
        echo "Record inserted successfully.<br/>";
        echo '<a href = "/insert">Click Here</a> to go back.';
    }
}

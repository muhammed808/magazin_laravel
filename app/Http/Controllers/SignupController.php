<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends AuthController
{

    public function index()
    {
        return view('auth.register');
    }

    public function save(Request $req)
    {
        
        $validated = $req->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $date = date('Y-m-d H:i:s');
        
        $users = new User();

        $users->insert([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
            'created_at' => $date, 
            'updated_at' => $date
        ]);

        return redirect('login')->withInput();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends AuthController
{
    public function index()
    {
        return view('auth.login');
    }

    public function save(Request $req)
    {
        $validated = $req->validate([

            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validated)){
            
            $req->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'email' => 'this email is not found or password is not correct',
        ])->withInput();

    }
}

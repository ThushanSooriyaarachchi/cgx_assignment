<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showSignIn()
    {
        return view('auth.login'); 
    }

    public function showRegister()
    {
        return view('auth.register'); 
    }
}
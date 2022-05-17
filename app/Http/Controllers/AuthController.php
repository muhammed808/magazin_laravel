<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class AuthController extends Controller
{
    public abstract function index();
    public abstract function save(Request $request);
}

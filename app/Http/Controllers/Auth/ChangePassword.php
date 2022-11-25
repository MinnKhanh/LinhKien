<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePassword extends Controller
{
    public function index()
    {
        return view('auth.passwords.changepassword');
    }
    public function change(Request $request)
    {
    }
}

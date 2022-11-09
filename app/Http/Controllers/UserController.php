<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        View::share('active', 0);
    }
    public function update()
    {
        return view('user.update');
    }
    public function productFavorite()
    {
        return view('favorite.index');
    }
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();
    //     return Redirect::route('home');
    // }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        View::share('active', 5);
    }
    public function update()
    {
        return view('user.update');
    }
    public function productFavorite()
    {
        return view('favorite.index');
    }
}

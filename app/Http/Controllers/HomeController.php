<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        View::share('active', 1);
    }
    public function index()
    {
        return view('index');
    }
}

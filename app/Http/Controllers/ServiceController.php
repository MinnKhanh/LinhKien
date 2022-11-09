<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ServiceController extends Controller
{
    public function __construct()
    {
        View::share('active', 3);
    }
    public function aboutus(Request $request)
    {
        return view('service.about_us');
    }
    public function blog(Request $request)
    {
        return view('service.blog');
    }
    public function contact(Request $request)
    {
        return view('contact.contact');
    }
}

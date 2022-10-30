<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
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

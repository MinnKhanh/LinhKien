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
        View::share('active', 5);
        return view('service.contact');
    }
    public function coupons(Request $request)
    {
        return view('service.coupons');
    }
    public function news()
    {
        return view('service.news');
    }
    public function newDetail(Request $request)
    {
        return view('service.newdetail', ['new' => $request->new]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return view('service.cart');
    }
    public function checkout(Request $request)
    {
        return view('service.checkout');
    }
    public function contact(Request $request)
    {
        return view('contact.contact');
    }
}

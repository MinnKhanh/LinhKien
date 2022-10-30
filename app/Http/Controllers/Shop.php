<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class Shop extends Controller
{
    public function index(Request $request)
    {
        return view('shop.list_product');
    }
}

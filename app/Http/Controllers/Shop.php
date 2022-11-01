<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class Shop extends Controller
{

    public function index(Request $request)
    {
        return view('shop.list_product');
    }
    public function detail(Request $request)
    {
        if ($request->input('id')) {
            return view('shop.detail', ['id' => $request->input('id')]);
        }
    }
}

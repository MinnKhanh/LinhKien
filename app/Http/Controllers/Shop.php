<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laravel\Ui\Presets\React;

class Shop extends Controller
{
    public function __construct()
    {
        View::share('active', 2);
    }
    public function index(Request $request)
    {
        return view('shop.list_product');
    }
    public function detail(Request $request)
    {
        if ($request->input('id')) {
            return view('shop.detail', ['id' => $request->input('id'), 'active' => 2]);
        }
    }
}

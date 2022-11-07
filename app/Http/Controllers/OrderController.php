<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function __construct()
    {
        View::share('active', 3);
    }
    public function index(Request $request)
    {
        return view('orders.index');
    }
    public function detailOrder(Request $request)
    {
        return view('orders.detail', ['idorder' => $request->input('id')]);
    }
}

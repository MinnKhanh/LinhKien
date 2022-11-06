<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.orders.index');
    }
    public function detailOrder(Request $request)
    {
        return view('order.detailorder');
    }
}

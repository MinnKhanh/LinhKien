<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderImport extends Controller
{
    public function create(Request $request)
    {
        return view('admin.orderimport.create');
    }
    public function checkout(Request $request)
    {

        return view('admin.orderimport.checkout');
    }
    public function printOrder(Request $request)
    {
        return view('admin.orderimport.print', ['id' => $request->input('id')]);
    }
    public function index(Request $request)
    {
        return view('admin.orderimport.index');
    }
    public function detail(Request $request)
    {
        return view('admin.orderimport.detail', ['id' => $request->input('id')]);
    }
}

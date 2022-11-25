<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.discount.index');
    }
    public function edit(Request $request)
    {
        return view('admin.discount.createorupdate', ['id' => $request->id]);
    }
    public function create(Request $request)
    {
        return view('admin.discount.createorupdate');
    }
}

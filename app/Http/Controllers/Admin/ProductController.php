<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function __construct()
    {
        View::share('active', 3);
    }
    public function create(Request $request)
    {
        return view('admin.product.createorupdate');
    }
    public function update(Request $request)
    {
        return view('admin.product.createorupdate', ['isedit' => $request->input('id')]);
    }
    public function index(Request $request)
    {
        return view('admin.product.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BrandController extends Controller
{
    public function __construct()
    {
        View::share('active', 3);
    }
    public function index()
    {
        return view('admin.brand.index');
    }
    public function create()
    {
        return view('admin.brand.createorupdate');
    }
    public function update(Request $request)
    {
        return view('admin.brand.createorupdate', ['isedit' => $request->input('id')]);
    }
}

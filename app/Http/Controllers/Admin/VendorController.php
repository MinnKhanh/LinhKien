<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VendorController extends Controller
{
    public function __construct()
    {
        View::share('active', 3);
    }
    public function index()
    {

        return view('admin.vendor.index');
    }
    public function create()
    {
        return view('admin.vendor.createorupdate');
    }
    public function update(Request $request)
    {
        return view('admin.vendor.createorupdate', ['isedit' => $request->input('id')]);
    }
}

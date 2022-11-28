<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopInformation extends Controller
{
    public function news(Request $request)
    {
        return view('admin.shopinformation.news');
    }
    public function editNew(Request $request)
    {
        return view('admin.shopinformation.news', ['id' => $request->input('id')]);
    }
    public function listnews()
    {
        return view('admin.shopinformation.listnews');
    }
}

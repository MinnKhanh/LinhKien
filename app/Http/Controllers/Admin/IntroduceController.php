<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntroduceController extends Controller
{
    public function createSlideIntro(Request $request)
    {
        return view('admin.introduce.editslideintro');
    }
    public function createDiscountIntro(Request $request)
    {
        return view('admin.introduce.editintrodiscount');
    }
    public function editDiscountIntro(Request $request)
    {
        return view('admin.introduce.editintrodiscount', ['id' => $request->id]);
    }
    public function customizeSlideIntro(Request $request)
    {
        return view('admin.introduce.customizeslideintro');
    }
    public function editSlideIntro(Request $request)
    {
        return view('admin.introduce.editslideintro', ['id' => $request->id]);
    }
    public function index(Request $request)
    {
        return view('admin.introduce.index');
    }
}

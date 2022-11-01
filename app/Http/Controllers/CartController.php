<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return view('service.cart');
    }
    public function checkout(Request $request)
    {
        if (Cart::where('user', 1)->sum('quantity') <= 0) {
            return Redirect::back()->withErrors(['msg' => 'Vui lòng thêm sảm phẩm vào giỏ hàng']);
        }
        $discount = '';
        if ($request->input('discount')) {
            $discount = $request->input('discount');
        }
        return view('service.checkout', ['discount' => $discount]);
    }
    public function contact(Request $request)
    {
        return view('contact.contact');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $orders = Order::whereMonth('created_at', $month)->whereYear('order.created_at', $year);
        $ordersnumber = $orders->count();
        $sales = $orders->sum('totalPrice');
        $customernumber = User::join('model_has_permissions', 'model_has_permissions.model_id', 'users.id')->where('permission_id', '!=', 1)->count();
        $listbestproduct = Product::with('Img')->join('orderdetail', 'product.id', 'orderdetail.product_id')->groupby('product.id', 'product.product_name')
            ->select('product.id', 'product.product_name', DB::raw('sum(orderdetail.quantity) as count'), DB::raw('sum(orderdetail.price*orderdetail.quantity) as money'))->orderBy('count', 'desc')->skip(0)->take(10)->get()->toArray();
        $listbestcustomer = User::with('Img')->join('model_has_permissions', 'model_has_permissions.model_id', 'users.id')->where('model_has_permissions.permission_id', 2)
            ->join('order', 'order.user', 'users.id')->groupby('users.id', 'users.name', 'users.email', 'users.phone')
            ->select('users.id', 'users.name', 'users.email', 'users.phone', DB::raw('sum(users.id) as count'), DB::raw('sum(order.totalPrice) as money'))
            ->orderBy('count', 'desc')->skip(0)->take(10)->get()->toArray();
        // dd($listbestcustomer);
        return view('admin.index', ['ordersnumber' => $ordersnumber, 'sales' => $sales, 'customernumber' => $customernumber, 'listbestproduct' => $listbestproduct, 'listbestcustomer' => $listbestcustomer]);
    }
}

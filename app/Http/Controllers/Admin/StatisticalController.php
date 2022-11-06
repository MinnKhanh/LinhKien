<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function index()
    {
        return view('admin.statistical.index');
    }
    public function getdatachart(Request $request)
    {
        $data = null;
        if ($request->input('typechart') == 1) {
            // DB::enableQueryLog();
            $subquery = Order::join('orderdetail', 'orderdetail.order_id', 'order.id')
                ->whereYear('order.created_at', $request->input('year'));
            if ($request->input('typetime') == 1) {
                $subquery->whereMonth('order.created_at', $request->input('mounth'));
            }
            $subquery->select(DB::raw('orderdetail.*'));

            $data = Product::leftJoinSub($subquery, 'orderdetails', function ($join) {
                $join->on('product.id', '=', 'orderdetails.product_id');
            })
                ->groupby('product.id', 'product.product_name')
                ->select(
                    'product.id',
                    DB::raw('product.product_name as name'),
                    DB::raw('ifnull(sum(orderdetails.quantity),0) as count'),
                    DB::raw('ifnull(sum(orderdetails.quantity*(orderdetails.price-product.import_price)),0) as proceed')
                )->get()->toArray();
            // dd(DB::getQueryLog());
            // dd('product', $data);
        } elseif ($request->input('typechart') == 2) {
            $data = Product::join('orderdetail', 'orderdetail.product_id', 'product.id')
                ->join('order', 'order.id', 'orderdetail.order_id')
                ->whereYear('order.created_at', $request->input('year'));
            if ($request->input('typetime') == 1) {
                $data->whereMonth('order.created_at', $request->input('mounth'));
            }
            $data->select(DB::raw('product.import_price,orderdetail.price,orderdetail.quantity,product.category_id'));
            $data = Categories::leftJoinSub($data, 'orderdetails', function ($join) {
                $join->on('category.id', '=', 'orderdetails.category_id');
            })->groupby('category.id', 'category.category_name')
                ->select(
                    'category.id',
                    DB::raw('category.category_name as name'),
                    DB::raw('ifnull(sum(orderdetails.quantity),0) as count'),
                    DB::raw('ifnull(sum(orderdetails.quantity*(orderdetails.price-orderdetails.import_price)),0) as proceed')
                )->get()->toArray();


            // dd(DB::getQueryLog());
            // dd('category', $data);
        } else {
            $data = Order::whereYear('created_at', $request->input('year'));
            if ($request->input('typetime') == 1) {
                $data->whereMonth('created_at', $request->input('mounth'));
            }
            $data = User::leftJoinSub($data, 'orderdetails', function ($join) {
                $join->on('users.id', '=', 'orderdetails.user');
            })->groupby('users.id', 'users.name')
                ->select(
                    'users.id',
                    DB::raw('users.name as name'),
                    DB::raw('ifnull(sum(orderdetails.quantity),0) as count'),
                    DB::raw('ifnull(sum(orderdetails.totalPrice),0) as proceed')
                )->get()->toArray();
            // dd('user', $data);
        }
        return $data;
    }
}

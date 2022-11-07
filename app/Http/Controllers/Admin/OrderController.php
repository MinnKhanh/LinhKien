<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\sendMail;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.orders.index');
    }
    public function detailOrder(Request $request)
    {
        // dd($request->input('id'));
        $order = Order::where('order.id', $request->input('id'))
            ->join('users', 'users.id', 'order.user')
            ->select(
                'order.name',
                'order.phone',
                'order.email',
                'order.address',
                'order.city',
                'order.district',
                'order.note',
                'order.totalPrice',
                'order.quantity',
                'order.paymentmethod',
                'order.status',
                'order.created_at',
                'order.discount',
                'order.ship',
                DB::raw('users.name username'),
                DB::raw('users.address as addressuser'),
            )
            ->first()
            ->toArray();
        $myDate = $order['created_at'];
        $date = Carbon::createFromFormat('m/d/Y', $myDate)->addDay(5)->format('Y-m-d');
        $orderdetails = Product::with('Img')
            ->join('brand', 'brand.id', 'product.brand')
            ->join('category', 'product.category_id', 'category.id')
            ->join('orderdetail', 'product.id', 'orderdetail.product_id')->where('orderdetail.order_id', $request->input('id'))
            ->select(
                'product.id',
                'product.product_name',
                'orderdetail.price',
                'orderdetail.quantity',
                'brand.brand_name',
                'category.category_name',
                DB::raw('(orderdetail.quantity*orderdetail.price) as totalPrice'),
            )
            ->get()->toArray();
        return view('admin.orders.detail', ['idorder' => intval($request->input('id')), 'order' => $order, 'orderdetails' => $orderdetails, 'date' => $date]);
    }
    public function printOrder(Request $request)
    {
        return view('orders.print', ['idorder' => $request->input('id')]);
    }
    public function sendOrderToMail(Request $request)
    {
        try {
            $order = Order::where('order.id', $request->input('id'))
                ->join('users', 'users.id', 'order.user')
                ->select(
                    'order.name',
                    'order.phone',
                    'order.email',
                    'order.address',
                    'order.city',
                    'order.district',
                    'order.note',
                    'order.totalPrice',
                    'order.quantity',
                    'order.paymentmethod',
                    'order.status',
                    'order.created_at',
                    'order.discount',
                    'order.ship',
                    DB::raw('users.name username'),
                    DB::raw('users.address as addressuser'),
                )
                ->first()
                ->toArray();
            $myDate = $order['created_at'];
            $date = Carbon::createFromFormat('m/d/Y', $myDate)->addDay(5)->format('Y-m-d');
            $orderdetails = Product::with('Img')
                ->join('brand', 'brand.id', 'product.brand')
                ->join('category', 'product.category_id', 'category.id')
                ->join('orderdetail', 'product.id', 'orderdetail.product_id')->where('orderdetail.order_id', $request->input('id'))
                ->select(
                    'product.id',
                    'product.product_name',
                    'orderdetail.price',
                    'orderdetail.quantity',
                    'brand.brand_name',
                    'category.category_name',
                    DB::raw('(orderdetail.quantity*orderdetail.price) as totalPrice'),
                )
                ->get()->toArray();
            sendMail::dispatch($order, $orderdetails, $date);
            // return redirect()->back();
            return response()->json(['success' => 'Thành công'], 200);
        } catch (Throwable $e) {
            // return redirect()->back();
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}

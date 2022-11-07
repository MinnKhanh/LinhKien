<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Printorder extends Component
{
    public $idorder;
    public $order;
    public $date;
    public $orderdetails;
    public function mount()
    {
        $this->order = Order::where('order.id', $this->idorder)
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
        $myDate = $this->order['created_at'];
        $this->date = Carbon::createFromFormat('m/d/Y', $myDate)->addDay(5)->format('Y-m-d');
        $this->orderdetails = Product::with('Img')
            ->join('orderdetail', 'product.id', 'orderdetail.product_id')
            ->join('brand', 'brand.id', 'product.brand')
            ->join('category', 'product.category_id', 'category.id')
            ->where('orderdetail.order_id', $this->idorder)
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
    }
    public function render()
    {
        return view('livewire.orders.printorder');
    }
}

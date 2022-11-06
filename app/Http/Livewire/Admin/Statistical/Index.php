<?php

namespace App\Http\Livewire\Admin\Statistical;

use App\Models\Categories;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $dataproduct;
    public $datacategory;
    public $data;
    public $datauser;
    public $typedata = 1;
    public $typechart;
    public function render()
    {
        if ($this->typechart == 1) {
            $subquery = Order::join('orderdetail', 'orderdetail.order_id', 'order.id')->select(DB::raw('orderdetail.*'));
            $this->data = Product::leftJoinSub($subquery, 'orderdetails', function ($join) {
                $join->on('product.id', '=', 'orderdetails.product_id');
            })
                ->groupby('product.id', 'product.product_name')
                ->select(
                    'product.id',
                    'product.product_name',
                    DB::raw('ifnull(sum(orderdetails.quantity),0) as count'),
                    DB::raw('ifnull(sum(orderdetails.quantity*(orderdetails.price-product.import_price)),0) as proceed')
                )->get()->toArray();
        } elseif ($this->typechart == 2) {
            $this->data = Product::join('orderdetail', 'orderdetail.product_id', 'product.id')
                ->join('order', 'order.id', 'orderdetail.order_id')
                ->rightjoin('category', 'product.category_id', 'category.id')
                ->groupby('category.id', 'category.category_name')
                ->select(
                    'category.id',
                    'category.category_name',
                    DB::raw('ifnull(sum(orderdetail.quantity),0) as count'),
                    DB::raw('ifnull(sum(orderdetail.quantity*(orderdetail.price-product.import_price)),0) as proceed')
                )->get()->toArray();
        } else {
            $this->data = User::leftjoin('order', 'order.user', 'users.id')
                ->groupby('users.id', 'users.name')
                ->select(
                    'users.id',
                    'users.name',
                    DB::raw('ifnull(sum(order.quantity),0) as count'),
                    DB::raw('ifnull(sum(order.totalPrice),0) as proceed')
                )->get()->toArray();
            // dd($this->data);
        }

        return view('livewire.admin.statistical.index');
    }
}

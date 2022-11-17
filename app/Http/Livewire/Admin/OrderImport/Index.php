<?php

namespace App\Http\Livewire\Admin\OrderImport;

use App\Exports\OrderImportExport;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class Index extends Component
{
    use WithPagination;
    public $searchFromDate;
    public $searchToDate;
    public $searchName;
    public $listorders;
    public $perPage;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->perPage = 2;
        $this->listorders = Order::where('type', 2)->get()->toArray();
    }
    public function render()
    {
        $query = $this->getQuery();
        $orders = $query->paginate($this->perPage);
        return view('livewire.admin.order-import.index', ['orders' => $orders]);
    }
    public function getQuery()
    {
        $query = Order::query()->where('type', 2)->where('type', 2);
        if ($this->searchName) {
            $query->where('order.name', 'like', '%' . trim($this->searchName) . '%');
        }
        if ($this->searchFromDate) {
            $query->whereDate('created_at', '>=', $this->searchFromDate);
        }
        if ($this->searchToDate) {
            $query->whereDate('created_at', '<=', $this->searchToDate);
        }
        return $query;
    }
    public function Export($id)
    {
        $order = Order::where('order.id', $id)->join('vendor', 'vendor.id', 'order.user');
        $data = $order->join('orderdetail', 'orderdetail.order_id', 'order.id')
            ->join('product', 'product.id', 'orderdetail.product_id')
            ->select(
                DB::raw(
                    'product.product_name as name,
                orderdetail.price as price,
                orderdetail.quantity as count,
                (orderdetail.price*orderdetail.quantity) as totalPrice'
                )
            )
            ->get();
        $info = $order->select(
            DB::raw('vendor.vendor_name as vendorname,vendor.vendor_address as address,order.totalPrice as price')
        )->first()->toArray();
        // dd($data, $info);
        return Excel::download(new OrderImportExport(
            $info['vendorname'],
            $info['address'],
            $info['price'],
            $data
        ), 'HoaDon' . date('Y-m-d-His') . '.xlsx');
    }
    public function removeOrder($id)
    {
        try {
            DB::beginTransaction();
            $order = Order::where('id', $id);
            $dataorder = $order->first();
            $orderdetail = OrderDetail::where('order_id', $dataorder->id)->get()->toArray();
            foreach ($orderdetail as $item) {
                $product = Product::where('id', $item['product_id'])->first();
                $count = $product->amount - $item['quantity'];
                $product->amount = $count < 0 ? 0 : $count;
                $product->save();
            }
            OrderDetail::where('order_id', $dataorder->id)->delete();
            $order->delete();
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
            return;
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xóa thất bại']);
            return;
        }
    }
}

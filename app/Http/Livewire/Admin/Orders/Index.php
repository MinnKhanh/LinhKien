<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Exports\OrderDetailExport;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\FuncCall;
use Throwable;

class Index extends Component
{
    use WithPagination;
    public $searchFromDate;
    public $searchToDate;
    public $searchName;
    public $status;
    protected $paginationTheme = 'bootstrap';
    public $perPage;
    public $check = 0;
    protected $listeners = ['changestatus' => 'changeStatus'];
    public function updatingSearchFromDate()
    {
        $this->resetPage();
    }
    public function updatingSearchToDate()
    {
        $this->resetPage();
    }
    public function updatingSearchName()
    {
        $this->resetPage();
    }
    public function updatingStatus()
    {
        $this->resetPage();
    }
    public function changeStatus($data)
    {
        try {
            Order::where('id', $data[0])->update([
                'status' => $data[1]
            ]);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Cập nhật thất bại']);
        }
    }
    public function mount()
    {
        $this->perPage = 4;
    }
    public function render()
    {

        $query = $this->getQuery();
        $orders = $query->paginate($this->perPage);
        // dd($orders);
        return view('livewire.admin.orders.index', ['orders' => $orders]);
    }

    public function getQuery()
    {
        $query = Order::query()->with('UserOrder');
        if ($this->searchName) {
            $query->where('order.name', 'like', '%' . trim($this->searchName) . '%');
        }
        if ($this->status) {
            $query->where('status', $this->status);
        }
        if ($this->searchFromDate) {
            $query->whereDate('created_at', '>=', $this->searchFromDate);
        }
        if ($this->searchToDate) {
            $query->whereDate('created_at', '<=', $this->searchToDate);
        }
        return $query;
    }
    public function resetData()
    {
        $this->searchFromDate = null;
        $this->searchToDate = null;
        $this->searchName = '';
        $this->status = 0;
    }
    public function Export($id)
    {
        $order = Order::where('order.id', $id)->join('users', 'users.id', 'order.user');
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
            DB::raw('users.name as username,users.address as address,order.totalPrice as price,order.discount')
        )->first()->toArray();
        // dd($data, $info);
        return Excel::download(new OrderDetailExport(
            $info['username'],
            $info['address'],
            $info['price'],
            $info['discount'],
            $data
        ), 'HoaDon' . date('Y-m-d-His') . '.xlsx');
    }
    public function removeOrder($id)
    {
        try {
            DB::beginTransaction();
            $order = Order::where('id', $id);
            $dataorder = $order->first();
            if ($dataorder->status < 3) {
                $orderdetail = OrderDetail::where('order_id', $dataorder->id)->get()->toArray();
                foreach ($orderdetail as $item) {
                    $product = Product::where('id', $item['product_id'])->first();
                    $product->amount = $product->amount + $item['quantity'];
                    $product->save();
                }
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

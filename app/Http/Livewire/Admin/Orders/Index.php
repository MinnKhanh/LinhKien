<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Index extends Component
{
    use WithPagination;
    public $orders;
    protected $paginationTheme = 'bootstrap';
    public $perPage;
    public function mount()
    {
        $this->perPage = 6;
        $this->orders = Order::join('users', 'users.id', 'order.user')->where('type', 1)->paginate($this->perPage);
    }
    public function render()
    {
        return view('livewire.admin.orders.index');
    }
    public function removeOrder($id)
    {
        try {
            DB::beginTransaction();
            $order = Order::where('id', $id);
            $dataorder = $order->get();
            if ($dataorder->status < 3) {
                $orderdetail = OrderDetail::where('order_id', $dataorder->id)->get()->toArray();
                foreach ($orderdetail as $item) {
                    $product = Product::where('id', $item['product_id'])->first();
                    $product = $product->amount + $item['quantity'];
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

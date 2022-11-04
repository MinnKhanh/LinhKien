<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Img;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Index extends Component
{
    use WithPagination;
    public $perPage;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->perPage = 6;

        // dd($this->products);
    }
    public function render()
    {
        $products = Product::with('Img')->paginate($this->perPage);
        return view('livewire.admin.product.index', ['products' => $products]);
    }
    public function removeProduct($id)
    {
        try {
            $countorder = 0;
            $countorder = OrderDetail::where('order_id', $id)->count();
            if ($countorder) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Không thể xóa vì có hóa đơn liên quan đến sản phẩm này']);
                return;
            } else {
                DB::beginTransaction();
                Img::where('product_id', $id)->where('image_type', 'App\Models\Product')->delete();
                Product::where('id', $id)->delete();
                DB::commit();
                $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
                return;
            }
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xóa thất bại']);
            return;
        }
    }
    public function changeStatus($id, $status)
    {
        // dd(Product::where('id', $id)->first());
        Product::where('id', $id)->update([
            'status' => $status
        ]);
        return;
    }
}

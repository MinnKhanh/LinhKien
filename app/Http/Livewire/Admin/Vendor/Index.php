<?php

namespace App\Http\Livewire\Admin\Vendor;

use App\Models\Img;
use App\Models\Order;
use App\Models\Vendor;
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
        $vendors = Vendor::with('Img')->paginate($this->perPage);
        return view('livewire.admin.vendor.index', ['vendors' => $vendors]);
    }
    public function removeVendor($id)
    {
        try {
            $countorder = 0;
            $countorder = Order::where('user', $id)->where('type', 2)->count();
            if ($countorder) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Không thể xóa vì có hóa đơn liên quan đến nhà cung cấp này']);
                return;
            } else {
                DB::beginTransaction();
                Img::where('product_id', $id)->where('image_type', 'App\Models\Vendor')->delete();
                Vendor::where('id', $id)->delete();
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
}

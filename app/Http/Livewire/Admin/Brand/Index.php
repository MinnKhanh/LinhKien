<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Img;
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
    }
    public function render()
    {
        $brands = Brand::with('Img')->paginate($this->perPage);
        return view('livewire.admin.brand.index', ['brands' => $brands]);
    }
    public function removeBrand($id)
    {
        try {
            $countproduct = 0;
            $countproduct = Product::where('brand', $id)->count();
            if ($countproduct) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Không thể xóa vì vẫn còn sản phầm thuộc nhãn hàng này']);
                return;
            } else {
                DB::beginTransaction();
                Img::where('product_id', $id)->where('image_type', 'App\Models\Brand')->delete();
                Brand::where('id', $id)->delete();
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

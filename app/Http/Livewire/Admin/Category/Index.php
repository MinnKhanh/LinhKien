<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Categories;
use App\Models\Img;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\ErrorHandler\Throwing;
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
        $categories = Categories::with('Img')->paginate($this->perPage);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
    public function removeCategory($id)
    {
        try {
            $countproduct = 0;
            $countproduct = Product::where('category_id', $id)->count();
            if ($countproduct) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Không thể xóa vì vẫn còn sản phầm thuộc nhóm này']);
                return;
            } else {
                DB::beginTransaction();
                Img::where('product_id', $id)->where('image_type', 'App\Models\Product')->delete();
                Categories::where('id', $id)->delete();
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

<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Enums\Typediscount;
use App\Models\Discount;
use App\Models\Img;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Index extends Component
{
    use WithPagination;
    public $perPage;
    protected $listeners = ['changeApply' => 'changeApply'];
    public function mount()
    {
        $this->perPage = 4;
    }
    public function render()
    {
        $listdata = Discount::with('Img')->paginate($this->perPage);
        return view('livewire.admin.discount.index', ['listdata' => $listdata]);
    }
    public function removeDiscount($id)
    {
        DB::beginTransaction();
        try {
            DB::table('discount_detail')->where('id_discount', $id)->delete();
            DB::table('discount_user')->where('id_discount', $id)->delete();
            Discount::where('id', $id)->delete();
            Img::where('product_id', $id)->where('image_type', 'App\Models\Discount')->delete();
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xóa thất bại']);
        }
    }
    public function changeApply($data)
    {
        if (($data[2] == Typediscount::BYPRODUCT) && $data[0] == 1) {
            Discount::where('relation_id', $data[3])->update([
                'apply' => 0
            ]);
        }
        Discount::where('id', $data[1])->update([
            'apply' => $data[0]
        ]);
        $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
    }
}

<?php

namespace App\Http\Livewire\Admin\Introduce;

use App\Models\Img;
use App\Models\Introduce;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $type = 1;
    public $perPage;
    public $active;
    public function mount()
    {
        $this->perPage = 4;
    }
    public function render()
    {
        $introduces = Introduce::with('Img')->where('type', $this->type);
        $introduces = $introduces->paginate($this->perPage);
        return view('livewire.admin.introduce.index', ['introduces' => $introduces]);
    }
    public function changeActive($id)
    {
        if ($id) {
            $introduce = Introduce::where('id', $id)->first();
            $introduce->active = $introduce->active == 1 ? 0 : 1;
            $introduce->save();
        }
    }
    public function removeIntro($id)
    {
        if ($id) {
            Img::where('product_id', $id)->where('image_type', 'App\Models\Introduce')->delete();
            Introduce::where('id', $id)->delete();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
        } else {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Xóa thất bại, vui lòng thử lại sau']);
        }
    }
}

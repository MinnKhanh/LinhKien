<?php

namespace App\Http\Livewire\Admin\Introduce;

use App\Models\Discount;
use App\Models\Img;
use App\Models\Introduce;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Editintrodiscount extends Component
{
    public $title;
    public $discount;
    public $description;
    public $link;
    public $photo;
    public $discounts;
    public $img;
    public $active = 0;
    public $isedit;
    use WithFileUploads;
    public function mount()
    {
        if ($this->isedit) {
            $intro = Introduce::with('Img')->where('id', $this->isedit)->first();
            $this->title = $intro->title;
            $this->description = $intro->description;
            $this->link = $intro->link;
            $this->discount = $intro->relate_id;
            $this->img = isset($intro['img'][0]) ? $intro['img'][0]['image_name'] : '';
            $this->active = $intro->active;
        }
        $this->discounts = Discount::get()->toArray();
    }
    public function render()
    {
        return view('livewire.admin.introduce.editintrodiscount');
    }
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            'discount' => 'required',
            'active' => 'required',
            'photo' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        try {
            DB::beginTransaction();
            $intro = new Introduce();
            if ($this->isedit) {
                $intro = Introduce::where('id', $this->isedit)->first();
            }
            $intro->title = $this->title;
            $intro->link = $this->link;
            $intro->relate_id = $this->discount;
            $intro->description = $this->description;
            $intro->index = 1;
            $intro->type = 1;
            $intro->active = $this->active;
            $intro->save();
            if ($this->photo) {
                Img::where('product_id', $intro->id)->where('image_type', 'App\Models\Introduce')->delete();
                $logo = $this->photo->store('public/introduce');
                $logo = str_replace("public/introduce/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $intro->id,
                    'image_type' => 'App\Models\Introduce',
                ]);
                $this->img = Img::where('product_id', $intro->id)->where('image_type', 'App\Models\Introduce')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->isedit ? 'Cập nhật thành công' : 'Tạo thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' =>  $e->getMessage()]);
            return;
        }
    }
}

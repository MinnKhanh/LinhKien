<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Categories;
use App\Models\Img;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Createorupdate extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $img = '';
    public $photo;
    public $isedit;
    public function render()
    {
        if ($this->isedit) {
            $category = Categories::with('Img')->where('id', $this->isedit)->first()->toArray();
            $this->name = $category['category_name'];
            $this->description = $category['description'];
            $this->img = isset($category['img'][0]) ? $category['img'][0]['image_name'] : '';
            // dd($this->listimg);
        }
        return view('livewire.admin.category.createorupdate');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|min:6',
            'description' => 'required',
            'photo' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        try {
            DB::beginTransaction();
            $category = new Categories();
            if ($this->isedit) {
                $category = Categories::where('id', $this->isedit)->first();
            }
            $category->category_name = $this->name;
            $category->description = $this->description;
            $category->save();
            if ($this->photo) {
                Img::where('product_id', $category->id)->where('image_type', 'App\Models\Categories')->delete();
                $logo = $this->photo->store('public/product');
                $logo = str_replace("public/product", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $category->id,
                    'image_type' => 'App\Models\Categories',
                ]);
                $this->img = Img::where('product_id', $category->id)->where('image_type', 'App\Models\Categories')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->isedit ? 'Cập nhật thành công' : 'Tạo thành công']);
            if (!$this->isedit)
                $this->resetdata();

            return;
            // return redirect()->route('shop.index');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xảy ra lỗi không thể tạo']);
            return;
        }
    }
    public function resetdata()
    {
        $this->name = '';
        $this->description = '';
        $this->photo = NULL;
        $this->img = '';
    }
}

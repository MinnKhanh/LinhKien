<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Img;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Createorupdate extends Component
{
    use WithFileUploads;
    public $name;
    public $nation;
    public $website;
    public $description;
    public $img = '';
    public $photo;
    public $isedit;
    public function render()
    {
        if ($this->isedit) {
            $brand = Brand::with('Img')->where('id', $this->isedit)->first()->toArray();
            $this->name = $brand['brand_name'];
            $this->description = $brand['brand_description'];
            $this->website = $brand['brand_website'];
            $this->nation = $brand['brand_nation'];
            $this->img = isset($brand['img'][0]) ? $brand['img'][0]['image_name'] : '';
            // dd($this->img);
        }
        return view('livewire.admin.brand.createorupdate');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'nation' => 'required',
            'website' => 'required',
            'photo' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        try {
            DB::beginTransaction();
            $brand = new Brand();
            if ($this->isedit) {
                $brand = Brand::where('id', $this->isedit)->first();
            }
            $brand->brand_name = $this->name;
            $brand->brand_description = $this->description;
            $brand->brand_website = $this->website;
            $brand->brand_nation = $this->nation;
            $brand->save();
            if ($this->photo) {
                Img::where('product_id', $brand->id)->where('image_type', 'App\Models\Brand')->delete();
                $logo = $this->photo->store('public/brand');
                $logo = str_replace("public/brand/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $brand->id,
                    'image_type' => 'App\Models\Brand',
                ]);
                $this->img = Img::where('product_id', $brand->id)->where('image_type', 'App\Models\Brand')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->isedit ? 'Cập nhật thành công' : 'Tạo thành công']);
            if (!$this->isedit) {
                $this->resetdata();
            }

            return;
            // return redirect()->route('shop.index');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
    public function resetdata()
    {
        $this->name = '';
        $this->website = '';
        $this->description = '';
        $this->nation = '';
        $this->photo = NULL;
    }
}

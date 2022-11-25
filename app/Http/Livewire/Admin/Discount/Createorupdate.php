<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Enums\Typediscount;
use App\Models\Discount;
use App\Models\Img;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Createorupdate extends Component
{
    use WithFileUploads;
    public $name;
    public $products;
    public $type = 1;
    public $code;
    public $unit = 1;
    public $photo;
    public $price;
    public $begin;
    public $end;
    public $product;
    public $description;
    public $img;
    public $isedit;
    public $apply = 1;
    public function mount()
    {
        $this->products = Product::get()->toArray();
        if ($this->isedit) {
            $discount = Discount::with('Img')->where('id', $this->isedit)->first();
            $this->name = $discount->name;
            $this->type = $discount->type;
            $this->code = $discount->code;
            $this->unit = $discount->unit;
            $this->price = $discount->percent;
            $this->begin = $discount->begin;
            $this->end = $discount->end;
            $this->product = $discount->relation_id;
            $this->description = $discount->description;
            $this->apply = $discount->apply;
            $this->img = isset($discount['img'][0]) ? $discount['img'][0]['image_name'] : '';
        }
    }
    public function render()
    {
        if ($this->type != Typediscount::BYPRODUCT) {
            $this->product = null;
        }
        return view('livewire.admin.discount.createorupdate');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'code' => 'required',
            'type' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'begin' => 'required|date|before:end',
            'end' => 'required|date|after:begin',
            'apply' => 'required',
            'photo' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        try {
            DB::beginTransaction();
            $discount = new Discount();
            if ($this->isedit) {
                $discount = Discount::where('id', $this->isedit)->first();
            }
            if ($this->product && $this->apply == 1) {
                Discount::where('relation_id', $this->product)->update([
                    'apply' => 0
                ]);
            }
            $discount->name = $this->name;
            $discount->type = $this->type;
            $discount->code = $this->code;
            $discount->unit = $this->unit;
            $discount->begin = $this->begin;
            $discount->end = $this->end;
            $discount->description = $this->description;
            $discount->percent = $this->price;
            $discount->relation_id = $this->product;
            $discount->apply = $this->apply;
            $discount->save();

            if ($this->photo) {
                Img::where('product_id', $discount->id)->where('image_type', 'App\Models\Discount')->delete();
                $logo = $this->photo->store('public/discount');
                $logo = str_replace("public/discount/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $discount->id,
                    'image_type' => 'App\Models\Discount',
                ]);
                $this->img = Img::where('product_id', $discount->id)->where('image_type', 'App\Models\Discount')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->isedit ? 'Cập nhật thành công' : 'Tạo thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $this->isedit ? 'Cập nhật thất bại' : 'Tạo thất bại']);
        }
    }
}

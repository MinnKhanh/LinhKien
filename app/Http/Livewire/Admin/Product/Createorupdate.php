<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Img;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Createorupdate extends Component
{
    use WithFileUploads;
    public $name;
    public $category;
    public $importprice;
    public $price;
    public $quantity;
    public $brand;
    public $description;
    public $listcategories;
    public $brands;
    public $isedit;
    public $trend;
    public $status;
    public $photos;
    public $listimg;
    public $code;
    public function mount()
    {
        if ($this->isedit) {
            $product = Product::with('Img')->where('id', $this->isedit)->first()->toArray();
            $this->name = $product['product_name'];
            $this->category = $product['category_id'];
            $this->importprice = $product['import_price'];
            $this->price = $product['price'];
            $this->quantity = $product['amount'];
            $this->brand = $product['brand'];
            $this->description = $product['description'];
            $this->status = $product['status'] ? true : false;
            $this->trend = $product['trend'] ? true : false;
            $this->listimg = $product['img'];
            $this->code = $product['code'];
            // dd($this->listimg);
        }
        $this->listcategories = Categories::pluck('category_name', 'id');
        $this->brands = Brand::pluck('brand_name', 'id');
    }
    public function render()
    {
        // if ($this->photos) {
        //     dd($this->photos);
        // }
        return view('livewire.admin.product.createorupdate');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|min:6',
            'category' => 'required',
            'importprice' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'brand' => 'required',
            'description' => 'required',
            'photos.*' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif',
            'code' => 'required|unique:product,code',
        ]);
        try {
            DB::beginTransaction();
            $product = new Product();
            if ($this->isedit) {
                $product = Product::where('id', $this->isedit)->first();
            }
            $product->product_name = $this->name;
            $product->category_id = $this->category;
            $product->import_price = $this->importprice;
            $product->price = $this->price;
            $product->brand = $this->brand;
            $product->amount = $this->quantity;
            $product->description = $this->description;
            $product->status = $this->status ? $this->status : 0;
            $product->code = $this->code;
            $product->trend = $this->trend ? $this->trend : 0;
            $product->save();
            if ($this->photos) {
                foreach ($this->photos as $photo) {
                    $logo = $photo->store('public/product');
                    $logo = str_replace("public/product", "", $logo);
                    Img::create([
                        'image_name' => $logo,
                        'product_id' => $product->id,
                        'image_type' => 'App\Models\Product',
                    ]);
                }
                $this->listimg = Img::where('product_id', $product->id)->where('image_type', 'App\Models\Product')->get()->toArray();
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
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
        $this->category = null;
        $this->importprice = null;
        $this->price = null;
        $this->quantity = null;
        $this->brand = null;
        $this->description = '';
        $this->photos = null;
        $this->status = true;
        $this->trend = false;
    }
    public function removeImg($id, $index)
    {
        try {
            DB::beginTransaction();
            Img::where('id', $id)->delete();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa ảnh thành công']);
            unset($this->listimg[$index]);
            DB::commit();
            return;
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Không thể xóa']);
            DB::rollBack();
            return;
        }
    }
}

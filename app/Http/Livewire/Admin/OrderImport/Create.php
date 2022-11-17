<?php

namespace App\Http\Livewire\Admin\OrderImport;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Create extends Component
{
    public $photo;
    public $listProducts;
    public $quantity = 0;
    public $price = 0;
    public $product;
    public $category;
    public $importprice = 0;
    public $listCategories;
    public $brand;
    public $brands;
    public $vendor;
    public $vendors;
    public $listproductimport = [];
    protected $listeners = ['changeCart' => 'changeCart'];
    public function changeCart($data)
    {
        if ($data[1] == 0) {
            unset($this->listproductimport[$data[0]]);
        } else {
            $this->listproductimport[$data[0]]['quantity'] = $data[1];
        }
        Session::put('cart', $this->listproductimport);
        return;
    }
    public function mount(Request $request)
    {
        $this->listProducts = Product::with('Img')->get()->toArray();
        $this->listCategories = Categories::with('Img')->get()->toArray();
        $this->brands = Brand::with('Img')->get()->toArray();
        $this->vendors = Vendor::with('Img')->get()->toArray();
        if ($request->session()->has('cart')) {
            $this->listproductimport = $request->session()->get('cart') ? $request->session()->get('cart')  : [];
        }
    }
    public function render()
    {
        $this->getQuery();
        // if ($this->listproductimport)
        //     dd($this->listproductimport);
        return view('livewire.admin.order-import.create');
    }
    public function getQuery()
    {
        $productinfo = Product::query()->with('Img');
        if ($this->product) {
            $productinfo = $productinfo->where('id', $this->product)->first();
            $this->brand = $productinfo->brand;
            $this->category = $productinfo->category_id;
            $this->price = $productinfo->price;
            $this->importprice = $productinfo->import_price;
        }
        return;
    }
    public function change()
    {
        $this->listProducts = Product::query()->with('Img');
        if ($this->product) {
            $this->product = 0;
            $this->price = 0;
            $this->importprice = 0;
        }
        if ($this->brand) {
            $this->listProducts->where('brand', $this->brand);
        }
        if ($this->category) {
            $this->listProducts->where('category_id', $this->category);
        }
        $this->listProducts = $this->listProducts->get()->toArray();
    }
    public function addProduct(Request $request)
    {
        if ($this->quantity > 0) {
            if (array_key_exists($this->product, $this->listproductimport)) {
                $this->listproductimport[$this->product]['quantity'] += $this->quantity;
            } else {
                $productinfo = Product::with('Img')->where('id', $this->product)->first();
                $this->listproductimport[$this->product] = ['productInfo' => $productinfo, 'price' => $this->price, 'importprice' => $this->importprice, 'quantity' => $this->quantity];
            }
        } else {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Vui lòng nhập sô lương hợp lệ lớn hơn hoặc bằng không']);
        }
        Session::put('cart', $this->listproductimport);
        return;
    }
    public function checkout()
    {
        return redirect()->route('admin.orderimport.checkout');
    }
    public function removeFromCart($id)
    {
        unset($this->listproductimport[$id]);
        Session::put('cart', $this->listproductimport);
    }
}

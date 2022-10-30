<?php

namespace App\Http\Livewire\Shop;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination;
    protected $perPage;
    public $category;
    public $brand;
    public $price;
    public $typefilter = 'created_at';
    public $filter = 'asc';
    public $nameSearch;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->perPage = 6;
    }
    public function render()
    {
        // if ($this->filter) {
        //     dd('chay');
        // }
        $products = Product::with('Img');

        if ($this->category)
            $products->where('category_id', $this->category);
        if ($this->nameSearch)
            $products->where('product_name', 'like', '%' . trim($this->nameSearch) . '%');
        if ($this->brand)
            $products->where('brand', $this->brand);
        if ($this->price) {
            $rangprice = explode('-', $this->price);
            $products->where('price', '>=', $rangprice[0]);
            if (!empty($rangprice[1])) {
                $products->where('price', '<=', $rangprice[1]);
            }
        }
        if ($this->filter && $this->typefilter) {
            $products->orderBy($this->typefilter, $this->filter);
        }
        $categoies = Categories::get()->toArray();
        $brands = Brand::get()->toArray();
        // if ($this->category) {
        //     dd($products);
        // }
        $products = $products->paginate(6);
        return view('livewire.shop.list-product', ['categories' => $categoies, 'products' => $products, 'brands' => $brands]);
    }
    public function addToCart($user_id, $product_id, $quantity, $price_product, $name)
    {
        $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Mã danh mục phụ tùng đã tồn ']);
        // $cart = Cart::where('user', $user_id)->where('product', $product_id);
        // $isexsts = Cart::where('user', $user_id)->where('product', $product_id)->count();
        // if (!$isexsts) {
        //     $cart = new Cart();
        //     $cart->user = $user_id;
        //     $cart->product = $product_id;
        //     $cart->quantity = $quantity;
        //     $cart->price = $price_product;
        //     $cart->total_price = $price_product;
        //     $cart->product_name = $name;
        // } else {
        //     $cart->quantity = $cart->quantity + $quantity;
        //     $cart->total_price = ($price_product * $quantity) + $cart->total_price;
        // }
        // $cart->save();
    }
    public function updatingNameSearch()
    {
        $this->resetPage();
    }
    public function updatingCategory()
    {
        $this->resetPage();
    }
    public function updatingPrice()
    {
        $this->resetPage();
    }
    public function updatingFilter()
    {
        $this->resetPage();
    }
    public function updatingTypefilter()
    {
        $this->resetPage();
    }
}

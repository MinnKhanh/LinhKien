<?php

namespace App\Http\Livewire\Shop;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\Favorite;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

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
    public function addToCart($user_id = null, $product_id = null, $quantity = null, $price_product = null, $name = null)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('id', $product_id)->first();
            if ($product->amount < $quantity)
                throw new Exception("Thêm thất bại", 400);
            $cart = Cart::where('user', $user_id)->where('product', $product_id);
            $isexsts = $cart->count();
            if (!$isexsts) {
                $cart = new Cart();
                $cart->user = $user_id;
                $cart->product = $product_id;
                $cart->quantity = $quantity;
                $cart->price = $price_product;
                $cart->product_name = $name;
                $cart->save();
            } else {
                $oldcart = $cart->first();
                $cart->update([
                    'quantity' => $oldcart->quantity + $quantity,
                ]);
            }
            $product->update([
                'amount' => $product->amount - $quantity
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Thêm thành công"]);
        } catch (Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Thêm thất bại"]);
            return;
        }
    }
    public function addFavorite($product)
    {
        DB::beginTransaction();
        try {
            if (Favorite::where('product', $product)->where('user', 1)->count())
                throw new Exception("Đã có trong danh sách yêu thích", 400);
            Favorite::create([
                'user' => 1,
                'product' => $product
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Đã thêm vào danh sách yêu thích"]);
        } catch (Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' =>  $th->getMessage()]);
            return;
        }
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
    public function updatingBrand()
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

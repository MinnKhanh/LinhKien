<?php

namespace App\Http\Livewire;


use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
use Livewire\Component;

class Test extends Component
{
    protected $perPage;
    public $category;
    public $name123;
    public function mount()
    {
        $this->perPage = 6;
    }
    public function render()
    {
        $categoies = Categories::get()->toArray();
        $products = Product::with('Img')->paginate($this->perPage);
        $brands = Brand::get()->toArray();
        return view('livewire.shop.list-product', ['categories' => $categoies, 'products' => $products, 'brands' => $brands]);
    }
}

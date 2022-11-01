<?php

namespace App\Http\Livewire\Shop;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class DetailProduct extends Component
{
    public $product_id;
    public $product;
    public $listProductSuggest;
    public $quantity = 1;
    public function mount()
    {
        $this->product = Product::with('Img')->where('id', $this->product_id)->first()->toArray();
        $this->listProductSuggest = Product::with('Img')->where('id', '!=', $this->product_id)->where('category_id', $this->product['category_id'])->skip(0)->take(4)->get()->toArray();
    }
    public function render()
    {
        return view('livewire.shop.detail-product');
    }
    public function addToCart()
    {
        DB::beginTransaction();
        try {
            $product = Product::where('id', $this->product['id'])->first();
            if ($product->amount < $this->quantity)
                throw new Exception("Sản không đủ", 400);
            $cart = Cart::where('user', 1)->where('product', $this->product['id']);
            $isexsts = $cart->count();
            if (!$isexsts) {
                $cart = new Cart();
                $cart->user = 1;
                $cart->product = $this->product['id'];
                $cart->quantity = $this->quantity;
                $cart->price = $this->product['price'];
                $cart->product_name = $this->product['product_name'];
                $cart->save();
            } else {
                $oldcart = $cart->first();
                $cart->update([
                    'quantity' => $oldcart->quantity + $this->quantity
                ]);
            }
            $product->update([
                'amount' => $product->amount - $this->quantity
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Thêm thành công"]);
        } catch (Throwable $th) {
            DB::rollBack();
            $this->quantity = 0;
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $th->getMessage()]);
            return;
        }
    }
}

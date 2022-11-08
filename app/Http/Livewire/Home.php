<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;
use Throwable;

class Home extends Component
{
    public $bestsellers;
    public $newarrival;
    public function mount()
    {
        $this->bestsellers = Product::with('Img')->join('orderdetail', 'orderdetail.product_id', 'product.id')->groupby('product.id', 'product.product_name', 'product.price')->select('product.id', 'product.product_name', 'product.price', DB::raw('count(product.id) as solan'))->orderby('solan', 'desc')->skip(0)->take(8)->get()->toArray();
        $this->newarrival = Product::with('Img')->orderby('created_at', 'desc')->skip(0)->take(8)->get()->toArray();
    }
    public function render()
    {
        return view('livewire.home');
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
            if (Favorite::where('product', $product)->where('user', auth()->user()->id)->count())
                throw new Exception("Đã có trong danh sách yêu thích", 400);
            Favorite::create([
                'user' => auth()->user()->id,
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
}

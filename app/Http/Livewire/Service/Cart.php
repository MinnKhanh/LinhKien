<?php

namespace App\Http\Livewire\Service;

use App\Models\Cart as ModelsCart;
use App\Models\Discount;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Throwable;

class Cart extends Component
{
    public $carts;
    public $data = [];
    public $check = 0;
    public $discountcode = '';
    public $discountprice = 0;
    protected $listeners = ['changeCart' => 'changeCart'];
    public function mount()
    {
    }
    public function render()
    {
        $this->carts = Product::with("Img")->join('cart', 'cart.product', 'product.id')->where('user', 1)->get()->toArray();
        $this->data = Product::with("Img")->join('cart', 'cart.product', 'product.id')->where('user', 1)->pluck('quantity', 'id')->toArray();
        return view('livewire.service.cart');
    }
    public function changeCart($data)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('id', intval($data[0]))->first();
            $cart = ModelsCart::where('user', 1)->where('product', intval($data[0]));
            if (intval($data[1]) <= 0) {
                $product->amount = $product->amount + $this->data[$data[0]];
                $product->save();
                $cart->delete();
            } else {
                $product = Product::where('id', intval($data[0]))->first();
                if ($product->amount + intval($this->data[$data[0]]) < intval($data[1])) {
                    // $this->data[$data[0]] = $this->data[$data[0]];
                    throw new Exception("Đã quá số lượng trong kho", 400);
                }
                $cart->update([
                    'quantity' => $data[1],
                ]);
                $amount = $product->amount + intval($this->data[$data[0]]) - intval($data[1]);
                $product->amount = $amount;
                $product->save();
                $this->data[$data[0]] = intval($data[1]);
            }
            DB::commit();
            return;
        } catch (Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $th->getMessage()]);
            $this->render();
            return;
        }
    }
    public function addDiscount()
    {
        try {
            if (!$this->discountcode)
                throw new Exception('Vui lòng nhập mã giảm giá', 400);
            $discount = Discount::where('code', $this->discountcode)->whereDate('begin', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
            $exists = $discount->count();
            if ($exists) {
                $discount = $discount->first();
                $totalPrice = ModelsCart::where('user', 1)->sum(DB::raw('quantity*price'));
                if ($discount->unit == 1) {
                    $this->discountprice = (floatval($discount->percent) * $totalPrice) / 100;
                } else {
                    $this->discountprice = $discount->percent;
                }
                $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Sử dụng mã giảm giá thành công"]);
            } else {
                throw new Exception('Mã này không tồn tại hoặc đã hết hạn', 400);
            }
            return;
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
    public function checkout()
    {
        $quantityincart = Product::with("Img")->join('cart', 'cart.product', 'product.id')->where('user', 1)->sum('quantity');
        if ($quantityincart <= 0) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Hiện không có sản phẩm trong giỏ hàng']);
            return;
        } else {
            return Redirect::route('cart.checkout', $this->discountcode ? ['discount' => $this->discountcode] : []);
        }
    }
}

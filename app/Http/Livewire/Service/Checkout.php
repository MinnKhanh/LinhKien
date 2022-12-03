<?php

namespace App\Http\Livewire\Service;

use App\Enums\Ship;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Throwable;

class Checkout extends Component
{
    public $carts;
    public $totalPrice;
    public $name;
    public $country;
    public $address;
    public $city;
    public $district;
    public $phone;
    public $email;
    public $note;
    public $payment = 1;
    public $discounts;
    public $ship = Ship::NOITHANH;
    public $quantity;
    protected $listeners = ['checkout' => 'checkout'];
    public $discount;
    public $discountprice = 0;
    public function mount(Request $request)
    {
        // $cart = Cart::where('user', auth()->user()->id);
        DB::enableQueryLog();

        $this->carts = Product::with(["Img", 'Discount' => fn ($query) =>
        $query->where('apply', 1)->whereDate('Discount.begin', '<=', date('Y-m-d'))->whereDate('Discount.end', '>=', date('Y-m-d'))])->join('cart', 'cart.product', 'product.id')->where('user', auth()->user()->id)->get()->toArray();
        $datacart = array_reduce($this->carts, function ($carry, $item) {
            if (count($item['discount'])) {
                if ($item['discount'][0]['unit'] == 1) {
                    $carry[0] += $item['price'] * (1 - $item['discount'][0]['percent'] / 100) * $item['quantity'];
                } else {
                    $carry[0] += ($item['price'] - $item['discount'][0]['percent']) * $item['quantity'];
                }
            } else {
                $carry[0] += $item['price'] * $item['quantity'];
            }
            $carry[1] += $item['quantity'];
            return $carry;
        }, [0, 0]);
        // dd($this->totalPrice);
        $this->totalPrice = $datacart[0];
        $this->quantity = $datacart[1];
        $this->discounts = Discount::join('discount_user', 'discount_user.id_discount', 'discount.id')->where('discount_user.use', 0)->where('discount_user.id_customer', auth()->user()->id)
            ->get()->toArray();
        if (auth()->check()) {
            // dd(auth()->user()->address);
            $this->name = auth()->user()->name;
            $this->address = auth()->user()->address;
            $this->city = auth()->user()->city;
            $this->district = auth()->user()->district;
            $this->phone = auth()->user()->phone;
            $this->email = auth()->user()->email;
        }
    }
    public function render()
    {
        $this->dispatchBrowserEvent('paypal');
        if ($this->city != 'Hà Nội' && $this->city) {
            $this->ship = Ship::NGOAITHANH;
        } else {
            $this->ship = Ship::NOITHANH;
        }
        $this->applyDiscount();
        return view('livewire.service.checkout');
    }
    public function checkout()
    {
        $this->submit();
    }
    public function submit()
    {
        $this->validate([
            'name' => 'required|min:6',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'district' => 'required',
            'phone' => 'required|regex:/[0-9]{9}/',
            'payment' => 'required',
            'email' => 'required|email',
        ]);
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->user = auth()->user()->id;
            $order->name = $this->name;
            $order->address = $this->address;
            $order->city = $this->city;
            $order->district = $this->district;
            $order->note = $this->note ? $this->note : '';
            $order->phone = $this->phone;
            $order->email = $this->email;
            $order->discount = $this->discountprice;
            $order->ship = $this->ship;
            $order->type = 1;
            $order->totalPrice = $this->totalPrice;
            $order->quantity = $this->quantity;
            $order->status = 1;
            $order->paymentmethod = intval($this->payment);
            $order->save();
            foreach ($this->carts as $item) {
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $item['product'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
            Cart::where('user', auth()->user()->id)->delete();
            if ($this->discount) {
                $discount = Discount::where('code', $this->discount)->first();
                DB::table('discount_user')->where('id_customer', auth()->user()->id)->where('id_discount', $discount->id)->update([
                    'use' => 1
                ]);
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
            return Redirect::route('shop.index');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Xảy ra lỗi không thể tạo háo đơn']);
            return;
        }
    }
    public function applyDiscount()
    {
        if ($this->discount) {
            $this->discountcode = $this->discount;
            $discount = Discount::where('code', $this->discountcode)->first();

            if ($discount->unit == 1) {
                if ($discount->type == 3) {
                    $this->discountprice = (floatval($discount->percent) * $this->ship) / 100;
                } else {
                    $this->discountprice = (floatval($discount->percent) * $this->totalPrice) / 100;
                }
            } else {
                if ($discount->type == 3 && $discount->percent >= $this->ship) {
                    $this->discountprice = $this->ship;
                } else $this->discountprice = $discount->percent;
            }
        }
    }
}

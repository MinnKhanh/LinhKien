<?php

namespace App\Http\Livewire\Service;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDetail;
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
    public $payment;
    public $discountcode;
    public $ship;
    public $quantity;
    public $discount;
    public $discountprice = 0;
    public function mount(Request $request)
    {
        $cart = Cart::where('user', auth()->user()->id);
        $this->totalPrice = $cart->sum(DB::raw('quantity*price'));
        $this->quantity = $cart->sum(DB::raw('quantity'));
        $this->carts = $cart->get()->toArray();
        if ($this->discount) {
            $this->discountcode = $this->discount;
            $discount = Discount::where('code', $this->discountcode)->first();
            if ($discount->unit == 1) {
                $this->discountprice = (floatval($discount->percent) * $this->totalPrice) / 100;
            } else {
                $this->discountprice = $discount->percent;
            }
        }
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
        return view('livewire.service.checkout');
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
            if ($this->city != 'Hà Nội') {
                $this->ship = 10000;
            } else {
                $this->ship = 50000;
            }
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
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
            return Redirect::route('shop.index');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Xảy ra lỗi không thể tạo háo đơn']);
            return;
        }
    }
}

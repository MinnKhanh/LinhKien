<?php

namespace App\Http\Livewire\Admin\OrderImport;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Throwable;

class Checkout extends Component
{
    public $listproductimport;
    public $vendor;
    public $vendors;
    public $email;
    public $note;
    public $phone;
    public $address;
    public function mount(Request $request)
    {
        $this->vendors = Vendor::with('Img')->get()->toArray();
        $this->listproductimport = $request->session()->get('cart');
    }
    public function render()
    {
        if ($this->vendor) {
            $vendor = Vendor::where('id', $this->vendor)->first();
            $this->phone = $vendor->vendor_phone;
            $this->email = $vendor->email;
            $this->address = $vendor->vendor_address;
        }
        return view('livewire.admin.order-import.checkout');
    }
    public function createOrder()
    {
        try {
            DB::beginTransaction();
            if ($this->listproductimport) {
                $sum = array_reduce($this->listproductimport, function ($carry, $item) {
                    return $carry + ($item['importprice'] * $item['quantity']);
                });
                $order = new Order();
                $order->user = $this->vendor;
                $order->name = Vendor::where('id', $this->vendor)->first()->vendor_name;
                $order->address = $this->address;
                $order->phone = $this->phone;
                $order->email = $this->email;
                $order->note = $this->note;
                $order->type = 2;
                $order->quantity = array_sum(array_column($this->listproductimport, 'quantity'));
                $order->status = 3;
                $order->totalPrice = $sum;
                $order->save();
                foreach ($this->listproductimport as $key => $item) {
                    $product = Product::where('id', $key)->first();
                    $product->price = $item['price'];
                    $product->import_price = $item['importprice'];
                    $product->amount = $product->amount + $item['quantity'];
                    $product->save();
                    $orderdetail = new OrderDetail();
                    $orderdetail->order_id = $order->id;
                    $orderdetail->product_id = $key;
                    $orderdetail->price = $item['importprice'];
                    $orderdetail->quantity = $item['quantity'];
                    $orderdetail->save();
                }
            }
            DB::commit();
            Session::forget('cart');
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
            return redirect()->route('admin.orderimport.create');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Tạo thất bại']);
            return;
        }
    }
}

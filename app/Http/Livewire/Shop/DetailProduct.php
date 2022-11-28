<?php

namespace App\Http\Livewire\Shop;

use App\Models\Cart;
use App\Models\Img;
use App\Models\Product;
use App\Models\Rate;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class DetailProduct extends Component
{
    use WithFileUploads;
    public $product_id;
    public $product;
    public $star = 0;
    public $active = 1;
    public $message;
    public $listProductSuggest;
    public $quantity = 0;
    public $photos;
    public $listimg;
    public $myrate;
    public $create = 1;
    public $listrates;
    public function mount()
    {
        $this->listrates = Rate::with('Img')->join('users', 'users.id', 'id_customer')->where('id_product', $this->product_id)->select(DB::raw('users.name,rate.review,rate.number_stars,rate.id,rate.id_customer,id_product,rate.created_at'))->get()->toArray();
        // dd($this->listrates);
        $this->myrate  =  Rate::where('id_customer', auth()->user()->id)->where('id_product', $this->product_id)->first();
        if ($this->myrate) {
            $this->create = 2;
        }
        $this->product = Product::with('Img')->where('id', $this->product_id)->first()->toArray();
        $this->listProductSuggest = Product::with('Img')->where('id', '!=', $this->product_id)->where('category_id', $this->product['category_id'])->skip(0)->take(4)->get()->toArray();
    }
    public function changeActive($data)
    {
        $this->active = $data;
    }
    public function update()
    {
        $this->create = 1;
    }
    public function render()
    {
        // if ($this->quantity) {

        //     dd($this->quantity);
        // }
        $this->dispatchBrowserEvent('star');
        return view('livewire.shop.detail-product');
    }
    public function addToCart()
    {
        DB::beginTransaction();
        try {
            $product = Product::where('id', $this->product['id'])->first();
            if ($this->quantity <= 0)
                throw new Exception("Vui lòng nhập số lương lớn hơn không", 400);
            if ($product->amount < $this->quantity)
                throw new Exception("Sản không đủ", 400);
            $cart = Cart::where('user', auth()->user()->id)->where('product', $this->product['id']);
            $isexsts = $cart->count();
            if (!$isexsts) {
                $cart = new Cart();
                $cart->user = auth()->user()->id;
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
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $th->getMessage()]);
            $this->quantity = 0;
            // return;
        }
    }
    public function resetData()
    {
        $this->star = 0;
        $this->message = null;
        $this->photos = null;
        $this->listimg = null;
    }
    public function sendMessage()
    {
        // dd($this->star);
        if ($this->star && $this->message) {
            try {
                DB::beginTransaction();
                $rate = Rate::where('id_customer', auth()->user()->id)->where('id_product', $this->product_id)->first();
                if (!$rate) {
                    $rate = new Rate();
                }
                $rate->id_product = $this->product_id;
                $rate->id_customer = auth()->user()->id;
                $rate->number_stars = $this->star;
                $rate->review = $this->message;
                $rate->save();
                Img::where('product_id', $rate->id)->where('image_type', 'App\Models\Rate')->delete();
                if ($this->photos) {
                    foreach ($this->photos as $photo) {
                        $logo = $photo->store('public/rate');
                        $logo = str_replace("public/rate", "", $logo);
                        Img::create([
                            'image_name' => $logo,
                            'product_id' => $rate->id,
                            'image_type' => 'App\Models\Rate',
                        ]);
                    }
                    $this->listimg = Img::where('product_id', $rate->id)->where('image_type', 'App\Models\Rate')->get()->toArray();
                }
                DB::commit();
                $this->create = 2;
                $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
                $this->listrates = Rate::with('Img')->join('users', 'users.id', 'id_customer')->where('id_product', $this->product_id)->select(DB::raw('users.name,rate.review,rate.number_stars,rate.id,rate.id_customer,id_product,rate.created_at'))->get()->toArray();
                $this->resetData();
                return;
            } catch (Throwable $e) {
                DB::rollBack();
                $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xảy ra lỗi không thể tạo']);
                return;
            }
        } else {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'warning' => 'Vui lòng nhập đầy đủ trường thông tin đánh giá']);
        }
    }
}

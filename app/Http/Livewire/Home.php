<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\DiscountUser;
use App\Models\Favorite;
use App\Models\Introduce;
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
    public $brands;
    public $slides;
    public $discounts;
    public $check;
    protected $listeners = ['addDiscountToUser' => 'addDiscountToUser'];
    public function mount()
    {
        $this->bestsellers = Product::with('Img')->join('orderdetail', 'orderdetail.product_id', 'product.id')->groupby('product.id', 'product.product_name', 'product.price')->select('product.id', 'product.product_name', 'product.price', DB::raw('count(product.id) as solan'))->orderby('solan', 'desc')->skip(0)->take(8)->get()->toArray();
        $this->newarrival = Product::with('Img')->orderby('created_at', 'desc')->skip(0)->take(8)->get()->toArray();
        $this->brands = Brand::with('Img')->skip(0)->take(3)->get()->toArray();
        $this->slides = Introduce::with('Img')->where('type', 2)->where('index', '>', 0)->orderBy('index', 'asc')->get()->toArray();
        $this->discounts = Introduce::with(['Img', 'Discount' => function ($q) {
            $q->with(['DiscountDetail', 'DiscountUser' => function ($q) {
                if (auth()->check()) $q->where('discount_user.id_customer', auth()->user()->id);
            }])->whereDate('begin', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
        }])->where('introduces.type', 1)
            ->join('discount', 'discount.id', 'introduces.relate_id')
            ->select(DB::raw('introduces.*,begin,end,percent,unit,name,discount.description as descripdiscount, apply,discount.type as typediscount'), DB::raw('IF(CURDATE()>BEGIN and CURDATE()<END, 1, 0) AS expiry'))->get()->toArray();
        // dd($this->discounts);
    }
    public function addDiscountToUser($id)
    {
        if ($id[0] && auth()->check()) {
            $discountuser =   DB::table('discount_user')->where('id_customer', auth()->user()->id)->where('id_discount', $id[0])->first();
            if (!$discountuser) {
                DB::table('discount_user')->insert([
                    'id_customer' => auth()->user()->id,
                    'id_discount' => $id[0],
                    'use' => 0
                ]);
                $this->discounts = Introduce::with(['Img', 'Discount' => function ($q) {
                    $q->with(['DiscountDetail', 'DiscountUser' => function ($q) {
                        if (auth()->check()) $q->where('discount_user.id_customer', auth()->user()->id);
                    }])->whereDate('begin', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
                }])->where('introduces.type', 1)
                    ->join('discount', 'discount.id', 'introduces.relate_id')
                    ->select(DB::raw('introduces.*,begin,end,percent,unit,name,discount.description as descripdiscount, apply,discount.type as typediscount'), DB::raw('IF(CURDATE()>BEGIN and CURDATE()<END, 1, 0) AS expiry'))->get()->toArray();
                $this->check = 4;
                $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Thêm thành công"]);
            } else {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Đã được nhận trên tài khoản này"]);
            }
        } else {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Không thể nhận"]);
        }
    }
    public function render()
    {
        // if ($this->check) {
        //     dd('lau');
        // }
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
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Nhận thành công"]);
        } catch (Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Nhận thất bại"]);
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

<?php

namespace App\Http\Livewire\Service;

use App\Models\Discount;
use App\Models\DiscountUser;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Coupons extends Component
{
    public $listcoupons;
    public function mount()
    {
        $this->listcoupons = Discount::with('Img')->join('discount_user', 'discount.id', 'discount_user.id_discount')
            ->where('discount_user.id_customer', auth()->user()->id)
            ->select(DB::raw('discount.*'), DB::raw('IF(CURDATE()>BEGIN and CURDATE()<END, 1, 0) AS expiry'))
            ->get()->toArray();
    }
    public function render()
    {
        return view('livewire.service.coupons');
    }
}

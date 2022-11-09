<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Main extends Component
{
    public $customernumber;
    public $orders;
    public $ordersnumber;
    public $sales;
    public function render()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $this->orders = Order::whereMonth('created_at', $month)->whereYear('order.created_at', $year);
        $this->ordersnumber = $this->orders->count();
        $this->sales = $this->orders->sum('totalPrice');
        $this->customernumber = User::join('model_has_permissions', 'model_has_permissions.model_id', 'users.id')->where('permission_id', '!=', 1)->count();

        // dd($this->customernumber);
        return view('livewire.admin.main');
    }
}

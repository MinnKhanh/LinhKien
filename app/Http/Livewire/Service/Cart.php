<?php

namespace App\Http\Livewire\Service;

use Livewire\Component;

class Cart extends Component
{
    public $name = '';
    public $check = 1;
    public function render()
    {
        // dd('chau');
        if ($this->check) {
            $this->check = 0;
        } else dd('chau');
        return view('livewire.service.cart');
    }
}

<?php

namespace App\Http\Livewire\Admin\Introduce;

use App\Models\Introduce;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $type = 1;
    public $perPage;
    public $active;
    public function mount()
    {
        $this->perPage = 4;
    }
    public function render()
    {
        $introduces = Introduce::with('Img')->where('type', $this->type);
        $introduces = $introduces->paginate($this->perPage);
        return view('livewire.admin.introduce.index', ['introduces' => $introduces]);
    }
    public function changeActive($id)
    {
        if ($id) {
            $introduce = Introduce::where('id', $id)->first();
            $introduce->active = $introduce->active == 1 ? 0 : 1;
            $introduce->save();
        }
    }
}

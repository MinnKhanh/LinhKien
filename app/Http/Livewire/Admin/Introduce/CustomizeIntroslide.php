<?php

namespace App\Http\Livewire\Admin\Introduce;

use App\Models\Introduce;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class CustomizeIntroslide extends Component
{
    public $introduces;
    public $index;
    public $item = 0;
    public function mount()
    {
        $this->introduces = Introduce::where('type', 2)->get()->toArray();
    }
    public function render()
    {
        if ($this->index && $this->item == 0) {
            $intro = Introduce::where('type', 2)->where('index', $this->index)->first();
            $this->item = $intro ?  $intro->id : null;
        }
        return view('livewire.admin.introduce.customize-introslide');
    }
    public function store()
    {
        $this->validate([
            'item' => 'required',
            'index' => 'required',
        ]);
        try {
            DB::beginTransaction();
            Introduce::where('type', 2)->where('index', $this->index)->update([
                'index' => 0
            ]);
            Introduce::where('type', 2)->where('id', $this->item)->update([
                'index' => $this->index
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' =>  'Cập nhật thất bại']);
            return;
        }
    }
}

<?php

namespace App\Http\Livewire\Service;

use App\Models\Comment;
use App\Models\InformationShop;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class Contact extends Component
{
    public $infor;
    public $name;
    public $email;
    public $message;
    public function mount()
    {
        $this->infor = InformationShop::with('Img')->first();
    }
    public function render()
    {
        return view('livewire.service.contact');
    }
    public function sendMessage()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'message' => 'required'
        ]);
        try {
            DB::beginTransaction();
            Comment::updateOrCreate(
                [
                    'email' => $this->email,
                    'type' => 2
                ],
                [
                    'name' => $this->name,
                    'comment' => $this->message
                ]
            );
            $this->name = null;
            $this->email = null;
            $this->message = null;
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Gửi thành công']);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' =>  'Sảy ra một sô lỗi vui lòng thử lại sau']);
            return;
        }
    }
}

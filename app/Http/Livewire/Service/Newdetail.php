<?php

namespace App\Http\Livewire\Service;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class Newdetail extends Component
{
    public $data;
    public $comment;
    public $name;
    public $email;
    public $new;
    public function mount()
    {
        if ($this->new) {
            $this->data = News::with(['Img', 'User' => function ($q) {
                $q->with('Img');
            }])->where('id', $this->new)->first()->toArray();
            // dd($this->data['user']['img']);
        } else
            return redirect()->back();
    }
    public function render()
    {
        return view('livewire.service.newdetail');
    }
    public function sendComment()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'comment' => 'required'
        ]);
        try {
            DB::beginTransaction();
            Comment::updateOrCreate(
                [
                    'email' => $this->email,
                    'type' => 1
                ],
                [
                    'name' => $this->name,
                    'comment' => $this->comment
                ]
            );
            $this->name = null;
            $this->email = null;
            $this->comment = null;
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Gửi thành công']);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' =>  'Sảy ra một sô lỗi vui lòng thử lại sau']);
            return;
        }
    }
}

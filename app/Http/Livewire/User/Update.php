<?php

namespace App\Http\Livewire\User;

use App\Models\Brand;
use App\Models\Img;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Update extends Component
{
    use WithFileUploads;
    public $user;
    public $name;
    public $email;
    public $address;
    public $phone;
    public $city;
    public $district;
    public $gender;
    public $age;
    public $img = '';
    public $photo;
    public function mount()
    {
        $this->user = User::with('Img')->where('id', auth()->user()->id)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->address = $this->user->address;
        $this->phone = $this->user->phone;
        $this->city = $this->user->city;
        $this->district = $this->user->district;
        $this->gender = $this->user->gender;
        $this->age = $this->user->age;
        $this->img = isset($this->user->img[0]) ? $this->user->img[0]->image_name : '';
    }
    public function render()
    {
        return view('livewire.user.update');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $user = User::where('id', auth()->user()->id)->first();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->address = $this->address;
            $user->phone = $this->phone;
            $user->city = $this->city;
            $user->district = $this->district;
            $user->gender = $this->gender;
            $user->age = $this->age;
            $user->save();
            if ($this->photo) {
                Img::where('product_id', auth()->user()->id)->where('image_type', 'App\Models\User')->delete();
                $logo = $this->photo->store('public/user');
                $logo = str_replace("public/user/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => auth()->user()->id,
                    'image_type' => 'App\Models\User',
                ]);
                $this->img = Img::where('product_id', auth()->user()->id)->where('image_type', 'App\Models\User')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
            return;
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
}

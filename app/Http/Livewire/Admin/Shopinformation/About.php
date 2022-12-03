<?php

namespace App\Http\Livewire\Admin\Shopinformation;

use App\Models\Img;
use App\Models\InformationShop;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class About extends Component
{
    use WithFileUploads;
    public $nation;
    public $message;
    public $address;
    public $coordinates;
    public $photo;
    public $img;
    public $phone;
    public $email;
    public $name;
    public $accountbank;
    public $namebank;
    public $infor;
    public function mount()
    {
        $this->infor = InformationShop::with('Img')->first();
        if ($this->infor) {
            $this->name = $this->infor->name;
            $this->email = $this->infor->email;
            $this->phone = $this->infor->phone;
            $this->namebank = $this->infor->namebank;
            $this->accountbank = $this->infor->accountbank;
            $this->nation = $this->infor->nation;
            $this->message = $this->infor->message;
            $this->coordinates = $this->infor->coordinates;
            $this->address = $this->infor->address;
            $this->img = isset($this->infor['img'][0]) ? $this->infor['img'][0]['image_name'] : '';
        }
    }
    public function render()
    {
        return view('livewire.admin.shopinformation.about');
    }
    public function store()
    {
        $this->validate([
            'message' => 'required',
            'address' => 'required',
            'nation' => 'required',
            'coordinates' => 'required',
            'photo' => $this->infor ? '' : 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        try {
            DB::beginTransaction();
            $infor = $this->infor;
            if (!$this->infor) {
                $infor = new InformationShop();
            }
            $infor->nation = $this->nation;
            $infor->message = $this->message;
            $infor->coordinates = $this->coordinates;
            $infor->address = $this->address;
            $infor->accountbank = $this->accountbank;
            $infor->namebank = $this->namebank;
            $infor->name = $this->name;
            $infor->phone = $this->phone;
            $infor->email = $this->email;
            $infor->save();
            if ($this->photo) {
                Img::where('product_id', $infor->id)->where('image_type', 'App\Models\InformationShop')->delete();
                $logo = $this->photo->store('public/introduce');
                $logo = str_replace("public/introduce/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $infor->id,
                    'image_type' => 'App\Models\InformationShop',
                ]);
                $this->img = Img::where('product_id', $infor->id)->where('image_type', 'App\Models\InformationShop')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->infor ? 'Cập nhật thành công' : 'Tạo thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $this->infor ? 'Cập nhật thất bại' : 'Tạo thất bại']);
            return;
        }
    }
}

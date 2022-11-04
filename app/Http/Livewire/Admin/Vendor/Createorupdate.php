<?php

namespace App\Http\Livewire\Admin\Vendor;

use Livewire\Component;
use App\Models\Img;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Throwable;

class Createorupdate extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $address;
    public $phone;
    public $website;
    public $img = '';
    public $photo;
    public $isedit;
    public function render()
    {
        if ($this->isedit) {
            $vendor = Vendor::with('Img')->where('id', $this->isedit)->first()->toArray();
            $this->name = $vendor['vendor_name'];
            $this->email = $vendor['email'];
            $this->address = $vendor['vendor_address'];
            $this->phone = $vendor['vendor_phone'];
            $this->website = $vendor['vendor_website'];
            $this->img = isset($vendor['img'][0]) ? $vendor['img'][0]['image_name'] : '';
            // dd($this->img);
        }
        return view('livewire.admin.vendor.createorupdate');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'website' => 'required',
            'photo' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        try {
            DB::beginTransaction();
            $vendor = new Vendor();
            if ($this->isedit) {
                $vendor = Vendor::where('id', $this->isedit)->first();
            }
            $vendor->vendor_name = $this->name;
            $vendor->email = $this->email;
            $vendor->vendor_address = $this->address;
            $vendor->vendor_phone = $this->phone;
            $vendor->vendor_website = $this->website;
            $vendor->save();
            if ($this->photo) {
                Img::where('product_id', $vendor->id)->where('image_type', 'App\Models\Vendor')->delete();
                $logo = $this->photo->store('public/vendor');
                $logo = str_replace("public/vendor/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $vendor->id,
                    'image_type' => 'App\Models\Vendor',
                ]);
                $this->img = Img::where('product_id', $vendor->id)->where('image_type', 'App\Models\Vendor')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->isedit ? 'Cập nhật thành công' : 'Tạo thành công']);
            if (!$this->isedit) {
                $this->resetdata();
            }

            return;
            // return redirect()->route('shop.index');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
    public function resetdata()
    {
        $this->name = '';
        $this->website = '';
        $this->description = '';
        $this->nation = '';
        $this->photo = NULL;
    }
}

<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\Img;
use App\Models\Role;
use App\Models\RoleHasPermisson;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Throwable;

class Edit extends Component
{
    use WithFileUploads;
    public $name;
    public $password = '';
    public $passwordconfirm;
    public $email;
    public $phone;
    public $permission;
    public $photo;
    public $img;
    public $isedit;
    public $address;
    public $gender;
    public $age;
    public function mount()
    {
        if ($this->isedit) {
            $user = User::with('Img')->where('id', $this->isedit)->first();
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->age = $user->age;
            $this->gender = $user->gender;
            $this->address = $user->address;
            $this->img = isset($user['img'][0]) ? $user['img'][0]['image_name'] : '';
            $this->permission = $user->getAllPermissions()[0]->id;
        }
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
    public function render()
    {
        return view('livewire.admin.customers.edit');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'address' => 'required',
            'age' => 'required',
            'password' =>  $this->isedit ? '' : 'required',
            'passwordconfirm' =>  $this->isedit ? '' : 'required|same:password',
            'gender' => 'required',
            'phone' => 'required',
            'photo' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif',
        ]);
        try {

            DB::beginTransaction();
            $user = new User();
            if ($this->isedit) {
                $user = User::where('id', $this->isedit)->first();
            }
            $user->name = $this->name;
            $user->email = $this->email;
            $user->address = $this->address;
            $user->age = $this->age;
            if (($this->isedit && $this->password) || !$this->isedit) {
                $user->password = Hash::make($this->password);
            }
            $user->gender = $this->gender;
            $user->phone = $this->phone;
            $user->save();
            $user->syncRoles($this->permission);
            $rolePermissions = RoleHasPermisson::whereIn('role_id', [$this->permission])->get()->pluck('permission_id')->unique()->toArray();
            $user->permissions()->sync($rolePermissions);
            if ($this->photo) {
                Img::where('product_id', $user->id)->where('image_type', 'App\Models\User')->delete();
                $logo = $this->photo->store('public/user');
                $logo = str_replace("public/user/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $user->id,
                    'image_type' => 'App\Models\User',
                ]);
                $this->img = Img::where('product_id', $user->id)->where('image_type', 'App\Models\User')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->isedit ? 'Cập nhật thành công' : 'Tạo thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
        }
    }
}

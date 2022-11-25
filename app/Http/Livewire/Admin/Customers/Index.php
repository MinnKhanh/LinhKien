<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\Role;
use App\Models\RoleHasPermisson;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Index extends Component
{
    use WithPagination;
    public $searchName;
    public $searchPhone;
    public $searchEmail;
    public $permission = 2;
    protected $paginationTheme = 'bootstrap';
    public $searchCreateDate;
    public $perPage;
    public $rolesUser;
    protected $listeners = ['changeRole' => 'changeRole'];
    public function mount()
    {
        $this->perPage = 4;
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
    public function render()
    {
        $customers = $this->getQuery();
        $customers = $customers->paginate($this->perPage);
        return view('livewire.admin.customers.index', ['customers' => $customers]);
    }
    public function changeRole($data)
    {
        // dd($data);
        $user = User::where('id', $data[1])->first();
        $user->syncRoles($data[0]);
        $rolePermissions = RoleHasPermisson::whereIn('role_id', [$data[0]])->get()->pluck('permission_id')->unique()->toArray();
        $user->permissions()->sync($rolePermissions);
        $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
    }
    public function getQuery()
    {
        $query = User::query()->with('Img')
            ->join('model_has_permissions', 'model_has_permissions.model_id', 'users.id')->where('permission_id', $this->permission);
        if ($this->searchName) {
            $query->where(
                'name',
                'like',
                '%' . $this->searchName . '%'
            );
        }
        if ($this->searchPhone) {
            $query->where(
                'phone',
                'like',
                '%' . $this->searchPhone . '%'
            );
        }
        if ($this->searchEmail) {
            $query->where('email', 'like', '%' . $this->searchEmail . '%');
        }
        if ($this->searchCreateDate) {
            $query->whereDate('created_at', '>=', $this->searchCreateDate);
        }
        return $query;
    }
    public function removeUser($id)
    {
        DB::beginTransaction();
        try {
            User::where('id', $id)->delete();
            DB::table('model_has_permissions')->where('model_id', $id)->delete();
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
            return;
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xóa thất bại']);
            return;
        }
    }
}

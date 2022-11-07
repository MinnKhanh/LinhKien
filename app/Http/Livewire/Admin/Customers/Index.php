<?php

namespace App\Http\Livewire\Admin\Customers;

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
    protected $paginationTheme = 'bootstrap';
    public $searchCreateDate;
    public $perPage;
    public function mount()
    {
        $this->perPage = 5;
    }
    public function render()
    {
        $customers = $this->getQuery();
        $customers = $customers->paginate($this->perPage);
        return view('livewire.admin.customers.index', ['customers' => $customers]);
    }
    public function getQuery()
    {
        $query = User::query()->with('Img');
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

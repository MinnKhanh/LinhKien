<?php

namespace App\Http\Livewire\Admin\Shopinformation;

use App\Models\Img;
use App\Models\News;
use Livewire\Component;

class Listnews extends Component
{
    public $perPage;
    public $searchTitle;
    public function mount()
    {
        $this->perPage = 6;
    }
    public function render()
    {
        $listnews = News::query()->with('Img');
        if ($this->searchTitle) {
            $listnews->where('title', 'like', '%' . trim($this->searchTitle) . '%');
        }
        $listnews = $listnews->paginate($this->perPage);
        return view('livewire.admin.shopinformation.listnews', ['listnews' => $listnews]);
    }
    public function removeNew($id)
    {
        if ($id) {
            Img::where('product_id', $id)->where('image_type', 'App\Models\News')->delete();
            News::where('id', $id)->delete();
        }
    }
}

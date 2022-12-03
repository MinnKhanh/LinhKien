<?php

namespace App\Http\Livewire\Admin\Shopinformation;

use App\Models\Img;
use App\Models\News as ModelsNews;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class News extends Component
{
    use WithFileUploads;
    public $img;
    public $photo;
    public $isedit;
    public $title;
    public $description;
    public $content;
    public function mount()
    {
        if ($this->isedit) {
            $new = ModelsNews::with('Img')->where('id', $this->isedit)->first();
            $this->title = $new->title;
            $this->content = $new->content;
            $this->description = $new->description;
            $this->img = isset($new['img'][0]) ? $new['img'][0]['image_name'] : '';
        }
    }
    public function render()
    {
        $this->dispatchBrowserEvent('ckeditor');
        return view('livewire.admin.shopinformation.news');
    }
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'photo' => $this->isedit ? '' : 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        try {
            DB::beginTransaction();
            $new = new ModelsNews();
            if ($this->isedit) {
                $new = ModelsNews::where('id', $this->isedit)->first();
            }
            $new->user = auth()->user()->id;
            $new->title = $this->title;
            $new->content = $this->content;
            $new->description = $this->description;
            $new->save();
            if ($this->photo) {
                Img::where('product_id', $new->id)->where('image_type', 'App\Models\News')->delete();
                $logo = $this->photo->store('public/news');
                $logo = str_replace("public/news/", "", $logo);
                Img::create([
                    'image_name' => $logo,
                    'product_id' => $new->id,
                    'image_type' => 'App\Models\News',
                ]);
                $this->img = Img::where('product_id', $new->id)->where('image_type', 'App\Models\News')->get()->toArray()[0]['image_name'];
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => $this->isedit ? 'Cập nhật thành công' : 'Tạo thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
}

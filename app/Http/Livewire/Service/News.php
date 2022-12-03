<?php

namespace App\Http\Livewire\Service;

use App\Models\News as ModelsNews;
use Livewire\Component;

class News extends Component
{
    public $perPage;
    public function mount()
    {
        $this->perPage = 6;
    }
    public function render()
    {
        $news = ModelsNews::with('Img')->paginate($this->perPage);
        return view('livewire.service.news', ['news' => $news]);
    }
}

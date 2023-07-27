<?php

namespace App\Http\Livewire\Components\Template;

use App\Models\ProductBrand;
use Livewire\Component;

class FrontFilters extends Component
{
    public $page;

    public function mount($page)
    {
        $this->page = $page;
    }

    public function render()
    {
        $data = [];
        return view('livewire.components.template.front-filters');
    }
}

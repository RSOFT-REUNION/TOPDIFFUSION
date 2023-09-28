<?php

namespace App\Http\Livewire\Components\Template;

use App\Models\ProductCategory;
use Livewire\Component;

class FrontMenu extends Component
{
    public $active_tab = '';

    public function changeTab($tab)
    {
        $this->active_tab = $tab;
    }

    public function render()
    {
        $data = [];
        $data['menus'] = ProductCategory::where('level', 1)->get();
        $data['menus_level_2'] = ProductCategory::where('level', 2)->get();
        $data['menus_level_3'] = ProductCategory::where('level', 3)->get();
        return view('livewire.components.template.front-menu', $data);
    }
}

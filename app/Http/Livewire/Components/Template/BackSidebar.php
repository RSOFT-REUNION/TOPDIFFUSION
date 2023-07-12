<?php

namespace App\Http\Livewire\Components\Template;

use Livewire\Component;

class BackSidebar extends Component
{
    public $group, $page;

    public function mount($group, $page)
    {
        $this->group = $group;
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.components.template.back-sidebar');
    }
}

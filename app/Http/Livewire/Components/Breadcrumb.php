<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Breadcrumb extends Component
{

    public $crumbs = [];

    public function render()
    {
        return view('livewire.components.breadcrumb');
    }
}

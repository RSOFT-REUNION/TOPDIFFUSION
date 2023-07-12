<?php

namespace App\Http\Livewire\Pages\Back\Settings;

use App\Models\ProductTaxes;
use Livewire\Component;

class Payment extends Component
{
    public function render()
    {
        $data = [];
        $data['taxes'] = ProductTaxes::orderBy('rate', 'asc')->get();
        return view('livewire.pages.back.settings.payment', $data);
    }
}

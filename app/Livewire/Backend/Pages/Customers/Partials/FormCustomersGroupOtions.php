<?php

namespace App\Livewire\Backend\Pages\Customers\Partials;

use App\Models\UserGroup;
use Livewire\Component;

class FormCustomersGroupOtions extends Component
{
    public function render()
    {
        $data = [];
        $data['groups'] = UserGroup::orderBy('name', 'asc')->get();
        return view('livewire.backend.pages.customers.partials.form-customers-group-otions', $data);
    }
}

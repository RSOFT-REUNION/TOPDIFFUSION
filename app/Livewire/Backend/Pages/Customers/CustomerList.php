<?php

namespace App\Livewire\Backend\Pages\Customers;

use App\Models\User;
use Livewire\Component;

class CustomerList extends Component
{
    public function render()
    {
        $data = [];
        $data['customers'] = User::where('admin', 0)->orderBy('lastname', 'asc')->get();
        return view('livewire.backend.pages.customers.customer-list', $data);
    }
}

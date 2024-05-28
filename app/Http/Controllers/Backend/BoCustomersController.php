<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class BoCustomersController extends Controller
{
    // Affichage de la liste des clients (livewire)
    public function showCustomerList()
    {
        $data = [
            'group_page' => 'customers',
            'page' => 'list'
        ];
        return view('pages.backend.customers.customer-list', $data);
    }

    // Affichage de la liste des groupes de clients
    public function showCustomerGroup()
    {
        $data = [
            'group_page' => 'customers',
            'page' => 'group'
        ];
        $data['groups'] = UserGroup::all();
        return view('pages.backend.customers.customer-group', $data);
    }
}

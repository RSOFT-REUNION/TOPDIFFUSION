<?php

namespace App\Http\Livewire\Popups\Front\Maintenance;

use App\Models\SettingGeneral;
use LivewireUI\Modal\ModalComponent;

class MaintenanceLogin extends ModalComponent
{
    public function render()
    {
        $data = [];
        $data['page'] = 'Maintenance-login';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('livewire.popups.front.maintenance.maintenance-login');
    }
}

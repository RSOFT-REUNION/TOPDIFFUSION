<?php

namespace App\Http\Livewire\Popups\Front\Maintenance;

use App\Models\SettingGeneral;
use Livewire\Component;

class Maintenance extends Component
{

    public $maintenanceMode;

    public function mount()
    {
        $this->maintenanceMode = SettingGeneral::find(1)->value('maintenance_mode');
    }

    public function render()
    {
        $data = [];
        $data['maintenanceMode'] = $this->maintenanceMode;
        return view('livewire.popups.front.maintenance.maintenance');
    }
}

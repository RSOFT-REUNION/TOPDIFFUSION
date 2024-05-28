<?php

namespace App\Livewire\Backend\Pages\Settings;

use App\Models\TvaRate;
use Livewire\Component;

class PaymentSetting extends Component
{
    public function deleteTva($id)
    {
        $tva = TvaRate::find($id);
        if($tva->delete()) {
            $this->dispatch('refreshLines');
        }
    }

    public function render()
    {
        $data = [];
        $data['tvas'] = TvaRate::orderBy('id', 'desc')->get();
        return view('livewire.backend.pages.settings.payment-setting', $data);
    }
}

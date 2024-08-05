<?php

namespace App\Livewire\Backend\Pages\Settings;

use App\Helpers\ConfigHelper;
use App\Models\Setting;
use App\Models\ShippingPoint;
use App\Models\ShippingTaxe;
use Livewire\Component;

class ShippingSetting extends Component
{
    public $shippingActive;

    public function mount()
    {
        $this->shippingActive = ConfigHelper::getSettings()['shipping'];
    }

    public function deleteTax($id)
    {
        $tax = ShippingTaxe::find($id);
        $tax->delete();
    }

    public function deletePoint($id)
    {
        $point = ShippingPoint::find($id);
        $point->delete();
    }

    public function changeActiveShipping()
    {
        $state = $this->shippingActive == '1' ? '0' : '1';

        $data = [
            'shipping' => $state,
        ];

        // Ajout en base de données
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function render()
    {
        $data = [];
        $data['taxes'] = ShippingTaxe::orderBy('amount', 'asc')->get();
        $data['points'] = ShippingPoint::orderBy('name', 'asc')->get();
        return view('livewire.backend.pages.settings.shipping-setting', $data);
    }
}

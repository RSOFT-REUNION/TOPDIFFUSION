<?php

namespace App\Http\Livewire\Pages\Back\Settings;

use App\Models\SettingGeneral;
use Livewire\Component;

class Shipping extends Component
{
    public $setting;
    public $shipping_price, $shipping_limit;

    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount()
    {
        $this->setting = SettingGeneral::where('id', 1)->first();
        $this->shipping_price = SettingGeneral::where('id', 1)->first()->shipping_price;
        $this->shipping_limit = SettingGeneral::where('id', 1)->first()->shipping_limit;
    }

    // Permet de mettre à jour le prix de livraison
    public function updateShippingPrice()
    {
        $setting = $this->setting;
        $setting->shipping_price = $this->shipping_price;
        if($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    // Permet de mettre à jour le montant total pour que la livraison soit gratuite
    public function updateShippingLimit()
    {
        $setting = $this->setting;
        $setting->shipping_limit = $this->shipping_limit;
        if($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    public function render()
    {
        $data = [];
        $data['setting'] = $this->setting;
        return view('livewire.pages.back.settings.shipping', $data);
    }
}

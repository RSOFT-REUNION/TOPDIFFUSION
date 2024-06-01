<?php

namespace App\Livewire\Backend\Pages\Settings;

use App\Helpers\ConfigHelper;
use App\Models\Setting;
use App\Models\TvaRate;
use Livewire\Component;

class PaymentSetting extends Component
{
    public $payment_active, $payment_TTC, $TTC_show;

    public function mount()
    {
        $this->payment_active = ConfigHelper::getSettings()['payment'];
        $this->payment_TTC = ConfigHelper::getSettings()['payment_TTC'];
        $this->TTC_show = ConfigHelper::getSettings()['show_TTC'];
    }

    public function deleteTva($id)
    {
        $tva = TvaRate::find($id);
        if($tva->delete()) {
            $this->dispatch('refreshLines');
        }
    }

    public function changePaymentActive()
    {
        $state = $this->payment_active == '1' ? '0' : '1';

        $data = [
            'payment' => $state,
        ];

        // Ajout en base de données
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function changePaymentTTC()
    {
        $state = $this->payment_TTC == '1' ? '0' : '1';

        $data = [
            'payment_TTC' => $state,
        ];

        // Ajout en base de données
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function changeShowTTC()
    {
        $state = $this->TTC_show == '1' ? '0' : '1';

        $data = [
            'show_TTC' => $state,
        ];

        // Ajout en base de données
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function render()
    {
        $data = [];
        $data['tvas'] = TvaRate::orderBy('id', 'desc')->get();
        return view('livewire.backend.pages.settings.payment-setting', $data);
    }
}

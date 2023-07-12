<?php

namespace App\Http\Livewire\Components;

use App\Models\UserSetting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FrontProfessionnalSwitch extends Component
{
    public $switch = 0;

    protected $listeners = ['refreshLines' => '$refresh'];

    public function changeSettings()
    {
        $setting = UserSetting::where('user_id', auth()->user()->id)->first();
        switch ($setting->professionnal_prices)
        {
            case 0:
                $setting->professionnal_prices = 1;
                $setting->update();
                break;
            case 1:
                $setting->professionnal_prices = 0;
                $setting->update();
                break;
        }

        $this->emit('refreshLines');

    }

    public function render()
    {
        $data = [];
        $data['prices_pro'] = UserSetting::where('user_id', auth()->user()->id)->first()->professionnal_prices;
        return view('livewire.components.front-professionnal-switch', $data);
    }
}

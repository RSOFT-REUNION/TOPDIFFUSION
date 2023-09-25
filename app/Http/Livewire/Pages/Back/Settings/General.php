<?php

namespace App\Http\Livewire\Pages\Back\Settings;

use App\Models\CarrouselHome;
use App\Models\SettingGeneral;
use App\Models\UserSetting;
use Livewire\Component;

class General extends Component
{
    public $prices_mode, $professionnal, $CarrouselHome;

    public $maintenanceState;

    protected $listeners = ['maintenanceModeChanged' => 'updateMaintenanceState'];

    public function updateMaintenanceState($state)
    {
        $this->maintenanceState = $state;
    }
     
    public function mount()
    {
        $setting = SettingGeneral::where('id', 1)->first();
        $this->prices_mode = $setting->prices_type;
        $this->professionnal = $setting->professionnal_customers;
        $state = SettingGeneral::where('maintenance_mode', 1)->first();
        if($state) {
            $this->maintenanceState = $state->maintenance_mode == 1 ? 1 : 0;
        } else {
            $this->maintenanceState = 0;
        }
    }


    public function maintenance_mode()
    {
        $setting = SettingGeneral::where('id', 1)->first();

        if ($setting) {
            $maintenanceMode = $setting->maintenance_mode == 1 ? 0 : 1;
            $setting->maintenance_mode = $maintenanceMode;
            $setting->save();
            $this->emit('maintenanceModeChanged', $maintenanceMode);
        }
    }

    /*
     * Change setting B2B
     */
    public function B2B_mode()
    {
        $setting = SettingGeneral::where('id', 1)->first();
        switch ($setting->professionnal_customers) {
            case 0:
                $setting->professionnal_customers = 1;
                $setting->update();
                break;
            case 1:
                $setting->professionnal_customers = 0;
                $setting->update();
                break;
        }

        return redirect()->route('back.setting');
    }

    /*
     * Change setting bikes compatibility
     */
    public function bike_check()
    {
        $setting = SettingGeneral::where('id', 1)->first();
        switch ($setting->bikes_compatibility) {
            case 0:
                $setting->bikes_compatibility = 1;
                $setting->update();
                break;
            case 1:
                $setting->bikes_compatibility = 0;
                $setting->update();
                break;
        }

        return redirect()->route('back.setting');
    }

    public function prices_type()
    {
        $setting = SettingGeneral::where('id', 1)->first();
        $setting->prices_type = $this->prices_mode;
        if ($setting->update()) {
            return redirect()->route('back.setting');
        }
    }

    public function deleteCarousel($id)
    {
        $carousel = CarrouselHome::where('id', $id)->first();
        $carousel->delete();
        return redirect()->route('back.setting');
    }

    public function render()
    {
        $data = [];
        $data['settings'] = SettingGeneral::where('id', 1)->first();
        return view('livewire.pages.back.settings.general', $data);
    }
}

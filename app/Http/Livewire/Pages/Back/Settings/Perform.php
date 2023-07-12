<?php

namespace App\Http\Livewire\Pages\Back\Settings;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Perform extends Component
{
    public $output;
    public function clearCaches()
    {
        Artisan::call('optimize:clear');
        $this->output = Artisan::output();
    }

    public function render()
    {
        $data = [];
        $data['output'] = $this->output;
        return view('livewire.pages.back.settings.perform', $data);
    }
}

<?php

namespace App\Http\Livewire\Components\Front;

use App\Models\CarrouselHome;
use Livewire\Component;

class HeroBanner extends Component
{
    public function render()
    {
        $data = [];
        $data['HomeCarrousel'] = CarrouselHome::All();
        // dd($data['HomeCarrousel']);
        return view('livewire.components.front.hero-banner',$data);
    }
}

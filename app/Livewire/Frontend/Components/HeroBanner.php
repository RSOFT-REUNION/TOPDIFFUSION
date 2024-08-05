<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Bikes;
use Livewire\Component;

class HeroBanner extends Component
{
    public $kit_brand, $kit_model, $kit_cylinder, $kit_year;
    public $brands;
    public $models;
    public $cylinders;
    public $years;

    public function mount()
    {
        $this->brands = Bikes::groupBy('brand')->pluck('brand');
    }

    public function updatedKitBrand($value)
    {
        $this->cylinders = Bikes::where('brand', $value)
            ->groupBy('cylinder')
            ->pluck('cylinder');
        $this->models = null;
        $this->years = null;
        $this->kit_model = null;
        $this->kit_year = null;
        $this->kit_cylinder = null;
    }

    public function updatedKitCylinder($value)
    {
        $this->models = Bikes::where('brand', $this->kit_brand)
            ->where('cylinder', $value)
            ->groupBy('model')
            ->pluck('model');
        $this->years = null;
        $this->kit_model = null;
        $this->kit_year = null;
    }

    public function updatedKitModel($value)
    {
        $this->years = Bikes::where('brand', $this->kit_brand)
            ->where('cylinder', $this->kit_cylinder)
            ->where('model', $value)
            ->groupBy('year')
            ->pluck('year');
        $this->kit_year = null;
    }

    public function submit()
    {
        $this->validate([
            'kit_brand' => 'required',
            'kit_model' => 'required',
            'kit_cylinder' => 'required',
            'kit_year' => 'required',
        ]);

        $bike = Bikes::where('brand', $this->kit_brand)
            ->where('model', $this->kit_model)
            ->where('cylinder', $this->kit_cylinder)
            ->where('year', $this->kit_year)
            ->first();

        return to_route('fo.product.list.bikes', $bike->id);
    }


    public function render()
    {
        return view('livewire.frontend.components.hero-banner');
    }
}

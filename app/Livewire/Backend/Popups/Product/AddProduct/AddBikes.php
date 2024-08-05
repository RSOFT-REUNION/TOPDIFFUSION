<?php

namespace App\Livewire\Backend\Popups\Product\AddProduct;

use App\Models\Bikes;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class AddBikes extends ModalComponent
{
    use WithPagination;

    public $kit_brand, $kit_model, $kit_cylinder, $kit_year;
    public $brands;
    public $models;
    public $cylinders;
    public $years;

    public $bike_selected = [];

    protected $listeners = ['addBike'];

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

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

        $good_bike = Bikes::where('brand', $this->kit_brand)
            ->where('cylinder', $this->kit_cylinder)
            ->where('model', $this->kit_model)
            ->where('year', $this->kit_year)
            ->first();

        $this->bike_selected[] = [
            'id' => $good_bike->id,
            'brand' => $good_bike->brand,
            'model' => $good_bike->model,
            'cylinder' => $good_bike->cylinder,
            'year' => $good_bike->year,
        ];

        $this->kit_brand = null;
        $this->kit_model = null;
        $this->kit_cylinder = null;
        $this->kit_year = null;

        $this->dispatch('addBike', $this->bike_selected);

    }

    public function addBikes()
    {
        $this->dispatch('bikesAdded', $this->bike_selected);
        $this->closeModal();
    }

    public function deleteBike($index)
    {
        unset($this->bike_selected[$index]);
    }

    public function render()
    {
        $data = [];
        return view('livewire.backend.popups.product.add-product.add-bikes', $data);
    }
}

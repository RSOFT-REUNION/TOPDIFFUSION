<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;

use App\Models\bike;
use App\Models\CompatibleTempBike;
use LivewireUI\Modal\ModalComponent;

class AddBikes extends ModalComponent
{
    public $bike_selected = [];
    public $checkedBikes = [];
    public $search = '';

    public function addBikes()
    {
        // Récupérer la liste des motos sélectionnées dans un tableau
        $selectedBikes = collect($this->bike_selected)->map(function ($bikeId) {
            return Bike::find($bikeId);
        });

        // Parcourir les motos sélectionnées et les enregistrer si elles n'existent pas
        foreach ($selectedBikes as $bike) {
            $this->findBikeIfExist = CompatibleTempBike::where('bike_id', $bike->id)->first();
            // Si la moto n'existe pas, enregistrez-la en base
            if (!$this->findBikeIfExist) {
                $compatibleBike = new CompatibleTempBike;
                $compatibleBike->bike_id = $bike->id;
                if($compatibleBike->save()) {
                    $this->emit('refreshLines');
                    $this->closeModal();
                }
            }
        }
    }

    // Filtre sur les motos déjà sélectionné
    private function getBikeNotSelected()
    {
        // Récupération des motos déjà sélectionnées
        $bikesAlreadySelected = CompatibleTempBike::pluck('bike_id')->all();

        // Récupération des motos non sélectionnées
        $allBikes = bike::whereNotIn('id', $bikesAlreadySelected);

        return $allBikes;
    }

    public function updatedSearch()
    {
        $query = '%' . $this->search . '%';
        if (strlen($this->search) > 1) {
            return $this->getBikeNotSelected()
                        ->where('marque', 'like', $query)
                        ->orWhere('cylindree', 'like', $query)
                        ->orWhere('modele', 'like', $query)
                        ->orWhere('annee', 'like', $query);
        }
    }

    public function render()
    {
        $data = [];
        if ($this->updatedSearch() != null) {
            $data['bikes'] = $this->updatedSearch()->get();
        } else {
            $data['bikes'] = $this->getBikeNotSelected()->get();
        }
        return view('livewire.popups.back.products.product-add.add-bikes', $data);
    }
}

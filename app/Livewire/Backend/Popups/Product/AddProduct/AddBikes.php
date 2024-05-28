<?php

namespace App\Livewire\Backend\Popups\Product\AddProduct;

use App\Models\Bikes;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class AddBikes extends ModalComponent
{
    use WithPagination;
    public $search;
    public $bike_selected = [];
    public $checkedBikes = [];
    public $currentPage = 1;

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        $brandSearch = [];
        if(strlen($this->search) > 1) {
            return Bikes::where('brand', 'like', $query)
                ->orWhere('model', 'like', $query)
                ->orWhere('year', 'like', $query)
                ->orWhere('cylinder', 'like', $query)
                ->orderBy('brand');
        }
    }

    public function setNextPage()
    {
        $this->currentPage++;
    }

    public function setPreviousPage()
    {
        $this->currentPage--;
    }

    public function selectBikes($value)
    {
        if (!in_array($value, $this->selectedBikes)) {
            $this->selectedBikes[] = $value;
        }
    }

    public function saveSelectedBikes()
    {
        dd($this->selectedBikes);
    }

    public function addBike()
    {
        // Récupérer la liste des motos sélectionnées dans un tableau
        $selectedBikes = collect($this->bike_selected)->map(function ($bikeId) {
            return Bikes::find($bikeId);
        });
        $this->dispatch('bikesAdded', $selectedBikes);
        $this->dispatch('closeModal');

    }

    public function getBikes()
    {
        if(strlen($this->search) > 1) {
            return $this->updatedSearch()->paginate(30, ['*'], 'page', $this->currentPage);
        } else {
            return Bikes::orderBy('brand', 'asc')->paginate(30, ['*'], 'page', $this->currentPage);
        }
    }

    public function render()
    {
        $data = [];
        $data['bikes'] = $this->getBikes();
        return view('livewire.backend.popups.product.add-product.add-bikes', $data);
    }
}

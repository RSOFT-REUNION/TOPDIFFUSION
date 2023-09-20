<?php

namespace App\Http\Livewire\Popups\Back\Products;

use App\Models\bike;
use App\Models\UserBike;
use Livewire\WithPagination;
use App\Models\CompatibleBike;
use LivewireUI\Modal\ModalComponent;

class CompatibleBikes extends ModalComponent
{

    public $isOpen = false;

    use WithPagination;

    public $bike_selected;

    public $search = '';
    public $jobs = [];

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function updatedSearch()
    {
        $query = '%' . $this->search . '%';
        if (strlen($this->search) > 1) {
            return bike::where('marque', 'like', $query)
                ->orWhere('cylindree', 'like', $query)
                ->orWhere('modele', 'like', $query)
                ->orWhere('annee', 'like', $query);
        }
    }

    public function add()
    {
        $bike = bike::where('id', $this->bike_selected)->first();
        $compatibleBike = new CompatibleBike;
        $compatibleBike->bike_id = $this->bike_selected;
        if ($compatibleBike->save()) {
            return redirect()->route('front.profile.bikes');
        }
    }


    public function render()
    {
        $data = [];
        if ($this->updatedSearch() != null) {
            $data['bikes'] = $this->updatedSearch()->paginate(20);
        } else {
            $data['bikes'] = bike::orderBy('marque', 'asc')->paginate(20);
        }

        return view('livewire.popups.back.products.compatible-bikes', $data);
    }
}

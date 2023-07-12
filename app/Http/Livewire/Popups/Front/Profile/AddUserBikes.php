<?php

namespace App\Http\Livewire\Popups\Front\Profile;

use App\Http\Livewire\Pages\Back\Products\Bikes;
use App\Models\bike;
use App\Models\UserBike;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class AddUserBikes extends ModalComponent
{
    use WithPagination;

    public $bike_selected;

    public $search = '';
    public $jobs = [];
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        if(strlen($this->search) > 1) {
            return bike::where('marque', 'like', $query)
                ->orWhere('cylindree', 'like', $query)
                ->orWhere('modele', 'like', $query)
                ->orWhere('annee', 'like', $query);
        }
    }

    public function add()
    {
        $bike = bike::where('id', $this->bike_selected)->first();
        $userBike = new UserBike;
        $userBike->title = strtoupper($bike->marque.'-'.$bike->cylindree.'-'.$bike->modele.'-'.$bike->annee);
        $userBike->user_id = auth()->user()->id;
        $userBike->bike_id = $this->bike_selected;
        if($userBike->save())
        {
            return redirect()->route('front.profile.bikes');
        }
    }

    public function render()
    {
        $data = [];
        if($this->updatedSearch() != null) {
            $data['bikes'] = $this->updatedSearch()->paginate(20);
        } else {
            $data['bikes'] = bike::orderBy('marque', 'asc')->paginate(20);
        }
        return view('livewire.popups.front.profile.add-user-bikes', $data);
    }
}

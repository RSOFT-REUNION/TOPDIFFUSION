<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\bike;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PopupAddBikes extends ModalComponent
{
    public $marque, $modele, $cylindre, $annee;

    protected $rules = [
        'marque' => 'required',
        'modele' => 'required',
        'cylindre' => 'required',
        'annee' => 'required|digits:4'
    ];

    protected $messages = [
        'marque.required' => "La marque est obligatoire.",
        'modele.required' => "Le modèle est obligatoire.",
        'cylindre.required' => "La cylindrée est obligatoire.",
        'annee.required' => "L'année est obligatoire.",
        'annee.digits' => "L'année n'est pas conforme.",

    ];

    public function updated($marque)
    {
        $this->validateOnly($marque);
    }

    public function create()
    {
        $this->validate();

        $bike = new bike;
        $bike->marque = strtoupper($this->marque);
        $bike->modele = strtoupper($this->modele);
        $bike->cylindree = strtoupper($this->cylindre);
        $bike->annee = strtoupper($this->annee);

        if($bike->save()) {
            return redirect()->route('back.product.bikes');
        }
    }

    public function render()
    {
        return view('livewire.pages.back.products.popup-add-bikes');
    }
}

<?php

namespace App\Livewire\Backend\Popups\Settings;

use App\Models\ShippingTaxe;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddShipping extends ModalComponent
{
    public $amount, $cible;

    #[Rule([
        'amount' => 'required|numeric',
        'cible' => 'required|numeric'
    ], message: [
        'amount.required' => 'Le montant est obligatoire',
        'amount.numeric' => 'Le montant doit être un nombre',
        'cible.required' => 'La cible est obligatoire',
        'cible.numeric' => 'La cible doit être un nombre',
    ])]

    public function mount()
    {

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addShipping()
    {
        $this->validate();

        $tax = new ShippingTaxe;
        $tax->amount = $this->amount;
        $tax->max_price = $this->cible;
        $tax->save();

        return to_route('bo.setting.shipping')->with('success', 'La taxe de livraison a été ajoutée avec succès');
    }

    public function render()
    {
        return view('livewire.backend.popups.settings.add-shipping');
    }
}

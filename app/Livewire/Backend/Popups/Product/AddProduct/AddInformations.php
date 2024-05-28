<?php

namespace App\Livewire\Backend\Popups\Product\AddProduct;

use LivewireUI\Modal\ModalComponent;

class AddInformations extends ModalComponent
{
    public $key, $value;
    public $infos = [];

    public function addInfos()
    {
        // Validation des champs
        $this->validate([
            'key' => 'required|string',
            'value' => 'required|string',
        ], [
            'key.required' => 'Le champ clé est obligatoire.',
            'key.string' => 'Le champ clé doit être une chaîne de caractères.',
            'value.required' => 'Le champ valeur est obligatoire.',
            'value.string' => 'Le champ valeur doit être une chaîne de caractères.',
        ]);

        $this->infos[] = [
            'key' => $this->key,
            'value' => $this->value,
        ];

        $this->dispatch('infosAdded', $this->infos);
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.backend.popups.product.add-product.add-informations');
    }
}

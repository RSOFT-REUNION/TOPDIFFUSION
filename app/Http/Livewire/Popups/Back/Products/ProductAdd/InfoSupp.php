<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;

use App\Models\ProductTemp;
use App\Models\ProductTempInfo;
use LivewireUI\Modal\ModalComponent;

class InfoSupp extends ModalComponent
{
    public $product_temp;
    public $info_group, $info_value;

    protected $rules = [
        'info_group' => 'required|string',
        'info_value' => 'required|string'
    ];

    protected $messages = [
        'info_group.required' => "Vous devez entrer une clé !",
        'info_group.string' => "La clé que vous avez saisie n'est pas correct.",
        'info_value.required' => "Vous devez entrer une valeur !",
        'info_value.string' => "La valeur que vous avez saisie n'est pas correct."
    ];

    public function updated($info_group)
    {
        // Permet la validation en temps réel
        $this->validateOnly($info_group);
    }

    public function mount($product_temp_id)
    {
        $this->product_temp = ProductTemp::where('id', $product_temp_id)->first();
    }

    // Création des lignes
    public function addInfos()
    {
        $this->validate();

        $infos = new ProductTempInfo;
        $infos->product_id = $this->product_temp->id;
        $infos->title = $this->info_group;
        $infos->value = $this->info_value;
        if($infos->save()){
            $this->emit('refreshLines');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.popups.back.products.product-add.info-supp');
    }
}

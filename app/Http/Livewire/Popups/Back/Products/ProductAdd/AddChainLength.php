<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;

use App\Models\ProductTaxes;
use App\Models\ProductTemp;
use App\Models\ProductTempSwatches;
use LivewireUI\Modal\ModalComponent;

class AddChainLength extends ModalComponent
{
    public $product;
    public $reference, $ugs;

    public $length;

    public $TVA_custom = 'default';
    public $list_tva_custom;
    public $price_HT, $price_TTC;

    public function mount($product_id, $element_reference, $element_ugs)
    {
        $this->reference = $element_reference;
        $this->ugs = $element_ugs;
        $this->product = ProductTemp::where('id', $product_id)->first();
    }

    public function updated()
    {
        if($this->TVA_custom == 'default') {
            // Si nous utilisons la règle de TVA par défaut
            $tva = ProductTaxes::where('default', 1)->first();
            $tva_rate = $tva->rate / 100;
            if($this->price_HT) {
                $calc = $this->price_HT * $tva_rate;
                $this->price_TTC = round($this->price_HT + $calc, 2);
            }
        } elseif($this->TVA_custom == "custom") {
            $tva = ProductTaxes::where('id', $this->list_tva_custom)->first();
            if($tva) {
                $tva_rate = $tva->rate / 100;
                if($this->price_HT) {
                    $calc = round($this->price_HT * $tva_rate, 2);
                    $this->price_TTC = $this->price_HT + $calc;
                }
            }
        } else {
            $this->price_TTC = $this->price_HT;
        }
    }

    // Ajout de la variante
    public function addLength()
    {
        $add = new ProductTempSwatches;
        $add->product_id = $this->product->id;
        $add->ugs = $this->ugs;
        $add->type = '3';

        if($this->product->kit_element == 1) {
            $add->chains_reference = $this->reference;
            $add->chains_length = $this->length;
            $add->ugs_swatch = ' '.$this->length .'L';
        } elseif($this->product->kit_element == 2) {
            // Il s'agit d'un pignon
            $add->gear_reference = $this->reference;
            $add->gear_tooth = $this->length;
            $add->ugs_swatch = '-'.$this->length;
        } else {
            // Il s'agit d'une couronne
            $add->crown_reference = $this->reference;
            $add->crown_tooth = $this->length;
            $add->ugs_swatch = '-'.$this->length;
        }
        $add->price_ht = number_format($this->price_HT, '2', '.');
        $add->price_ttc = number_format($this->price_TTC, '2', '.');
        if($this->TVA_custom != 'TVA_custom-none') {
            $add->have_tva = 1;
            if($this->TVA_custom == 'default') {
                $add->default_tva = 1;
            } else {
                $add->default_tva = 0;
            }
        } else {
            $add->have_tva = 0;
        }
        if($add->save())
        {
            $this->emit('refreshLines');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.popups.back.products.product-add.add-chain-length');
    }
}

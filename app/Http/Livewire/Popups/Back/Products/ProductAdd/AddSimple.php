<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;

use App\Models\ProductTaxes;
use App\Models\ProductTemp;
use App\Models\ProductTempSwatches;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AddSimple extends ModalComponent
{
    public $product;
    public $ugs;
    public $TVA_custom = 'default';
    public $list_tva_custom;
    public $price_HT, $price_TTC;

    public function mount($product_id)
    {
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

    // Fonction permettant la création
    public function addSimple()
    {
        $variant = new ProductTempSwatches;
        $variant->ugs = $this->ugs;
        $variant->product_id = $this->product->id;
        $variant->type = '1';
        $variant->price_ht = number_format($this->price_HT, '2', '.');
        $variant->price_ttc = number_format($this->price_TTC, '2', '.');
        if($this->TVA_custom != 'TVA_custom-none') {
            $variant->have_tva = 1;
            if($this->TVA_custom == 'default') {
                $variant->default_tva = 1;
            } else {
                $variant->default_tva = 0;
            }
        } else {
            $variant->have_tva = 0;
        }
        if($variant->save())
        {
            $this->emit('refreshLines');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.popups.back.products.product-add.add-simple');
    }

}

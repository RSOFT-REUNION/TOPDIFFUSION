<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;


use App\Models\ProductTaxes;
use App\Models\ProductTemp;
use LivewireUI\Modal\ModalComponent;

class AddKits extends ModalComponent
{
    public $product;
    public $title, $reference;

    public $TVA_custom = 'default';
    public $list_tva_custom;
    public $price_HT, $price_TTC;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

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

    public function render()
    {
        $data = [];
        $data['taxes'] = ProductTaxes::all();
        return view('livewire.popups.back.products.product-add.add-kits', $data);
    }
}

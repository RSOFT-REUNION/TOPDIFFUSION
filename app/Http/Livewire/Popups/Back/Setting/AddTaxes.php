<?php

namespace App\Http\Livewire\Popups\Back\Setting;

use App\Models\ProductTaxes;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AddTaxes extends ModalComponent
{
    public $title, $rate, $country_code, $state_code, $default;

    protected $rules = [
        'title' => 'required|unique:product_taxes,title',
        'rate' => 'required',
        'country_code' => 'required',
        'state_code' => 'required',
    ];

    protected $messages = [
        'title.required' => "Le nom est obligatoire.",
        'title.unique' => "Le nom est déjà utilisé.",
        'rate.required' => "Le taux est obligatoire.",
        'country_code.required' => "Le code pays est obligatoire.",
        'state_code.required' => "Le code état est obligatoire.",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $this->validate();

        $characters = [',', ' ', '%'];
        $goodCharacters = ['.', '', ''];

        $tax = new ProductTaxes;
        $tax->title = $this->title;
        $tax->rate = str_replace($characters, $goodCharacters, $this->rate);
        $tax->country_code = strtoupper($this->country_code);
        $tax->state_code = $this->state_code;
        if($tax->save())
        {
            // Vérification de la taxe déjà par défaut afin d'effectuer les modifications
            if($this->default){
                $allTax = ProductTaxes::where('default', 1)->first();
                if($allTax) {
                    $allTax->default = 0;
                    if($allTax->update()){
                        $tax->default = 1;
                        $tax->update();
                    }
                } else {
                    $tax->default = 1;
                    $tax->update();
                }
            }
            return redirect()->route('back.setting.payment');
        }
    }

    public function render()
    {
        return view('livewire.popups.back.setting.add-taxes');
    }
}

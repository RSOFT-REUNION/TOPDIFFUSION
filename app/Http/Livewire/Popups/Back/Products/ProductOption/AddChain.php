<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductOption;

use App\Models\kitsChain;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddChain extends ModalComponent
{
    use WithFileUploads;

    public $type, $picture, $step, $length, $color;

    public $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï", "/", "(", ")"];
    public $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i", "-", "-", "-"];

    // Validation des champs
    protected $rules = [
        'type' => 'required|string',
        'step' => 'required|integer',
        'length' => 'required|integer',
        'color' => 'required|string',
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6144',
    ];

    // Message d'erreur personnalisé
    protected $messages = [
        'type.required' => 'Le type est obligatoire.',
        'type.string' => 'Le type doit être une chaîne de caractères.',
        'step.required' => 'Le pas est obligatoire.',
        'step.integer' => 'Le pas doit être un nombre entier.',
        'length.required' => 'La longueur est obligatoire.',
        'length.integer' => 'La longueur doit être un nombre entier.',
        'color.required' => 'La couleur est obligatoire.',
        'color.string' => 'La couleur doit être une chaîne de caractères.',
        'picture.required' => 'L\'image est obligatoire.',
        'picture.image' => 'L\'image doit être une image.',
        'picture.mimes' => 'L\'image doit être au format jpeg, png, jpg, gif ou svg.',
        'picture.max' => 'L\'image ne doit pas dépasser 6Mo.',
    ];

    // Fonction Updated pour valider les champs en temps réel
    public function updated($type)
    {
        $this->validateOnly($type);
    }

    public function addChain()
    {
        $this->validate();

        // Récupérer uniquement le code dans la couleur
        $code_color = explode('/', $this->color);
        $title = $this->type.'-'.$code_color[1].' '.$this->length.'L';

        $chain = new kitsChain;
        $chain->title = $title;
        $chain->pas = $this->step;
        $chain->type = $this->type;
        $chain->length = $this->length;
        $chain->color = $this->color;
        if ($this->picture) {
            $chain->picture_url = strtolower(str_replace($this->characters, $this->correct_characters, $title)) . '.' . $this->picture->extension();
        }
        if($chain->save())
        {
            // Insert picture in the folder
            if ($this->picture) {
                $this->picture->storeAs('public/images/kit_parts', strtolower(str_replace($this->characters, $this->correct_characters, $title)) . '.' . $this->picture->extension());
            }
            return redirect()->route('back.product.options');
        }

    }

    public function render()
    {
        return view('livewire.popups.back.products.product-option.add-chain');
    }
}

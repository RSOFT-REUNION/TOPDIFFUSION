<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductOption;

use App\Models\kitsPignon;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddPignon extends ModalComponent
{
    use WithFileUploads;

    public $reference, $gearing, $picture;

    public $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï", "/", "(", ")"];
    public $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i", "-", "-", "-"];

    // Validation des champs
    protected $rules = [
        'reference' => 'required|string',
        'gearing' => 'required|integer',
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    // Message d'erreur personnalisé
    protected $messages = [
        'reference.required' => 'La référence est obligatoire.',
        'reference.string' => 'La référence doit être une chaîne de caractères.',
        'gearing.required' => 'Le nombre de dents est obligatoire.',
        'gearing.integer' => 'Le nombre de dents doit être un nombre entier.',
        'picture.required' => 'L\'image est obligatoire.',
        'picture.image' => 'L\'image doit être une image.',
        'picture.mimes' => 'L\'image doit être au format jpeg, png, jpg, gif ou svg.',
        'picture.max' => 'L\'image ne doit pas dépasser 2Mo.',
    ];

    // Fonction Updated pour valider les champs en temps réel
    public function updated($reference)
    {
        $this->validateOnly($reference);
    }

    public function addPignon()
    {
        $this->validate();

        $pignon = new kitsPignon;

        $pignon->title = $this->reference.'-'.$this->gearing;
        $pignon->reference = $this->reference;
        $pignon->gearing = $this->gearing;
        if ($this->picture) {
            $pignon->picture_url = strtolower(str_replace($this->characters, $this->correct_characters, $this->reference.'-'.$this->gearing)) . '.' . $this->picture->extension();
        }
        if($pignon->save())
        {
            // Insert picture in folders
            if ($this->picture) {
                $this->picture->storeAs('public/images/kit_parts', strtolower(str_replace($this->characters, $this->correct_characters, $this->reference.'-'.$this->gearing)) . '.' . $this->picture->extension());
            }
            return redirect()->route('back.product.options');
        }
    }

    public function render()
    {
        return view('livewire.popups.back.products.product-option.add-pignon');
    }
}

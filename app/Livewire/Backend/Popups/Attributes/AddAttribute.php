<?php

namespace App\Livewire\Backend\Popups\Attributes;

use App\Models\Attribute;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class AddAttribute extends ModalComponent
{
    public $type = 'color';
    public $color = '#000000'; // Couleur par défaut pour le type 'color
    public $group, $name, $text;
    public $groups_attributes;

    public function mount()
    {
        $this->groups_attributes = Attribute::where('is_group', true)->get();
    }

    public function addAttribute()
    {
        // Gestion de la validation des données
        if(!$this->group) {
            $this->validate([
                'name' => 'required|string',
            ], [
                'name.required' => 'Le nom de l\'attribut est obligatoire',
            ]);
        } else {
            if($this->type == 'color') {
                $this->validate([
                    'name' => 'required|string',
                    'color' => 'required|string',
                ], [
                    'name.required' => 'Le nom de l\'attribut est obligatoire',
                    'color.required' => 'La couleur de l\'attribut est obligatoire',
                ]);
            } else {
                $this->validate([
                    'name' => 'required|string',
                    'text' => 'required|string',
                ], [
                    'name.required' => 'Le nom de l\'attribut est obligatoire',
                    'text.required' => 'La texte de l\'attribut est obligatoire',
                ]);
            }
        }

        // Création de l'attribut
        $attribute = new Attribute;
        $attribute->name = $this->name;
        $attribute->slug = Str::slug($this->name);
        if($this->group) {
            $attribute->group_id = $this->group;
        } else {
            $attribute->is_group = true;
        }
        if($this->type == 'color') {
            $attribute->type = 'color';
            $attribute->variable = $this->color;
        } else {
            $attribute->type = 'text';
            $attribute->variable = $this->text;
        }
        if($attribute->save())
        {
            return to_route('bo.products.attributes')->with('success', 'L\'attribut a bien été ajouté');
        }

    }

    public function render()
    {
        return view('livewire.backend.popups.attributes.add-attribute');
    }
}

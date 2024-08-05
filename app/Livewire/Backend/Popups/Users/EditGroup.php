<?php

namespace App\Livewire\Backend\Popups\Users;

use App\Models\UserGroup;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class EditGroup extends ModalComponent
{
    public $existingGroups = [];
    public $group;
    public $name, $description, $discount;

    #[Rule([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'discount' => 'nullable|numeric'
    ], message: [
        'name.required' => 'Le nom est obligatoire',
        'name.string' => 'Le nom doit être une chaîne de caractères',
        'description.string' => 'La description doit être une chaîne de caractères',
        'discount.numeric' => 'La remise doit être un nombre'
    ])]

    public function mount($group_id)
    {
        $this->existingGroups = UserGroup::all();
        $this->group = UserGroup::where('id', $group_id)->first();
        $this->name = $this->group->name;
        $this->description = $this->group->description;
        $this->discount = $this->group->discount;
    }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function editGroup()
    {
        $this->validate();

        $this->group->update([
            'name' => $this->name,
            'description' => $this->description,
            'discount' => $this->discount
        ]);

        return to_route('bo.customers.group')->with('success', 'Le groupe a été modifié avec succès');
    }

    public function deleteGroup()
    {
        // TODO: Gérer la suppression
    }

    public function render()
    {
        return view('livewire.backend.popups.users.edit-group');
    }
}

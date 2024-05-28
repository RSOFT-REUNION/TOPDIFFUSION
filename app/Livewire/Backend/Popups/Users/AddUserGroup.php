<?php

namespace App\Livewire\Backend\Popups\Users;

use App\Models\ActivityLog;
use App\Models\UserGroup;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddUserGroup extends ModalComponent
{
    public $existingGroups = [];
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

    public function mount()
    {
        $this->existingGroups = UserGroup::all();
    }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function addGroup()
    {
        $this->validate();

        // Création d'un identifiant unique
        $key = uniqid();

        // Création d'un nouveau groupe d'utilisateurs
        try {
            $group = new UserGroup;
            $group->name = $this->name;
            $group->description = $this->description;
            $group->discount = ($this->discount == null) ? 0.0 : $this->discount;
            $group->key = $key;
            if($group->save())
            {
                // Logs
                $log = new ActivityLog;
                $log->type = 'success';
                $log->key = 'user.group.create';
                $log->title = 'Création d\'un groupe d\'utilisateurs';
                $log->description = 'Le groupe d\'utilisateurs ' . $this->name . ' a été créé avec succès';
                $log->save();

                return to_route('bo.customers.group')->with('success', 'Le groupe d\'utilisateurs a été créé avec succès');
            }
        } catch (\Exception $e) {
            $this->addError('Ajout groupe utilisateur', 'Une erreur est survenue lors de la création du groupe');

            // Logs
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'user.group.create';
            $log->title = 'Erreur lors de la création d\'un groupe d\'utilisateurs';
            $log->description = 'Une erreur s\'est produite lors de la création du groupe d\'utilisateurs ' . $this->name;
            $log->error = $e->getMessage();
            $log->save();

            return to_route('bo.customers.group')->with('error', 'Une erreur est survenue lors de la création du groupe');

        }

    }

    public function render()
    {
        return view('livewire.backend.popups.users.add-user-group');
    }
}

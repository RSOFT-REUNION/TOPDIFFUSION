<?php

namespace App\Http\Livewire\Popups\Back\Users;

use App\Models\GroupUser;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditGroupUser extends ModalComponent
{
    public $group;
    public $description, $discount;

    protected $rules = [
        'description' => 'nullable|min:5',
        'discount' => 'required|min:1|max:100'
    ];

    protected $messages = [
        'description.min' => "Votre description doit comporter au moins :min caractères.",
        'discount_percentage.required' => 'Le pourcentage est requis',
        'discount_percentage.min' => 'Le pourcentage est de min:',
        'discount_percentage.max' => 'Le pourcentage est de max:'
    ];

    public function mount($group_id)
    {
        $this->group = GroupUser::where('id', $group_id)->first();
        $this->description = $this->group->description;
        $this->discount = $this->group->discount;
    }

    public function updated()
    {
        $this->validateOnly($this->description);
    }

    // Fonction de modification du groupe
    public function editGroup()
    {
        $this->validate();
        // Configuration des variables
        $description = $this->description;
        $discount = $this->discount;
        $group = $this->group;

        // Vérification des informations en doublons
        if($description != $group->description) {
            $group->description = $description;
        }
        if($discount != $group->discount) {
            $group->discount = $discount;
        }
        if($group->update()) {
            return redirect()->route('back.user.userGroup')->with('success', 'Les informations de votre groupe ont bien été prises en charge');
        }

    }

    public function render()
    {
        $data = [];
        $data['users'] = User::where('group_user', $this->group->id)->get();
        return view('livewire.popups.back.users.edit-group-user', $data);
    }
}

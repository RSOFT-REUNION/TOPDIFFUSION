<?php

namespace App\Http\Livewire\Popups\Back\Users;

use App\Models\ProductCategory;
use LivewireUI\Modal\ModalComponent;
use App\Models\CustomerGroup;
use App\Models\User;

class AddGroupeUsers extends ModalComponent
{
    public $name, $discount_percentage, $is_default, $discount_default;
    public $selectedUsers = [];
    public $checkedUsers = [];

    public $search = '';

    public $user;

    protected $rules = [
        'name' => 'required|unique:product_group_tags,title',
        'discount_percentage' => 'required|min:1|max:95'
    ];

    protected $messages = [
        'name.required' => "Le titre du group est obligatoire.",
        'name.unique' => "Ce groupe existe déjà.",
        'discount_percentage.required' => 'Le pourcentage est requis',
        'discount_percentage.min' => 'Le pourcentage est de min:',
        'discount_percentage.max' => 'Le pourcentage est de max:'
    ];

    public function createGroupUser()
    {

        $this->validate($this->rules, $this->messages);
        // Vérifiez si la case à cocher isDefault est cochée pour le nouveau groupe
        $isNewGroupDefault = $this->is_default;

        // Récupérez le groupe actuellement défini comme "par défaut" s'il existe
        $defaultGroup = CustomerGroup::where('is_default', 1)->first();

        // Si la case est cochée et qu'il y a un groupe par défaut existant, désactivez-le
        if ($isNewGroupDefault && $defaultGroup) {
            $defaultGroup->is_default = !$defaultGroup->is_default;
            if($defaultGroup->save()){
                session()->flash('success', $defaultGroup->name . ' n\'est plus le groupe par défaut');
            } else {
                session()->flash('error', $defaultGroup->name . ' est toujours le groupe par défaut');
            };
        }

        // Créez d'abord le groupe de clients
        $groupUser = new CustomerGroup();
        $groupUser->name = $this->name;
        $groupUser->discount_percentage = $this->discount_percentage;
        $groupUser->is_default = $isNewGroupDefault ? 1 : 0; // Définissez le nouveau groupe comme par défaut si la case est cochée
        $groupUser->discount_default = $this->discount_default ? 1 : 0; // Définissez la remise par défaut si la case est cochée

        if ($groupUser->save()) {
            // Une fois que le groupe est créé, attribuez les utilisateurs sélectionnés
            $groupUser->users()->sync($this->selectedUsers);

            // Récupérez l'ID du groupe nouvellement créé
            $groupId = $groupUser->id;

            foreach ($this->selectedUsers as $userId) {
                $this->user = User::find($userId);
                if ($this->user) {
                    $this->user->customer_group_id = $groupId;
                    $this->user->save();
                }
            }

            $categories = ProductCategory::all();
            // Parcourez toutes les catégories et créez des relations avec le nouveau groupe
            foreach ($categories as $category) {
                $category->customerGroups()->attach($groupId, [
                    'category_id' => $category->id,
                    'customer_group_id' => $this->user->customer_group_id,
                    'discount_percentage' => $this->discount_percentage,
                ]);
            }

            // Redirigez l'utilisateur vers la liste des groupes
            return redirect()->route('back.user.userGroup')->with('success', 'Le groupe a été créé avec succès.');
        } else {
            return back()->with('error', 'Une erreur est survenue lors de la création du groupe.');
        }
    }

    public function updatedSearch()
    {
        $query = '%' . $this->search . '%';
        if (strlen($this->search) > 1) {
            return User::where('team', '0')
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('firstname', 'like', $query)
                        ->orWhere('lastname', 'like', $query)
                        ->orWhere('email', 'like', $query);
                });
        }
    }

    public function updateGroupUserFromSingleClient()
    {
        dd('ok');
    }


    public function render()
    {
        $data = [];

        if ($this->updatedSearch() != null) {
            $data['usersList'] = $this->updatedSearch()
                ->where('team', '0')
                ->whereDoesntHave('customerGroups')
                ->paginate(20);
        } else {
        $data['usersList'] = User::where('team', '0')
            ->whereDoesntHave('customerGroups')
            ->orderBy('firstname', 'asc')
            ->paginate(8);

        }
        return view('livewire.popups.back.users.add-groupe-users', $data);
    }
}

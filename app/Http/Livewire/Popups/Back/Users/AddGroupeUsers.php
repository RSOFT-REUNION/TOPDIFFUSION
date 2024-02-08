<?php

namespace App\Http\Livewire\Popups\Back\Users;

use App\Models\GroupUser;
use App\Models\ProductCategoriesDiscount;
use App\Models\ProductCategory;
use LivewireUI\Modal\ModalComponent;
use App\Models\CustomerGroup;
use App\Models\User;

class AddGroupeUsers extends ModalComponent
{
    public $name, $description, $discount_percentage;
    public $selectedUsers = [];
    public $checkedUsers = [];

    public $search = '';

    public $user;

    protected $rules = [
        'name' => 'required|unique:group_users,title',
        'description' => 'nullable|min:5',
        'discount_percentage' => 'required|min:1|max:100'
    ];

    protected $messages = [
        'name.required' => "Le titre du groupe est obligatoire.",
        'name.unique' => "Un groupe existe déjà avec ce nom.",
        'description.min' => 'Votre description doit comporter au moins :min caractères.',
        'discount_percentage.required' => 'Le pourcentage est requis',
        'discount_percentage.min' => 'Le pourcentage est de min:',
        'discount_percentage.max' => 'Le pourcentage est de max:'
    ];

    public function createGroupUser()
    {

        $this->validate();

        // Créez d'abord le groupe de clients
        $groupUser = new GroupUser();
        $groupUser->title = $this->name;
        $groupUser->description = $this->description;
        $groupUser->discount = $this->discount_percentage;
        if ($groupUser->save()) {
            // Récupère l'id du dernier groupe créé
            $lastInsertedGroupId = $groupUser->id;

            // Une fois que le groupe est créé, attribuez les utilisateurs sélectionnés
            //$groupUser->users()->sync($this->selectedUsers);

            // Récupérez l'ID du groupe nouvellement créé
            //$groupId = $groupUser->id;

            // Initialisez $this->user à null en dehors de la boucle
//            $this->user = null;
//            if ($this->selectedUsers) {
//                foreach ($this->selectedUsers as $userId) {
//                    $this->user = User::find($userId);
//                    if ($this->user) {
//                        $this->user->customer_group_id = $groupId;
//                        $this->user->save();
//                    }
//                }
//            }

            $categories = ProductCategory::all();
            if($categories->count() > 0) {
                // Parcourez toutes les catégories et ajouter leurs ids dans la table de liaison "ProductCategoriesDiscount"
                foreach ($categories as $category) {
                    $discountCategorie = new ProductCategoriesDiscount;
                    $discountCategorie->category_id = $category->id;
                    $discountCategorie->group_id = $lastInsertedGroupId;
                    $discountCategorie->discount = $this->discount_percentage;
                    $discountCategorie->save();
                }
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


    public function render()
    {
        $data = [];

        /*if ($this->updatedSearch() != null) {
            $data['usersList'] = $this->updatedSearch()
                ->whereIn('team', ['0', '1'])
                ->whereDoesntHave('customerGroups')
                ->paginate(20);
        } else {
        $data['usersList'] = User::whereIn('team', ['0', '1'])
            ->whereDoesntHave('customerGroups')
            ->orderBy('firstname', 'asc')
            ->paginate(8);

        }*/
        return view('livewire.popups.back.users.add-groupe-users', $data);
    }
}

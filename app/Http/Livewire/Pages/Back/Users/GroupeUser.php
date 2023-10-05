<?php

namespace App\Http\Livewire\Pages\Back\Users;

use App\Models\CustomerGroup;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GroupeUser extends Component
{
    public $editing = false;
    public $editingGroupId = null;
    // public $name = "";
    public $discount = "";
    public $name, $discount_percentage, $is_default, $discounts, $categoriesWithoutRelationship, $userInfoFromGroup;
    public $selectedUsers = [];
    public $currentGroupId;

    protected $rules = [
        'name' => 'required|unique:product_group_tags,title',
        'discount_percentage' => 'required|min:1|max:95'
    ];

    protected $messages = [
        'name.required' => "Le titre du groupe est obligatoire.",
        'name.unique' => "Ce groupe existe déjà.",
        'discount_percentage.required' => 'Le pourcentage est requis',
        'discount_percentage.min' => 'Le pourcentage est de min:',
        'discount_percentage.max' => 'Le pourcentage est de max:'
    ];

    public function mount()
    {
        $this->discounts = ProductCategory::getAllDiscountPercentages();
        $this->userInfoFromGroup = ProductCategory::getUsersByGroup();
        $this->categoriesWithoutRelationship = ProductCategory::whereDoesntHave('customerGroups')->get();
    }

    public function startEditing($groupId)
    {
        $group = CustomerGroup::findOrFail($groupId);
        $this->editingGroupId = $groupId;
        $this->name = $group->name;
        $this->discount = $group->discount_percentage;
        $this->editing = true;

        // Enregistrez l'ID du groupe actuel dans une propriété
        $this->currentGroupId = $groupId;
    }

    public function stopEditing($groupId)
    {
        $group = CustomerGroup::where('id', $groupId)->first();

        if ($group) {
            $group->name = $this->name;
            $group->discount_percentage = $this->discount;

            $group->update();

            $this->editing = false;
            session()->flash('success', 'Le groupe a été mise à jour avec succès');
        } else {
            session()->flash('error', 'Le groupe avec l\'ID ' . $groupId . ' n\'a pas été trouvée.');
        }
    }




//    public function createGroupUser()
//    {
//
//        $this->validate($this->rules, $this->messages);
//        // Vérifiez si la case à cocher isDefault est cochée pour le nouveau groupe
//        $isNewGroupDefault = $this->is_default;
//
//        // Récupérez le groupe actuellement défini comme "par défaut" s'il existe
//        $defaultGroup = CustomerGroup::where('is_default', 1)->first();
//
//        // Si la case est cochée et qu'il y a un groupe par défaut existant, désactivez-le
//        if ($isNewGroupDefault && $defaultGroup) {
//            $defaultGroup->is_default = !$defaultGroup->is_default;
//            if($defaultGroup->save()){
//                session()->flash('success', $defaultGroup->name . ' n\'est plus le groupe par défaut');
//            } else {
//                session()->flash('error', $defaultGroup->name . ' est toujours le groupe par défaut');
//            };
//        }
//
//        // Créez d'abord le groupe de clients
//        $groupUser = new CustomerGroup();
//        $groupUser->name = $this->name;
//        $groupUser->discount_percentage = $this->discount_percentage;
//        $groupUser->is_default = $isNewGroupDefault ? 1 : 0; // Définissez le nouveau groupe comme par défaut si la case est cochée
//
//        if ($groupUser->save()) {
//            // Une fois que le groupe est créé, attribuez les utilisateurs sélectionnés
//            $groupUser->users()->sync($this->selectedUsers);
//
//            // Récupérez l'ID du groupe nouvellement créé
//            $groupId = $groupUser->id;
//
//            foreach ($this->selectedUsers as $userId) {
//                $user = User::find($userId);
//                if ($user) {
//                    $user->customer_group_id = $groupId;
//                    $user->save();
//                }
//            }
//
//            $categories = ProductCategory::all();
//
//            // Parcourez toutes les catégories et créez des relations avec le nouveau groupe
//            foreach ($categories as $category) {
//                $category->customerGroups()->attach($groupId, [
//                    'category_id' => $category->id,
//                    'customer_group_id' => $groupId,
//                    'discount_percentage' => $this->discount_percentage,
//                ]);
//            }
//
//            // Redirigez l'utilisateur vers la liste des groupes
//            return redirect()->route('back.user.userGroup')->with('success', 'Le groupe a été créé avec succès.');
//        } else {
//            return back()->with('error', 'Une erreur est survenue lors de la création du groupe.');
//        }
//    }

    public function updateGroupUser($groupId)
    {
        $foundGroup = CustomerGroup::where('id', $groupId)->first();

        if ($foundGroup) {
            $foundGroup->name = $this->name;

            // Vérifiez si la remise à changer
            if ($foundGroup->discount_percentage != $this->discount) {
                $foundGroup->discount_percentage = $this->discount;
            }

            if ($foundGroup->save()) {
                foreach ($this->selectedUsers as $userId) {
                    // Vérifiez si l'entrée existe déjà dans la table de pivot
                    $existingEntry = DB::table('customer_group_user')
                        ->where('customer_group_id', $groupId)
                        ->where('user_id', $userId)
                        ->first();

                    if (!$existingEntry) {
                        // Si l'entrée n'existe pas, ajoutez-la
                        $foundGroup->users()->attach($userId);

                        // Mettez à jour l'ID du groupe pour l'utilisateur
                        $user = User::find($userId);
                        if ($user) {
                            $user->customer_group_id = $groupId;
                            $user->save();
                        }
                    }
                }
            }
        } else {
            return back()->with('error', 'Ce groupe n\'existe pas.');
        }

        return back()->with('success', 'Le groupe ' . $foundGroup->name  . ' a été mis à jour.');
    }

    public function removeUserFromGroup($userId)
    {
        // Récupérez le nom de l'utilisateur
        $user = User::find($userId);

        if (!$user) {
            session()->flash('error', 'L\'utilisateur n\'a pas pu être trouvé.');
            return;
        }

        // Exécutez la requête SQL pour supprimer l'entrée de la table pivot
        $deletedRows = DB::table('customer_group_user')
            ->where('user_id', $userId)
            ->where('customer_group_id', $this->currentGroupId)
            ->delete();

        if ($deletedRows > 0) {
            // L'utilisateur a été détaché du groupe avec succès
            $this->selectedUsers = [];

            session()->flash('success', $user->firstname . ' a été détaché du groupe avec succès.');
        } else {
            // La suppression n'a pas réussi, car aucune entrée correspondante n'a été trouvée
            session()->flash('error', 'L\'utilisateur n\'a pas pu être détaché du groupe.');
        }
    }

    public function render()
    {
        $data = [];
        $data['groupUser'] = CustomerGroup::all();
        $data['usersList'] = User::where('team', '0')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('customer_group_user')
                    ->whereRaw('customer_group_user.user_id = users.id');
            })
            ->get();
        // Récupérez les utilisateurs ayant une relation avec le groupe actuel
        $data['usersWithRelation'] = User::whereHas('customerGroups', function ($query) {
            $query->where('customer_group_id', $this->currentGroupId);
        })->get();



        return view('livewire.pages.back.users.group-users', $data);
    }
}

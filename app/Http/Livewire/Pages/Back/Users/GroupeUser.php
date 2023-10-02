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
    public $editingFaqId = null;
    // public $name = "";
    public $discount = "";
    public $name, $discount_percentage, $is_default, $discounts, $categoriesWithoutRelationship, $userInfoFromGroup;
    public $selectedUsers = [];

    public function startEditing($groupId)
    {
        $faq = CustomerGroup::findOrFail($groupId);
        $this->editingFaqId = $groupId;
        $this->name = $faq->name;
        $this->discount = $faq->discount_percentage;
        $this->editing = true;
    }

    public function stopEditing($groupId)
    {
        $faq = CustomerGroup::where('id', $groupId)->first();

        if ($faq) {
            $faq->name = $this->name;
            $faq->discount_percentage = $this->discount;

            $faq->update();

            $this->editing = false;
            session()->flash('success', 'La FAQ a été mise à jour avec succès');
        } else {
            session()->flash('error', 'La FAQ avec l\'ID ' . $groupId . ' n\'a pas été trouvée.');
        }
    }

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

    public function mount()
    {
        $this->discounts = ProductCategory::getAllDiscountPercentages();
        $this->userInfoFromGroup = ProductCategory::getUsersByGroup();
        $this->categoriesWithoutRelationship = ProductCategory::whereDoesntHave('customerGroups')->get();

    }

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

        if ($groupUser->save()) {
            // Une fois que le groupe est créé, attribuez les utilisateurs sélectionnés
            $groupUser->users()->sync($this->selectedUsers);

            // Récupérez l'ID du groupe nouvellement créé
            $groupId = $groupUser->id;

            foreach ($this->selectedUsers as $userId) {
                $user = User::find($userId);
                if ($user) {
                    $user->customer_group_id = $groupId;
                    $user->save();
                }
            }

            $categories = ProductCategory::all();

            // Parcourez toutes les catégories et créez des relations avec le nouveau groupe
            foreach ($categories as $category) {
                $category->customerGroups()->attach($groupId, [
                    'category_id' => $category->id,
                    'customer_group_id' => $groupId,
                    'discount_percentage' => $this->discount_percentage,
                ]);
            }

            // Redirigez l'utilisateur vers la liste des groupes
            return redirect()->route('back.user.userGroup')->with('success', 'Le groupe a été créé avec succès.');
        } else {
            return back()->with('error', 'Une erreur est survenue lors de la création du groupe.');
        }
    }

    public function detachUserFromGroup($userId, $groupId)
    {
        // Exécutez la requête SQL pour supprimer l'entrée de la table pivot
        $deletedRows = DB::table('customer_group_user')
            ->where('user_id', $userId)
            ->where('customer_group_id', $groupId)
            ->delete();

        if ($deletedRows > 0) {
            // L'utilisateur a été détaché du groupe avec succès
            return redirect()->route('back.user.userGroup')->with('success', 'L\'utilisateur a été détaché du groupe avec succès.');
        } else {
            // Aucune ligne n'a été supprimée, l'utilisateur n'était peut-être pas attaché au groupe
            return redirect()->route('back.user.userGroup')->with('error', 'L\'utilisateur n\'était pas attaché à ce groupe.');
        }

        // Redirigez l'utilisateur vers la page appropriée
        return redirect()->back();
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

        return view('livewire.pages.back.users.group-users', $data);
    }
}

<?php

namespace App\Http\Livewire\Pages\Back\Products;


use App\Models\GroupUser;
use App\Models\ProductCategoriesDiscount;
use Livewire\Component;
use App\Models\ProductCategory;

class ProductSingleCategories extends Component
{
    protected $listeners = ['refreshLines' => '$refresh'];

    public $groups;
    public $discountPercentages = [];
    public $discount = [];

    public $category;
    public $findCategory;
    public $isModified = false;

    public function mount($categoryId)
    {
        // Récupérez la catégorie actuelle
        $this->category = ProductCategory::findOrFail($categoryId);

        // Récupérez la liste des groupes depuis la base de données avec sa relation
        $this->groups = ProductCategoriesDiscount::where('category_id', $categoryId)->get();

        // Initialisez $discountPercentages avec les pourcentages de remise actuels pour chaque groupe
        foreach ($this->groups as $group) {
            $this->discountPercentages[$group->id] = $group->discount;
        }
    }

    public function updateDiscountPercentage($groupId)
    {
        // Vérifiez si le groupe avec l'ID $groupId existe
        $group = ProductCategoriesDiscount::where('group_id', $groupId)->where('category_id', $this->category->id)->first();

        if ($group) {
            $group->discount = $this->discountPercentages[$group->id];
            if($group->update()) {
                session()->flash('success', 'Le pourcentage de remise a été mis à jour avec succès.');
                $this->emit('refreshLines');
            }
        } else {
            session()->flash('error', 'Le groupe de clients n\'existe pas.');
        }

        // Rechargez les données après la mise à jour
        $this->emit('refreshLines');
    }

    public function render()
    {
        return view('livewire.pages.back.products.product-single-categories');
    }
}

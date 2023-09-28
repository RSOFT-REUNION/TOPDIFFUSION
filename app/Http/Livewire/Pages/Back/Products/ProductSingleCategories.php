<?php

namespace App\Http\Livewire\Pages\Back\Products;

use Livewire\Component;
use App\Models\CustomerGroup;
use App\Models\ProductCategory;

class ProductSingleCategories extends Component
{


    public $categoryId;

    public $groups;
    public $discountPercentages = [];

    public $category;
    public $findCategory;
    public $isModified = false;

    public function mount($categoryId)
    {
        $this->findCategory = ProductCategory::where('id', $categoryId)->first();
        $this->categoryId = $categoryId;

        // Récupérez la catégorie actuelle
        $this->category = ProductCategory::findOrFail($categoryId);

        // Récupérez la liste des groupes depuis la base de données
        $this->groups = CustomerGroup::all();

        // Initialisez $discountPercentages avec les pourcentages de remise actuels pour chaque groupe
        foreach ($this->groups as $group) {
            // Utilisez la relation pivot pour obtenir le pourcentage de remise pour ce groupe et cette catégorie
            $this->discountPercentages[$group->id] = $this->category->customerGroups
                ->where('id', $group->id)
                ->first();

            if ($this->discountPercentages[$group->id]) {
                $this->discountPercentages[$group->id] = $this->discountPercentages[$group->id]->pivot->discount_percentage;
            } else {
                // Traitez le cas où la relation n'existe pas
                $this->discountPercentages[$group->id] = 0; // Par exemple, définissez-le à 0
            }
        }
    }


    public function updateDiscountPercentage($groupId)
    {
        // Vérifiez si le groupe avec l'ID $groupId existe
        $group = CustomerGroup::find($groupId);

        if ($group) {
            // Mettez à jour le pourcentage de remise pour la catégorie actuelle et le groupe spécifié
            $category = $this->findCategory;


            if ($category) {
                $category->customerGroups()->syncWithoutDetaching([
                    $groupId => [
                        'discount_percentage' => $this->discountPercentages[$groupId],
                        'category_id' => $this->categoryId
                    ]
                ]);

                session()->flash('success', 'Le pourcentage de remise a été mis à jour avec succès.');
                $this->isModified = true;
            } else {
                session()->flash('error', 'La catégorie n\'existe pas.');
            }
        } else {
            session()->flash('error', 'Le groupe de clients n\'existe pas.');
        }

        // Rechargez les données après la mise à jour
        $this->mount($this->categoryId);
    }



    public function render()
    {
        return view('livewire.pages.back.products.product-single-categories');
    }
}

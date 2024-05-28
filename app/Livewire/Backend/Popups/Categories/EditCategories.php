<?php

namespace App\Livewire\Backend\Popups\Categories;

use App\Models\CategoryDiscount;
use App\Models\ProductCategory;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Session;
use LivewireUI\Modal\ModalComponent;

class EditCategories extends ModalComponent
{
    public $category;
    public $name, $description, $icon, $parent, $parent_2;

    public $customer_groups;
    public $discounts = [];

    public $suggestion = [];
    public $categoryChoice;

    public function mount($category_id)
    {
        $this->category = ProductCategory::find($category_id);
        $this->customer_groups = CategoryDiscount::where('category_id', $category_id)->get();

        foreach ($this->customer_groups as $group)
        {
            $this->discounts[$group->id] = $group->discount;
        }

        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->icon = $this->category->icon;
    }

    public function submitDiscount()
    {
        foreach ($this->customer_groups as $group) {
            // Mettre à jour la remise pour chaque groupe
            $group->discount = $this->discounts[$group->id];
            $group->update();
        }

        return to_route('bo.products.categories')->with('success', 'Les remises ont été mises à jour.');
    }

    public function deleteCategory()
    {
        $this->category->delete();
        return to_route('bo.products.categories')->with('success', 'La catégorie a été supprimée.');
    }

    public function render()
    {
        return view('livewire.backend.popups.categories.edit-categories');
    }
}

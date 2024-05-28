<?php

namespace App\Livewire\Backend\Popups\Categories;

use App\Models\ActivityLog;
use App\Models\CategoryDiscount;
use App\Models\ProductCategory;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddCategories extends ModalComponent
{
    public $name, $description, $icon, $parent, $parent_2;
    public $suggestion = [];
    public $categoryChoice;

    #[Rule([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'icon' => 'nullable|file|mimes:svg,png,jpg,jpeg|max:2048',
    ], message: [
        'name.required' => 'Le nom est obligatoire.',
        'name.string' => 'Le nom doit être une chaîne de caractères.',
        'description.string' => 'La description doit être une chaîne de caractères.',
        'icon.file' => 'L\'icône doit être un fichier.',
        'icon.mimes' => 'L\'icône doit être un fichier de type :values.',
        'icon.max' => 'L\'icône doit avoir une taille maximale de :max Ko.',
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Fonction permettant de gérer l'auto-complétion des catégories
    public function updatedParent()
    {
        if(strlen($this->parent) > 1) {
            $this->suggestion = ProductCategory::where('slug', 'like', '%'. $this->parent .'%')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    // Fonction permettant de sélectionner une catégorie
    public function selectParent($suggest)
    {
        $category = ProductCategory::where('id', $suggest)->first();

        if($category->parent_id) {
            $this->parent = $category->parent_id;
            $this->parent_2 = $suggest;
        } else {
            $this->parent = $suggest;
            $this->parent_2 = '';
        }
        $this->categoryChoice = ProductCategory::where('id', $suggest)->first()->name;
        $this->suggestion = [];
    }

    public function addCategory()
    {
        $this->validate();

        // Gestion du fichier
        if($this->icon) {
            $icon_name = Str::slug($this->name) . '.' . $this->icon->getClientOriginalExtension();
        } else {
            $icon_name = '';
        }

        try {
            $category = new ProductCategory;
            $category->name = $this->name;
            $category->slug = Str::slug($this->name);
            $category->description = $this->description;
            $category->icon = $icon_name;
            if($this->categoryChoice) {
                $category->parent_id = $this->parent;
                if($this->parent_2) {
                    $category->parent_id_2 = $this->parent_2;
                } else {
                    $category->parent_id_2 = null;
                }
            } else {
                $category->parent_id = null;
            }
            if($category->save()) {
                // Sauvegarde de l'icone
                if($this->icon) {
                    Storage::disk('public')->putFileAs('products/categories', $this->icon, $icon_name);
                }

                // Ajout des remises
                $groups = UserGroup::all();
                foreach ($groups as $group) {
                    $discount_category = new CategoryDiscount;
                    $discount_category->category_id = $category->id;
                    $discount_category->user_group_id = $group->id;
                    $discount_category->discount = $group->discount;
                    $discount_category->save();
                }

                // Log
                $log = new ActivityLog;
                $log->type = 'success';
                $log->key = 'categorie.create';
                $log->title = 'Catégorie de produit ajoutée';
                $log->description = 'La catégorie de produit ' . $this->name . ' a été ajoutée avec succès.';
                $log->save();

                return to_route('bo.products.categories')->with('success', 'La catégorie a été ajoutée avec succès.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addError('name', 'Une erreur est survenue lors de l\'ajout de la catégorie.');

            // Log
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'categorie.create';
            $log->title = 'Erreur lors de l\'ajout d\'une catégorie';
            $log->description = 'Une erreur est survenue lors de l\'ajout de la catégorie ' . $this->name . '.';
            $log->error = $e->getMessage();
            $log->support_notified = true;
            $log->save();

            return to_route('bo.products.categories')->with('error', 'Une erreur est survenue lors de l\'ajout de la catégorie. Le support en a été averti et reviendra vers vous dès que possible.');
        }
    }

    public function render()
    {
        return view('livewire.backend.popups.categories.add-categories');
    }
}

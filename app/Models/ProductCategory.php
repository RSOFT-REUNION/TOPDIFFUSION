<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function hasSubCategory()
    {
        return ProductCategory::where('parent_id', $this->id)->get();
    }

    public function getParentCategory()
    {
        return ProductCategory::where('id', $this->parent_id)->first();
    }

    public function getProductsCount()
    {
        return MyProduct::where('category_id', $this->id)->get()->count();
    }

    /*public function customerGroups()
    {
        // Déclare une relation many to many avec le modèle CustomerGroup.
        // Utilise la table pivot 'category_customer_group' pour les associations.
        // Inclut le champ 'discount_percentage' de la table pivot.
        return $this->belongsToMany(CustomerGroup::class, 'category_customer_group')
            ->withPivot('discount_percentage');
    }*/
    public static function getAllDiscountPercentages()
    {
        // Récupère toutes les catégories de produits avec leurs groupes de clients associés et les pourcentages de remise.
        return self::with('customerGroups')->get()
            ->map(function ($category) {
                // Pour chaque catégorie de produits, transforme les données en un format spécifique.
                $groupData = $category->customerGroups
                    ->map(function ($group) {
                        return [
                            'group_id' => $group->id,
                            'group_name' => $group->name,
                            'discount_percentage' => $group->pivot->discount_percentage,
                        ];
                    })
                    ->toArray();

                // Ajoute les données de catégorie à chaque élément du tableau.
                foreach ($groupData as &$group) {
                    $group['category_id'] = $category->id;
                    $group['category_name'] = $category->title;
                }

                return $groupData;
            })
            ->flatten(1); // Aplatit le tableau multidimensionnel pour obtenir un seul tableau résultant
    }


    public static function getUsersByGroup()
    {
        // Récupère tous les groupes de clients avec leurs utilisateurs associés.
        $groups = CustomerGroup::with('users')->get();

        // Aplatit les données pour obtenir un tableau unique.
        return $groups->flatMap(function ($group) {
            // Pour chaque groupe de clients, mappe les utilisateurs et les données de groupe.
            return $group->users->map(function ($user) use ($group) {
                return [
                    'group_id' => $group->id,
                    'group_name' => $group->name,
                    'user_id' => $user->id,
                    'user_firstname' => $user->firstname,
                    'user_lastname' => $user->lastname,
                ];
            });
        });
    }

    // Récupérer l'information de si une ligne existe déjà dans la liste des product categories discount
    public function getDiscountLine()
    {
        $allDiscount = ProductCategoriesDiscount::all();

    }



}

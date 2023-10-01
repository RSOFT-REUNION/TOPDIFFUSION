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

    public function customerGroups()
    {
        return $this->belongsToMany(CustomerGroup::class, 'category_customer_group')
            ->withPivot('discount_percentage');
    }
    public static function getAllDiscountPercentages()
    {
        return self::with('customerGroups')->get()
            ->map(function ($category) {
                $groupData = $category->customerGroups
                    ->map(function ($group) {
                        return [
                            'group_id' => $group->id,
                            'group_name' => $group->name,
                            'discount_percentage' => $group->pivot->discount_percentage,
                        ];
                    })
                    ->toArray();

                // Ajoutez-le "category_id" et le "category_name" à chaque élément du tableau "groups"
                foreach ($groupData as &$group) {
                    $group['category_id'] = $category->id;
                    $group['category_name'] = $category->title;
                }

                return $groupData;
            })
            ->flatten(1); // Aplatit le tableau pour obtenir un seul tableau résultant
    }


    public static function getUsersByGroup()
    {
        $groups = CustomerGroup::with('users')->get();

        $groupData = $groups->map(function ($group) {
            return [
                'group_name' => $group->name,
                'users' => $group->users->map(function ($user) {
                    return [
                        'user_id' => $user->id,
                        'user_firstname' => $user->firstname,
                        'user_lastname' => $user->lastname,
                    ];
                }),
            ];
        });

        return $groupData;
    }

}

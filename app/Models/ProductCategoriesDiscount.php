<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($groupId)
 */
class ProductCategoriesDiscount extends Model
{
    use HasFactory;

    // Récupérer les informations d'un groupe
    public function getInfos()
    {
        return GroupUser::where('id', $this->group_id)->first();
    }
}

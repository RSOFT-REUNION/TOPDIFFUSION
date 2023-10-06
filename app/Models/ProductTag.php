<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    // Obtenir des informations sur le groupe
    public function getGroupInfo()
    {
        return ProductGroupTag::where('id', $this->group_id)->first();
    }


}

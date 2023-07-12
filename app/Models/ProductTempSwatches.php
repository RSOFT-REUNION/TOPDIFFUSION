<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTempSwatches extends Model
{
    use HasFactory;

    public function getSwatchGroup()
    {
        return ProductGroupTag::where('id', $this->swatch_group_id)->first()->title;
    }

    public function getSwatchTag()
    {
        return ProductTag::where('id', $this->swatch_tags_id)->first()->title;
    }
}

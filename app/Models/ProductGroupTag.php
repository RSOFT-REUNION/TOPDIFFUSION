<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroupTag extends Model
{
    use HasFactory;

    public function getTypeText()
    {
        $types = [
            '',
            '<span class="text-sm bg-blue-900 text-white px-2 py-1 rounded-full"><i class="fa-solid fa-font mr-2"></i>Variante texte</span>',
            '<span class="text-sm bg-amber-400 text-black px-2 py-1 rounded-full"><i class="fa-solid fa-palette mr-2"></i>Variante couleur</span>',
        ];

        return isset($types[$this->type]) ? $types[$this->type] : null;
    }

    public function hasOptions()
    {
        $options = ProductTag::where('group_id', $this->id)->get();
        if($options->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

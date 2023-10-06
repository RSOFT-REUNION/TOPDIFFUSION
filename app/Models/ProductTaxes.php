<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTaxes extends Model
{
    use HasFactory;

    // Affichage d'une taxe par défaut avec des symboles
    public function getDefaultIcon()
    {
        $default = [
            '',
            '<i class="fa-solid fa-circle-check text-green-500"></i>'
        ];

        return isset($default[$this->default]) ? $default[$this->default] : null;
    }
}

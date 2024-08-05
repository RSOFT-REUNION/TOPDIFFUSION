<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvaRate extends Model
{
    use HasFactory;

    // Affichage d'un badge pour la TVA par défaut
    public function getDefault()
    {
        if($this->default == 1) {
            return '<span class="text-green-600 bg-green-100 border border-green-200 text-sm py-1 px-2 rounded-full"><i class="fa-solid fa-check mr-2"></i>Oui</span>';
        } else {
            return '--';
        }
    }
}

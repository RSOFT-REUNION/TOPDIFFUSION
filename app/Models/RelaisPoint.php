<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelaisPoint extends Model
{
    use HasFactory;

    protected $casts = [
        'available' => 'boolean',
    ];

    public function getFormattedOpeningHours()
    {
        // Divisez le texte en un tableau en utilisant le caractère de saut de ligne comme séparateur
        $openingHoursArray = explode("\n", $this->opening_hours);

        // Initialisez un tableau associatif pour stocker les heures d'ouverture formatées
        $formattedOpeningHours = [];

        // Parcourez chaque ligne du tableau
        foreach ($openingHoursArray as $line) {
            // Divisez la ligne en deux parties : jour et heures
            $parts = explode(':', $line, 2);

            // Vérifiez si la ligne est bien divisée en deux parties
            if (count($parts) === 2) {
                // Nettoyez les espaces inutiles
                $day = trim($parts[0]);
                $hours = trim($parts[1]);

                // Ajoutez au tableau associatif
                $formattedOpeningHours[$day] = $hours;
            }
        }

        return $formattedOpeningHours;
    }

    public function isAvailable()
    {
        return filter_var($this->available, FILTER_VALIDATE_BOOLEAN);
    }


    public function userOrders()
    {
        return $this->hasMany(UserOrder::class, 'relais_point_id');
    }
}

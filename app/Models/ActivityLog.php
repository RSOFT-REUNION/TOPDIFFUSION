<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    public static function logActivity($userId, $activityType, $activityDescription)
    {
        $activityLog = new ActivityLog;
        $activityLog->user_id = $userId;
        $activityLog->activity_type = $activityType;
        $activityLog->activity_description = $activityDescription;
        $activityLog->save();
    }
    public function getActivityColor()
    {
        switch ($this->activity_type) {
            case 'Commande créée':
            case 'Commande passée':
                return 'bg-green-400'; // Vert vif pour Commande créée et Commande passée
            case 'Article ajouté au panier':
                return 'bg-blue-400'; // Bleu vif pour Article ajouté au panier
            case 'Article supprimé du panier':
                return 'bg-red-500'; // Rouge vif pour Article supprimé du panier
            case 'Inscription':
                return 'bg-purple-400'; // Violet vif pour Inscription
            default:
                return 'bg-gray-200'; // Par défaut, utilisez une couleur grise légèrement plus claire
        }
    }
}

<?php

namespace App\Http\Livewire\Pages\Back;

use App\Models\ActivityLog;
use App\Models\MyProduct;
use App\Models\User;
use App\Models\UserOrderItem;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Dashboard extends Component
{

    public $sales, $productCreated, $newAccountCreated, $productMoreSold, $activityLog;

    public function mount()
    {
        $this->sales = $this->salesPerWeek();
        $this->productCreated = $this->productCreateThisMonth();
        $this->newAccountCreated = $this->newAccountCreatedThisMonth();
        $this->productMoreSold = $this->productMoreSold();
        $this->activityLog = $this->getActivityLog();
    }
    public function salesPerWeek()
    {
        // Obtenez les ventes pour la semaine actuelle
        $currentWeekData = UserOrderItem::selectRaw('COUNT(*) as total_sales')
            ->whereRaw('strftime("%Y-%W", created_at) = strftime("%Y-%W", date("now"))')
            ->first();

        return $currentWeekData;
    }

    public function productCreateThisMonth()
    {
        // Obtenir le nombre de produits créés ce mois-ci
        $currentMonthData = MyProduct::selectRaw('COUNT(*) as total_productCreated')
            ->whereRaw('strftime("%Y-%m", created_at) = strftime("%Y-%m", date("now"))')
            ->first();

        return $currentMonthData;
    }

    public function newAccountCreatedThisMonth ()
    {
        // Obtenir le nombre de nouveaux comptes créer ce mois-ci
        $newAccount = User::selectRaw('COUNT(*) as total_new_account')
            ->whereRaw('strftime("%Y-%m", created_at) = strftime("%Y-%m", date("now"))')
            ->first();

        return $newAccount;
    }

    public function productMoreSold()
    {
        // Obtenir le produit le plus vendu ce mois-ci
        $productMoreSold = UserOrderItem::selectRaw('my_products.title as product_name, COUNT(*) as total_sales')
            ->join('my_products', 'user_order_items.product_id', '=', 'my_products.id')
            ->whereRaw('strftime("%Y-%m", user_order_items.created_at) = strftime("%Y-%m", date("now"))')
            ->groupBy('user_order_items.product_id')
            ->orderByDesc('total_sales')
            ->first();

        return $productMoreSold;
    }

    public function getActivityLog()
    {
        // Récupérez les données avec l'heure d'enregistrement
        $activityLog = ActivityLog::orderByDesc('created_at')->get();

        // Modifiez les descriptions d'activité pour inclure le temps écoulé
        $activityLog->transform(function ($log) {
            $timeAgo = now()->diffInMinutes($log->created_at);
            $log->activity_description = $log->activity_description . ' il y a ' . $timeAgo . ' minutes';
            return $log;
        });

        return $activityLog;
    }



    public function render()
    {
        return view('livewire.pages.back.dashboard');
    }
}

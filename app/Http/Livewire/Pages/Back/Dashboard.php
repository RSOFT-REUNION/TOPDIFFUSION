<?php

namespace App\Http\Livewire\Pages\Back;

use App\Models\ActivityLog;
use App\Models\MyProduct;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Dashboard extends Component
{

    public $sales, $productCreated, $newAccountCreated, $productMoreSold, $averagePurchase, $totalSalesRevenue;

    protected $activityLog = [];
    public function mount()
    {
        $this->sales = $this->salesPerWeek();
        $this->productCreated = $this->productCreateThisMonth();
        $this->newAccountCreated = $this->newAccountCreatedThisMonth();
        $this->productMoreSold = $this->productMoreSold();
        $this->activityLog = $this->getActivityLog();
        $this->averagePurchase = $this->averagePurchase();
        $this->totalSalesRevenue = $this->salesRevenue();
        $this->monthlyAverage = $this->averagePurchase();
    }
    public function salesPerWeek()
    {
        // Obtenez les ventes pour la semaine actuelle
        $currentWeekData = UserOrderItem::count('total_sales')
        ->whereMonth('created_at', now()->month)
            ->first();

        return $currentWeekData;
    }

    public function productCreateThisMonth()
    {
        // Obtenir le nombre de produits créés ce mois-ci
        $currentMonthData = MyProduct::count('total_productCreated')
        ->whereMonth('created_at', now()->month)
            ->first();

        return $currentMonthData;
    }

    public function newAccountCreatedThisMonth ()
    {
        // Obtenir le nombre de nouveaux comptes créer ce mois-ci
        $newAccount = User::count('total_new_account')
            ->whereMonth('created_at', now()->month)
            ->first();

        return $newAccount;
    }

    public function productMoreSold()
    {
        // Obtenir le produit le plus vendu ce mois-ci
        //     $productMoreSold = UserOrderItem::selectRaw('my_products.title as product_name, COUNT(*) as total_sales')
        //     ->join('my_products', 'user_order_items.product_id', '=', 'my_products.id')
        //     ->whereRaw('DATE_FORMAT(user_order_items.created_at, "%Y-%m") = DATE_FORMAT(NOW(), "%Y-%m")')
        //     ->groupBy('user_order_items.product_id')
        //     ->orderByDesc('total_sales')
        //     ->first();


            return UserOrderItem::query()
            ->join('my_products', 'user_order_items.product_id', '=', 'my_products.id')
            ->select('my_products.title as product_name')
            ->count('total_sales')
            ->whereYear('user_order_items.created_at', now()->year)
            ->whereMonth('user_order_items.created_at', now()->month)
            ->orderByDesc('total_sales')
            ->first();

    }

    public function averagePurchase()
    {
        // Date il y a 7 jours à partir d'aujourd'hui
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Obtenir la somme des montants des commandes pour les 7 derniers jours
        $totalSalesRevenue = UserOrder::where('created_at', '>=', $sevenDaysAgo)
            ->sum('total_amount');

        // Obtenir le nombre de clients uniques ayant effectué des achats au cours de la période
        $uniqueCustomerCount = UserOrder::where('created_at', '>=', $sevenDaysAgo)
            ->distinct('user_id')
            ->count('user_id');


        // Calculer le panier moyen en fonction du nombre de clients
        if ($uniqueCustomerCount > 0) {
            $averagePurchase = $totalSalesRevenue / $uniqueCustomerCount;
        } else {
            $averagePurchase = null; // Valeur par défaut ici
        }

        // Formater le résultat avec une virgule comme séparateur décimal
        if ($averagePurchase !== null) {
            $averagePurchase = number_format($averagePurchase, 2, ',', '.');
        }

        return $averagePurchase;
    }

    public function salesRevenue()
    {
        // Date il y a 7 jours à partir d'aujourd'hui
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Obtenir la somme des montants des commandes pour les 7 derniers jours
        $totalSalesRevenue = UserOrderItem::where('created_at', '>=', $sevenDaysAgo)
            ->sum(DB::raw('quantity * product_price'));

        // Formater le chiffre d'affaires réalisé avec une virgule comme séparateur décimal
        $totalSalesRevenue = number_format($totalSalesRevenue, 2, ',', '.');

        return $totalSalesRevenue;
    }



    public function getActivityLog()
    {
        // Récupérez les données avec l'heure d'enregistrement
        $activityLog = ActivityLog::orderByDesc('created_at')->paginate(6);

        // Modifiez les descriptions d'activité pour inclure le temps écoulé
        $activityLog->transform(function ($log) {
            $timeAgo = now()->diffInMinutes($log->created_at);
            return $log;
        });

        return $activityLog;
    }



    public function render()
    {
        return view('livewire.pages.back.dashboard', [
            'activityLog' => $this->activityLog,
        ]);
    }
}

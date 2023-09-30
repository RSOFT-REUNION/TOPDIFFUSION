<?php

namespace App\Http\Livewire\Pages\Back;

use App\Models\UserOrderItem;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Dashboard extends Component
{

    public $sales;

    public function mount()
    {
        $this->sales = $this->salesPerWeek();
    }
    public function salesPerWeek()
    {
        // Utilisez Eloquent pour obtenir le nombre total de ventes par semaine
        return UserOrderItem::selectRaw('COUNT(*) as total_sales, strftime("%Y-%W", created_at) as week')
            ->groupBy('week')
            ->orderBy('week', 'ASC')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.back.dashboard');
    }
}

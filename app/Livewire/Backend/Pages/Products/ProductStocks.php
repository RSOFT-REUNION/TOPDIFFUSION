<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\ProductStock;
use Livewire\Component;
use Livewire\WithPagination;

class ProductStocks extends Component
{
    use WithPagination;

    protected $fillable = ['updateStock' => 'refresh'];

    public $stocks, $stock_available, $stock_low, $stock_off;

    public function mount()
    {
        $this->stocks = ProductStock::get();
        $this->stock_available = ProductStock::where('quantity', '>', 3)->get();
        $this->stock_low = ProductStock::where('quantity', '<=', 3)->where('quantity', '>', 0)->get();
        $this->stock_off = ProductStock::where('quantity', '<', 1)->get();
    }

    public function refresh()
    {
        $this->stocks = ProductStock::get();
        $this->stock_available = ProductStock::where('quantity', '>', 3)->get();
        $this->stock_low = ProductStock::where('quantity', '<=', 3)->where('quantity', '>', 0)->get();
        $this->stock_off = ProductStock::where('quantity', '<', 1)->get();
    }

    public function render()
    {
        // TODO: Ajouter la pagination
        $data = [];
        $data['stocks'] = $this->stocks;
        return view('livewire.backend.pages.products.product-stocks', $data);
    }
}

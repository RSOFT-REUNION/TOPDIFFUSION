<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProductStock;
use App\Models\ProductStock;
use Livewire\Component;

class Stocks extends Component
{
    public $updatedQuantities = [];
    public $updatedLowQuantities = [];

    public function updateLowStock()
    {
        foreach ($this->updatedLowQuantities as $stockId => $quantity) {
            $stock = MyProductStock::find($stockId);

            if ($stock) {
                $stock->update([
                    'quantity' => $quantity
                ]);
            }
        }

        return redirect()->route('back.product.stocks');
    }
    public function updateOffStock()
    {
        foreach ($this->updatedQuantities as $stockId => $quantity) {
            $stock = MyProductStock::find($stockId);

            if ($stock) {
                $stock->update([
                    'quantity' => $quantity
                ]);
            }
        }

        return redirect()->route('back.product.stocks');
    }
    public function render()
    {
        $data = [];
        $data['stocks'] = MyProductStock::where('quantity', '>', 3)->get();
        $data['off_stock'] = MyProductStock::where('quantity', 0)->get();
        $data['low_stock'] = MyProductStock::whereIn('quantity', [1, 2, 3])->get();
        return view('livewire.pages.back.products.stocks', $data);
    }
}

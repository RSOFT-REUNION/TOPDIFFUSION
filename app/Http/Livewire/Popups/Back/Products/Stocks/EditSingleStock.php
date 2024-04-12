<?php

namespace App\Http\Livewire\Popups\Back\Products\Stocks;

use App\Models\MyProduct;
use App\Models\MyProductStock;
use App\Models\MyProductSwatch;
use Livewire\Component;
use LivewireUI\Modal\Modal;
use LivewireUI\Modal\ModalComponent;

class EditSingleStock extends ModalComponent
{
    public $product;
    public $swatches;

    public $updateQuantities = [];

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function mount($product)
    {
        $this->product = MyProduct::where('id', $product)->first();
        $this->swatches = MyProductSwatch::where('product_id', $product)->get();
        if($this->product->type == 1) {

        }
    }

    public function updateStocks()
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
        $data['swatches'] = MyProductSwatch::where('product_id', $this->product->id)->get();
        $data['stocks'] = MyProductStock::where('product_id', $this->product->id)->get();
        return view('livewire.popups.back.products.stocks.edit-single-stock', $data);
    }
}

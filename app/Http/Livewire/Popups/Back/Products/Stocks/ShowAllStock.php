<?php

namespace App\Http\Livewire\Popups\Back\Products\Stocks;

use App\Models\MyProductStock;
use LivewireUI\Modal\ModalComponent;

class ShowAllStock extends ModalComponent
{
    /**
     * AGRANDIR LA MODAL
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        $data = [];
        $data['products'] = MyProductStock::where('quantity', '>', 0)->get();
        return view('livewire.popups.back.products.stocks.show-all-stock', $data);
    }

}

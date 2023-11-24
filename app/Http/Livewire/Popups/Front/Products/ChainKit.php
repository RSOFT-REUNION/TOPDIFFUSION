<?php

namespace App\Http\Livewire\Popups\Front\Products;

use App\Models\bike;
use App\Models\CompatibleBike;
use App\Models\MyProduct;
use App\Models\MyProductSwatch;
use LivewireUI\Modal\ModalComponent;

class ChainKit extends ModalComponent
{
    public $bike;
    public $products = [];
    public $chain, $crown, $gear;
    public $chain_price = 0;
    public $crown_price = 0;
    public $gear_price = 0;

    public $chain_type, $crown_type, $gear_type;

    // passer la taille de la modal en 6xl
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function mount($bike)
    {
        $this->bike = bike::where('id', $bike)->first();
        $this->products = MyProduct::join('compatible_bikes', 'my_products.id', '=', 'compatible_bikes.product_id')
            ->where('my_products.type', 3)
            ->where('compatible_bikes.bike_id', $this->bike->id)
            ->get(['my_products.*']);
    }

    public function updated()
    {
        if($this->chain_type != null) {
            $this->chain = MyProductSwatch::where('id', $this->chain_type)->first();
            $this->chain_price = $this->chain->price_ttc;
        }
        if($this->crown_type != null) {
            $this->crown = MyProductSwatch::where('id', $this->crown_type)->first();
            $this->crown_price = $this->crown->price_ttc;
        }
        if($this->gear_type != null) {
            $this->gear = MyProductSwatch::where('id', $this->gear_type)->first();
            $this->gear_price = $this->gear->price_ttc;
        }

        if($this->chain_type && $this->gear_type && $this->crown_type) {
            $this->price = $this->chain_price + $this->gear_price + $this->crown_price;
        }
    }


    public function render()
    {
        $data = [];
        $data['product_swatches'] = MyProductSwatch::all();
        return view('livewire.popups.front.products.chain-kit', $data);
    }
}

<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\Product;
use App\Models\ProductBike;
use Livewire\Component;

class ProductListBike extends Component
{
    public $bike;
    public $products = [];

    public function mount($bike)
    {
        $this->bike = $bike;
        $this->getProducts();
    }

    private function getProducts()
    {
        $product_bikes = ProductBike::where('bike_id', $this->bike->id)->get();
        foreach ($product_bikes as $bike) {
            $product = Product::find($bike->product_id);
            $this->products[] = $product;
        }
    }

    public function render()
    {
        $data = [];
        $data['products'] = $this->products;
        return view('livewire.frontend.pages.products.product-list-bike', $data);
    }
}

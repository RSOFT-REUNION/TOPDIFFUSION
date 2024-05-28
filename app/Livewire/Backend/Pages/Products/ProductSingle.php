<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\Product;
use App\Models\ProductData;
use App\Models\ProductStock;
use Livewire\Component;

class ProductSingle extends Component
{
    public $product;
    public $product_data;
    public $stock;
    public $kit_info = [];

    public function mount($product_id)
    {
        $this->product = Product::where('id', $product_id)->first();
        if($this->product->type == 'kit') {
            $this->product_data = ProductData::where('product_id', $product_id)->first();
            if($this->product->getKitElement() == 'chain') {
                $this->kit_info = $this->product->getChainInformations();
            } elseif($this->product->getKitElement() == 'pignon') {
                $this->kit_info = $this->product->getPignonInformations();
            } elseif($this->product->getKitElement() == 'crown') {
                $this->kit_info = $this->product->getCrownInformations();
            }
        } elseif($this->product->type == 'simple') {
            $this->product_data = ProductData::where('product_id', $product_id)->first();
        } else {
            $this->product_data = ProductData::where('product_id', $product_id)->get();
        }
        $this->stock = ProductStock::where('product_id', $product_id)->where('variant_id', $this->product_data->id)->first()->quantity;
    }

    public function render()
    {
        return view('livewire.backend.pages.products.product-single');
    }
}

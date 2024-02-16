<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use App\Models\MyProductStock;
use Livewire\Component;

class ProductSingle extends Component
{
    public $product;
    public $product_stock;
    public $title, $slug, $short_description, $long_description;

    public function mount($product_id)
    {
        $this->product = MyProduct::where('id', $product_id)->first();
        $this->product_stock = MyProductStock::where('product_id', $product_id)->first();
        $this->title = $this->product->title;
        $this->slug = $this->product->slug;
        $this->short_description = $this->product->short_description;
        $this->long_description = $this->product->long_description;
    }

    public function render()
    {
        return view('livewire.pages.back.products.product-single');
    }
}

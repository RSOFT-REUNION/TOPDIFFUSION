<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\Product;
use App\Models\ProductBike;
use App\Models\ProductData;
use App\Models\ProductInfo;
use App\Models\ProductStock;
use Livewire\Component;

class ProductSingle extends Component
{
    public $product;
    public $product_data;
    public $stock;
    public $bikes;
    public $informations;
    public $variants;
    public $kit_info = [];

    protected $listeners = ['updateStock' => 'refresh'];

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
        if($this->product->type != 'variable') {
            $this->stock = ProductStock::where('product_id', $product_id)->where('variant_id', $this->product_data->id)->first()->quantity;
        } else {
            $this->stock = 'Plusieurs';
        }
        $this->bikes = ProductBike::where('product_id', $product_id)->get();
        $this->informations = ProductInfo::where('product_id', $product_id)->get();
        $this->variants = ProductData::where('product_id', $product_id)->get();
    }

    public function refresh()
    {
        $this->mount($this->product->id);
    }

    public function deleteBike($id)
    {
        ProductBike::where('id', $id)->delete();
        $this->bikes = ProductBike::where('product_id', $this->product->id)->get();
    }

    public function deleteInfo($id)
    {
        ProductInfo::where('id', $id)->delete();
        $this->informations = ProductInfo::where('product_id', $this->product->id)->get();
    }

    public function deleteVariant($id)
    {
        ProductData::where('id', $id)->delete();
        $this->variants = ProductData::where('product_id', $this->product->id)->get();
    }

    public function deleteProduct()
    {
        // TODO : gérer la suppression de toutes les tables lié
        $product = Product::where('id', $this->product->id)->first();
        $product->active = 0;
        $product->save();

        return to_route('bo.products.list');
    }

    public function render()
    {
        return view('livewire.backend.pages.products.product-single');
    }
}

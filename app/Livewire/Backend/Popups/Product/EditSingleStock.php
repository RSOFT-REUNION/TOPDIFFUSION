<?php

namespace App\Livewire\Backend\Popups\Product;

use App\Models\Product;
use App\Models\ProductData;
use App\Models\ProductStock;
use LivewireUI\Modal\ModalComponent;

class EditSingleStock extends ModalComponent
{
    public $product;
    public $product_data;
    public $quantity;

    public function mount($product_id, $product_data)
    {
        $this->product = Product::where('id', $product_id)->first();
        $data = ProductData::where('id', $product_data)->first();
        $this->product_data = $data;
        $this->quantity = ProductStock::where('product_id', $product_id)->where('variant_id', $data->id)->first()->quantity;
        // TODO: Gérer les produits déclinés
    }

    // Modifier le stock du produit
    public function editStock()
    {
        $data = $this->product_data;
        $stock = ProductStock::where('product_id', $this->product->id)->where('variant_id', $data->id)->first();
        $stock->quantity = $this->quantity;
        $stock->save();

        // TODO: Gérer les produits déclinés + Ajout de logs
        $this->dispatch('updateStock');
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.backend.popups.product.edit-single-stock');
    }
}

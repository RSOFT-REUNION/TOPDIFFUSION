<?php

namespace App\Livewire\Backend\Popups\Product;

use App\Models\Product;
use App\Models\ProductData;
use App\Models\ProductStock;
use LivewireUI\Modal\ModalComponent;

class EditSingleStock extends ModalComponent
{
    public $product;
    public $quantity;

    public function mount($product_id)
    {
        $this->product = Product::where('id', $product_id)->first();
        $data = ProductData::where('product_id', $product_id)->first();
        $this->quantity = ProductStock::where('product_id', $product_id)->where('variant_id', $data->id)->first()->quantity;
        // TODO: Gérer les produits déclinés
    }

    // Modifier le stock du produit
    public function editStock()
    {
        $data = ProductData::where('product_id', $this->product->id)->first();
        $stock = ProductStock::where('product_id', $this->product->id)->where('variant_id', $data->id)->first();
        $stock->quantity = $this->quantity;
        $stock->save();

        // TODO: Gérer les produits déclinés + Ajout de logs
        return to_route('bo.products.single', ['product_id' => $this->product->id])->with('success', 'Le stock du produit a bien été modifié.');
    }

    public function render()
    {
        return view('livewire.backend.popups.product.edit-single-stock');
    }
}

<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\CompatibleBike;
use App\Models\MyProduct;
use App\Models\MyProductInfo;
use App\Models\MyProductPicture;
use App\Models\MyProductStock;
use App\Models\MyProductSwatch;
use App\Models\UserCart;
use App\Models\UserOrderItem;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ProductSingle extends Component
{
    public $product;
    public $product_stocks;
    public $product_swatches;
    public $title, $slug, $short_description, $long_description;

    public function mount($product_id)
    {
        $this->product = MyProduct::where('id', $product_id)->first();
        $this->product_stocks = MyProductStock::where('product_id', $product_id)->get();
        $this->product_swatches = MyProductSwatch::where('product_id', $product_id)->get();
        $this->title = $this->product->title;
        $this->slug = $this->product->slug;
        $this->short_description = $this->product->short_description;
        $this->long_description = $this->product->long_description;
    }

    // Avoir le stock global de l'article
    public function getStockQuantity()
    {
        $stock = 0;
        foreach ($this->product_stocks as $stocks) {
            // Nous effectuons un cummule sur les quantités enregistré
            $stock += $stocks->quantity;
        }
        return $stock; // Nous retournons la valeur
    }

    // Suppresion de produit
    public function deletedProduct()
    {
        $carts = UserCart::where('product_id', $this->product->id)->get()->count();
        $orders = UserOrderItem::where('product_id', $this->product->id)->get()->count();

        // Vérification que le produit ne possèdent aucune vente ou ne fait partie d'aucun panier
        if($carts === 0 && $orders === 0) {
            // Cet article n'a jamais été vendu
            foreach ($this->product_stocks as $stocks) {
                // Suppression des stocks
                $stocks->delete();
            }

            foreach ($this->product_swatches as $swatch) {
                // Suppression des déclinaisons
                $swatch->delete();
            }

            // Déclarations des variables
            $product = $this->product;
            $product_pictures = MyProductPicture::where('product_id', $product->id)->get();
            $product_bikes = CompatibleBike::where('product_id', $product->id)->get();
            $product_infos = MyProductInfo::where('product_id', $product->id)->get();

            if($product_pictures->count() > 0) {
                // Nous supprimons toutes les photos lié au produit
                foreach ($product_pictures as $picture)
                {
                    $picture->delete();
                }
            }
            if($product_infos->count() > 0) {
                // Nous supprimons toutes les informations lié au produit
                foreach ($product_infos as $info)
                {
                    $info->delete();
                }
            }
            if($product_bikes->count() > 0) {
                // Nous supprimons toutes les motos lié au produit
                foreach ($product_bikes as $bike)
                {
                    $bike->delete();
                }
            }

            if(Storage::exists('storage/images/products/'. $product->cover))
            {
                // Nous vérifions si une image de couverture existe pour le produit et nous la supprimons
                Storage::delete('storage/images/products/'. $product->cover);
            }
            // TODO: Il faudrait supprimer les photos dans attachement également.

            $product->delete();

            return redirect()->route('back.product.list')->with('success', 'Votre produit a bien été supprimé');
        } else {
            return redirect()->route('back.product.single', $this->product->id)->with('error', 'Votre produit ne pas être supprimé');
        }

    }

    public function render()
    {
        $data = [];
        $data['product_quantity'] = $this->getStockQuantity();
        return view('livewire.pages.back.products.product-single', $data);
    }
}

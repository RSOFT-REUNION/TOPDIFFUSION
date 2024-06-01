<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Avoir le tarif unitaire HT par rapport aux paramètres
    public function getUnitPrice()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        if(auth()->check()) {
            if(auth()->user()->settings()->public_price == 0) {
                // Affichage des tarif de base
                return $data->price_unit;
            } else {
                // Récupération de la remise du client
                $discount = UserGroup::where('id', auth()->user()->group_id)->first()->discount;
                // Affichage des tarifs remisés
                return $data->price_unit - ($data->price_unit * $discount / 100);
            }
        } else {
            return $data->price_unit;
        }
    }

    public function setUnitPrice($product, $price)
    {
        $data = ProductData::where('product_id', $product->id)->get();
        foreach ($data as $d)
        {
            $d->price_unit = $price;
            $d->update();
        }
    }

    // Avoir le tarif unitaire TTC/HT par rapport aux paramètres
    public function getUnitPriceTVA()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        $tva = TvaRate::where('default', 1)->first()->rate;
        if(auth()->check()) {
            if(auth()->user()->settings()->public_price == 0) {
                // Affichage des tarif de base
                return $data->price_unit * (1 + $tva / 100);
            } else {
                // Récupération de la remise du client
                $discount = UserGroup::where('id', auth()->user()->group_id)->first()->discount;
                // Affichage des tarifs remisés
                return $data->price_unit - ($data->price_unit * $discount / 100) * (1 + $tva / 100);
            }
        } else {
            return $data->price_unit * (1 + $tva / 100);
        }

    }

    // Avoir le tarif unitaire HT par rapport aux paramètres
    public function getUnitPriceBack()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        if(auth()->check()) {
            return $data->price_unit;
        }
    }

    // Avoir le tarif unitaire TTC/HT par rapport aux paramètres
    public function getUnitPriceTVABack()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        $tva = TvaRate::where('default', 1)->first()->rate;
        if(auth()->check()) {
            return $data->price_unit * (1 + $tva / 100);
        }

    }

    // Avoir le tarif unitaire sans remises
    public function getUnitPriceWithoutDiscount()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        return $data->price_unit;
    }

    // Avoir les informations sur la catégorie du produit
    public function getCategory()
    {
        return ProductCategory::where('id', $this->category_id)->first();
    }

    // Avoir les informations sur la catégorie du produit
    public function getBrand()
    {
        return ProductBrand::where('id', $this->brand_id)->first();
    }

    public function getKitElement()
    {
        return ProductData::where('product_id', $this->id)->first()->kit_element;
    }

    // Récupérer les informations nécessaire pour les chaines
    public function getChainInformations()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        $infos = ProductInfo::where('product_id', $this->id)->pluck('value', 'key')->toArray();

        $informations = [
            'ugs' => $data->ugs_code,
            'pas' => $infos['Pas'],
            'type' => $infos['Type'],
            'longueur' => $infos['Longueur'],
            'couleur' => $infos['Couleur'],
        ];

        return $informations;
    }

    // Récupérer les informations nécessaire pour les chaines
    public function getPignonInformations()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        $infos = ProductInfo::where('product_id', $this->id)->pluck('value', 'key')->toArray();

        $informations = [
            'ugs' => $data->ugs_code,
            'pas' => $infos['Pas'],
            'denture' => $infos['Denture'],
            'matiere' => $infos['Matière'],
        ];

        return $informations;
    }

    // Récupérer les informations nécessaire pour les chaines
    public function getCrownInformations()
    {
        $data = ProductData::where('product_id', $this->id)->first();
        $infos = ProductInfo::where('product_id', $this->id)->pluck('value', 'key')->toArray();

        $informations = [
            'ugs' => $data->ugs_code,
            'pas' => $infos['Pas'],
            'denture' => $infos['Denture'],
            'matiere' => $infos['Matière'],
        ];

        return $informations;
    }

    // Avoir les informations du produit
    public function getInfo()
    {
        return ProductInfo::where('product_id', $this->id)->get();
    }

    // Avoir le type de produit sous forme de badge
    public function getTypeBadge()
    {
        $data = [
            'simple' => '<span class="text-sm text-blue-500 border border-blue-200 bg-blue-100 py-1 px-2 rounded-full">Simple</span>',
            'variable' => '<span class="text-sm text-purple-500 border border-purple-200 bg-purple-100 py-1 px-2 rounded-full">Décliné</span>',
            'kit' => '<span class="text-sm text-green-500 border border-green-200 bg-green-100 py-1 px-2 rounded-full">Kit chaine</span>',
        ];

        return isset($data[$this->type]) ? $data[$this->type] : null;
    }

    public function getStock()
    {
        if($this->type == 'simple') {
            return ProductStock::where('product_id', $this->id)->first();
        } else {
            return ProductStock::where('variant_id', $this->id)->first();
        }
    }

    // Récupérer les données de stocks
    public function getStockInformations()
    {
        if($this->type == 'simple') {
            $stock = ProductStock::where('product_id', $this->id)->first();
            if($stock->quantity < 1) {
                return 'rupture';
            } elseif($stock->quantity > 0 && $stock->quantity < 4) {
                return 'faible';
            } else {
                return 'disponible';
            }
        } else {
            $datas = ProductData::where('product_id', $this->id)->get();
            foreach ($datas as $data)
            {
                $stock = ProductStock::where('variant_id', $data->id)->first();
                if($stock->quantity < 1) {
                    return 'rupture';
                } elseif($stock->quantity > 0 && $stock->quantity < 4) {
                    return 'faible';
                } else {
                    return 'disponible';
                }
            }
        }
    }

    // Fonction afin de savoir si le produit est en favoris pour l'utilisateur
    public function isFavorite()
    {
        if(auth()->check()) {
            $favorite = UserFavoriteProduct::where('user_id', auth()->user()->id)->where('product_id', $this->id)->first();
            return $favorite ? true : false;
        } else {
            return false;
        }

    }
}

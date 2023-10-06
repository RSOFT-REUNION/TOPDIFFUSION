<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTempSwatches extends Model
{
    use HasFactory;

    public function getSwatchGroup()
    {
        return ProductGroupTag::where('id', $this->swatch_group_id)->first()->title;
    }

    public function getSwatchTag()
    {
        return ProductTag::where('id', $this->swatch_tags_id)->first()->title;
    }

    // Convertir les tarifs dans le bon format
    public function getPriceHT()
    {
        return number_format($this->price_ht, '2', ',', ' ');
    }
    public function getPriceTTC()
    {
        return number_format($this->price_ttc, '2', ',', ' ');
    }

    // Avoir la règle de TVA
    public function getTVA()
    {
        $tva = ProductTaxes::all();
        if($this->default_tva == 1) {
            $default_tva = $tva->where('default', 1)->first();
            return number_format($default_tva->rate, '2', ',');
        } else {
            $good_tva = ProductTaxes::where('id', $this->tva_class_id)->first();
            return number_format($good_tva->rate, '2', ',');
        }
    }

    // Récupérer le type de variante
    public function getVariantGroup()
    {
        if($this->type == 2 && $this->swatch_group_id != null) {
            return ProductGroupTag::where('id', $this->swatch_group_id)->first();
        } else {
            return null;
        }

    }

    // Récupérer la valeur de la variante
    public function getVariantItem()
    {
        if($this->type == 2 && $this->swatch_tags_id != null) {
            return ProductTag::where('id', $this->swatch_tags_id)->first();
        } else {
            return null;
        }
    }
}

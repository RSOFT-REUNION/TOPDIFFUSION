<?php

namespace App\Http\Livewire\Pages\Back\Products\ProductAdd;

use App\Models\CompatibleBike;
use App\Models\CompatibleTempBike;
use App\Models\MyProduct;
use App\Models\MyProductInfo;
use App\Models\MyProductPicture;
use App\Models\MyProductStock;
use App\Models\MyProductSwatch;
use App\Models\ProductTaxes;
use App\Models\ProductTemp;
use App\Models\ProductTempInfo;
use App\Models\ProductTempPictures;
use App\Models\ProductTempSwatches;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;

class AddProduct extends Component
{
    use WithFileUploads;

    public $product;
    public $title, $slug, $cover, $type;
    public $UGS;
    public $short_description, $long_description;
    public $TVA_custom = 'default';
    public $list_tva_custom;
    public $price_HT, $price_TTC;

    public $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï", "/", "(", ")"];
    public $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i", "-", "-", "-"];

    protected $listeners = ['refreshLines' => '$refresh'];

    public $active_tab = '1'; // Permet d'initié la première section active

    public function mount($product_id)
    {
        $this->product = ProductTemp::where('id', $product_id)->first();
        $this->title = $this->product->title;
        $this->type = $this->product->type;
        $this->slug = ($this->slug == $this->title) ? strtolower(str_replace($this->characters, $this->correct_characters, $this->title)) : strtolower(str_replace($this->characters, $this->correct_characters, $this->slug));
        $this->short_description = $this->product->short_description;
        $this->long_description = $this->product->long_description;
    }

    public function updatedTitle()
    {
        $this->slug = strtolower(str_replace($this->characters, $this->correct_characters, $this->title));
    }

    public function updated()
    {
        /*if($this->TVA_custom == 'default') {
            // Si nous utilisons la règle de TVA par défaut
            $tva = ProductTaxes::where('default', 1)->first();
            $tva_rate = $tva->rate / 100;
            if($this->price_HT) {
                $calc = $this->price_HT * $tva_rate;
                $this->price_TTC = round($this->price_HT + $calc, 2);
            }
        } elseif($this->TVA_custom == "custom") {
            $tva = ProductTaxes::where('id', $this->list_tva_custom)->first();
            if($tva) {
                $tva_rate = $tva->rate / 100;
                if($this->price_HT) {
                    $calc = round($this->price_HT * $tva_rate, 2);
                    $this->price_TTC = $this->price_HT + $calc;
                }
            }
        } else {
            $this->price_TTC = $this->price_HT;
        }*/
    }

    // Fonction permettant la création de l'article
    public function createProduct()
    {
        // Récupération des tables temporaires
        $temp_product = ProductTemp::where('id', $this->product->id)->first();
        $temp_swatch = ProductTempSwatches::where('product_id', $this->product->id)->get();
        $temp_picture = ProductTempPictures::where('product_id', $this->product->id)->get();
        $temp_info = ProductTempInfo::where('product_id', $this->product->id)->get();
        $temp_bike = CompatibleTempBike::all();

        // Création de produit
        $product = new MyProduct;
        $product->title = $temp_product->title;
        $product->slug = $temp_product->slug;
        $product->cover = $temp_product->cover;
        $product->type = $temp_product->type;
        $product->short_description = $temp_product->short_description;
        $product->long_description = $temp_product->long_description;
        $product->brand_id = $temp_product->brand_id;
        $product->category_id = $temp_product->category_id;
        if($product->save())
        {
            // Ajout des informations
            foreach($temp_info as $info)
            {
                $product_info = new MyProductInfo;
                $product_info->product_id = $product->id;
                $product_info->title = $info->title;
                $product_info->value = $info->value;
                $product_info->save();
            }

            // Ajout des photos
            foreach($temp_picture as $picture)
            {
                $product_picture = new MyProductPicture;
                $product_picture->product_id = $product->id;
                $product_picture->picture_url = $picture->picture_url;
                $product_picture->save();
            }

            // Ajout des motos compatibles
            foreach($temp_bike as $bike)
            {
                $product_bike = new CompatibleBike;
                $product_bike->product_id = $product->id;
                $product_bike->bike_id = $bike->bike_id;
                $product_bike->save();
            }

            // Ajout des variantes
            foreach ($temp_swatch as $ts)
            {
                if($product->type == 1) {
                    // Il s'agit d'un produit simple
                    $swatch = new MyProductSwatch;
                    $swatch->product_id = $product->id;
                    $swatch->type = '1';
                    $swatch->ugs = $ts->ugs;
                    $swatch->price_ht = $ts->price_ht;
                    $swatch->price_ttc = $ts->price_ttc;
                    $swatch->have_tva = $ts->have_tva;
                    $swatch->default_tva = $ts->default_tva;
                    $swatch->tva_rate = $ts->tva_rate;
                    if($swatch->save())
                    {
                        // Remplissage des stocks
                        $stock = new MyProductStock;
                        $stock->product_id = $product->id;
                        $stock->ugs = $swatch->ugs;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                } elseif($product->type == 2) {
                    $swatch = new MyProductSwatch;
                    $swatch->product_id = $product->id;
                    $swatch->type = '2';
                    $swatch->ugs = $ts->ugs;
                    $swatch->ugs_swatch = $ts->ugs_swatch;
                    $swatch->price_ht = $ts->price_ht;
                    $swatch->price_ttc = $ts->price_ttc;
                    $swatch->have_tva = $ts->have_tva;
                    $swatch->default_tva = $ts->default_tva;
                    $swatch->tva_rate = $ts->tva_rate;
                    $swatch->swatch_group_id = $ts->swatch_group_id;
                    $swatch->swatch_tags_id = $ts->swatch_tags_id;
                    if($swatch->save()) {
                        // Remplissage des stocks
                        $stock = new MyProductStock;
                        $stock->product_id = $product->id;
                        $stock->is_swatch = 1;
                        $stock->ugs = $swatch->ugs.'-'.$swatch->ugs_swatch;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                } elseif($product->type == 4) {
                    $swatch = new ProductTempSwatches;
                    $swatch->ugs = $ts->ugs;
                    $swatch->ugs_swatch = $ts->ugs_swatch;
                    $swatch->product_id = $ts->product->id;
                    $swatch->type = '4';
                    $swatch->tire_position = $ts->position;
                    $swatch->tire_width = $ts->width;
                    $swatch->tire_height = $ts->height;
                    $swatch->tire_diameter = $ts->diameter;
                    $swatch->tire_charge = $ts->indice;
                    $swatch->price_ht = $ts->price_ht;
                    $swatch->price_ttc = $ts->price_ttc;
                    $swatch->have_tva = $ts->have_tva;
                    $swatch->default_tva = $ts->default_tva;
                    if($swatch->save()) {
                        // Remplissage des stocks
                        $stock = new MyProductStock;
                        $stock->product_id = $product->id;
                        $stock->is_swatch = 1;
                        $stock->ugs = $swatch->ugs.'-'.$swatch->ugs_swatch;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                }
            }

            return redirect()->route('back.product.list');
        }

    }

    // Fonction permettant de recharger la page
    public function refresh()
    {
        return redirect()->route('back.product.show.create', ['id' => $this->product->id]);
    }

    // Permet de changer de section dans la page
    public function changeTab($tab)
    {
        switch ($tab) {
            case '1':
                $this->active_tab = '1';
                break;
            case '2':
                $this->active_tab = '2';
                break;
            case '3':
                $this->active_tab = '3';
                break;
            case '4':
                $this->active_tab = '4';
                break;
            case '5':
                $this->active_tab = '5';
                break;
        }
    }

    // Suppression de l'information
    public function deleteInfos($id)
    {
        $info = ProductTempInfo::where('id', $id)->first();
        $info->delete();
    }
    // Initialisation du produit avec les informations principal
    public function firstStep()
    {
        $temp = $this->product;
        $temp->title = $this->title;
        $temp->slug = $this->slug;
        $temp->type = $this->type;
        if ($this->cover) {
            $temp->cover = strtolower(str_replace($this->characters, $this->correct_characters, $this->title)) . '.' . $this->cover->extension();
        }
        $temp->short_description = $this->short_description;
        $temp->long_description = $this->long_description;
        if($temp->update())
        {
            if ($this->cover) {
                $this->cover->storeAs('public/images/products', strtolower(str_replace($this->characters, $this->correct_characters, $this->title)) . '.' . $this->cover->extension());
                return redirect()->route('back.product.show.create', ['id' => $this->product->id]);
            }
            $this->emit('refreshLines');
        }
    }

    // Ajout d'une swatch simple
    public function addSimpleSwatchTemp()
    {
        $temp_swatch = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 1)->first();
        if($temp_swatch) {
            // Modification de la swatch
        } else {
            // Vérification des champs
            $this->validate([
                'UGS' => 'required|unique:product_temp_swatches,ugs',
                'price_HT' => 'required',
                'price_TTC' => 'required',
                'TVA_custom' => 'required',
            ], [
                'UGS.required' => 'Le champs UGS est requis',
                'UGS.unique' => 'L\'UGS est déjà utilisé',
                'price_HT.required' => 'Le champs prix HT est requis',
                'price_TTC.required' => 'Le champs prix TTC est requis',
                'TVA_custom.required' => 'Le champs TVA est requis',
            ]);

            // Ajout de la swatch
            $temp = new ProductTempSwatches;
            $temp->product_id = $this->product->id;
            $temp->type = 1;
            $temp->ugs = $this->UGS;
            $temp->price_ht = number_format($this->price_HT, '2', '.');
            $temp->price_ttc = number_format($this->price_TTC, '2', '.');
            if($this->TVA_custom != 'TVA_custom-none') {
                $temp->have_tva = 1;
                $temp->tva_class_id = $this->list_tva_custom;
                if($this->TVA_custom == 'default') {
                    $temp->default_tva = 1;
                } else {
                    $temp->default_tva = 0;
                }
            } else {
                $temp->have_tva = 0;
            }
            if($temp->save())
            {
                $this->emit('refreshLines');
            }
        }

    }

    // Suppression d'une moto comptible
    public function deleteCompatibleBike($id)
    {
        $bike = CompatibleTempBike::where('id', $id)->first();
        $bike->delete();
        Session::flash('success', 'Moto supprimé');
        $this->emit('refreshLines');
    }

    // Suppression d'une variante
    public function deleteVariant($id)
    {
        $variant = ProductTempSwatches::where('id', $id)->first();
        $variant->delete();
        Session::flash('success', 'Variante supprimé');
        $this->emit('refreshLines');
    }

    // Suppression d'une photo
    public function deletePicture($id)
    {
        $picture = ProductTempPictures::where('id', $id)->first();
        $picture->delete();
        Session::flash('success', 'Photo supprimé');
        $this->emit('refreshLines');
    }

    public function render()
    {
        $data = [];
        $data['tab'] = $this->active_tab;
        $data['informations'] = ProductTempInfo::where('product_id', $this->product->id)->get();
        $data['temp_product'] = ProductTemp::where('id', $this->product->id)->first();
        $data['temp_swatch'] = ProductTempSwatches::where('product_id', $this->product->id)->get();
        $data['temp_pictures'] = ProductTempPictures::where('product_id', $this->product->id)->get();
        $data['taxes'] = ProductTaxes::all();
        $data['bikes'] = CompatibleTempBike::paginate(10);
        return view('livewire.pages.back.products.product-add.add-product', $data);
    }
}

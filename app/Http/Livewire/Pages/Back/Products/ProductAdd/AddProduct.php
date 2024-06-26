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
    public $title, $slug, $cover, $type, $kit_type;
    public $UGS;
    public $short_description, $long_description;
    public $chains_reference, $chains_ugs, $gear_reference, $gear_ugs, $crown_reference, $crown_ugs;
    public $TVA_custom = 'default';
    public $list_tva_custom;
    public $price_HT, $price_TTC;
    public $checkEtap1;

    public $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï", "/", "(", ")"];
    public $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i", "-", "-", "-"];

    protected $listeners = ['refreshLines' => '$refresh'];
    protected $listenerss = ['triggerFirstStep' => 'firstStep'];

    public $active_tab = '1'; // Permet d'initié la première section active

    public function mount($product_id)
    {
        $this->product = ProductTemp::where('id', $product_id)->first();
        $this->title = $this->product->title;
        $this->type = $this->product->type;
        $this->kit_type = $this->product->kit_element;
        $this->slug = ($this->slug == $this->title) ? strtolower(str_replace($this->characters, $this->correct_characters, $this->title)) : strtolower(str_replace($this->characters, $this->correct_characters, $this->slug));
        $this->short_description = $this->product->short_description;
        $this->long_description = $this->product->long_description;
    }

    public function updatedTitle()
    {
        $this->slug = strtolower(str_replace($this->characters, $this->correct_characters, $this->title));
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
        $product->kit_element = $temp_product->kit_element;
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
                        $stock->swatch_id = $swatch->id;
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
                        $stock->swatch_id = $swatch->id;
                        $stock->is_swatch = 1;
                        $stock->ugs = $swatch->ugs.'-'.$swatch->ugs_swatch;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                } elseif($product->type == 4) {
                    // Pneus
                    $swatch = new MyProductSwatch;
                    $swatch->ugs = $ts->ugs;
                    $swatch->ugs_swatch = $ts->ugs_swatch;
                    $swatch->product_id = $product->id;
                    $swatch->type = '4';
                    $swatch->tire_position = $ts->tire_position;
                    $swatch->tire_width = $ts->tire_width;
                    $swatch->tire_height = $ts->tire_height;
                    $swatch->tire_diameter = $ts->tire_diameter;
                    $swatch->tire_charge = $ts->tire_charge;
                    $swatch->price_ht = $ts->price_ht;
                    $swatch->price_ttc = $ts->price_ttc;
                    $swatch->have_tva = $ts->have_tva;
                    $swatch->default_tva = $ts->default_tva;
                    if($swatch->save()) {
                        // Remplissage des stocks
                        $stock = new MyProductStock;
                        $stock->product_id = $product->id;
                        $stock->swatch_id = $swatch->id;
                        $stock->is_swatch = 1;
                        $stock->ugs = $swatch->ugs.'-'.$swatch->ugs_swatch;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                } elseif ($product->type == 3) {
                    if($product->kit_element == 1) {
                        $swatch = new MyProductSwatch;
                        $swatch->product_id = $product->id;
                        $swatch->type = '3';
                        $swatch->ugs = $ts->ugs;
                        $swatch->ugs_swatch = $ts->ugs_swatch;
                        $swatch->chains_reference = $ts->chains_reference;
                        $swatch->chains_length = $ts->chains_length;
                        $swatch->price_ht = $ts->price_ht;
                        $swatch->price_ttc = $ts->price_ttc;
                        $swatch->have_tva = $ts->have_tva;
                        $swatch->default_tva = $ts->default_tva;
                        if($swatch->save()) {
                            // Remplissage des stocks
                            $stock = new MyProductStock;
                            $stock->product_id = $product->id;
                            $stock->swatch_id = $swatch->id;
                            $stock->is_swatch = 1;
                            $stock->ugs = $swatch->ugs.'-'.$swatch->ugs_swatch;
                            $stock->quantity = 0;
                            $stock->save();
                        }
                    } elseif($product->kit_element == 2) {
                        $swatch = new MyProductSwatch;
                        $swatch->product_id = $product->id;
                        $swatch->type = '3';
                        $swatch->ugs = $ts->ugs;
                        $swatch->ugs_swatch = $ts->ugs_swatch;
                        $swatch->gear_reference = $ts->gear_reference;
                        $swatch->gear_tooth = $ts->gear_tooth;
                        $swatch->price_ht = $ts->price_ht;
                        $swatch->price_ttc = $ts->price_ttc;
                        $swatch->have_tva = $ts->have_tva;
                        $swatch->default_tva = $ts->default_tva;
                        if($swatch->save()) {
                            // Remplissage des stocks
                            $stock = new MyProductStock;
                            $stock->product_id = $product->id;
                            $stock->swatch_id = $swatch->id;
                            $stock->is_swatch = 1;
                            $stock->ugs = $swatch->ugs.'-'.$swatch->ugs_swatch;
                            $stock->quantity = 0;
                            $stock->save();
                        }
                    } else {
                        $swatch = new MyProductSwatch;
                        $swatch->product_id = $product->id;
                        $swatch->type = '3';
                        $swatch->ugs = $ts->ugs;
                        $swatch->ugs_swatch = $ts->ugs_swatch;
                        $swatch->crown_reference = $ts->crown_reference;
                        $swatch->crown_tooth = $ts->crown_tooth;
                        $swatch->price_ht = $ts->price_ht;
                        $swatch->price_ttc = $ts->price_ttc;
                        $swatch->have_tva = $ts->have_tva;
                        $swatch->default_tva = $ts->default_tva;
                        if($swatch->save()) {
                            // Remplissage des stocks
                            $stock = new MyProductStock;
                            $stock->product_id = $product->id;
                            $stock->swatch_id = $swatch->id;
                            $stock->is_swatch = 1;
                            $stock->ugs = $swatch->ugs.'-'.$swatch->ugs_swatch;
                            $stock->quantity = 0;
                            $stock->save();
                        }
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
        $this->validate([
            'title' => 'required|min:3',
            'short_description' => 'required|min:10',
            'long_description' => 'required|min:15',
            'type' => 'required',
            'slug' => 'required',
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'title.min' => 'Le titre doit comporter au moins 3 caractères.',
            'short_description.required' => 'La description courte est obligatoire',
            'short_description.min' => 'La description courte doit comporter au moins 10 caractères.',
            'long_description.required' => 'La description courte est obligatoire',
            'long_description.min' => 'La description courte doit comporter au moins 15 caractères.',
            'type.required' => 'Le choix du type de produit est obligatoire',
            'slug' => 'Le slug est obligatoire',
        ]);

        $temp = $this->product;
        $temp->title = $this->title;
        $temp->slug = $this->slug;
        $temp->kit_element = $this->kit_type;
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
        $this->changeTab('2');

        if($temp->title && $temp->type  && $temp->short_description && $temp->long_description) {
            $this->checkEtap1 = true;
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

    // Ajout d'un élément Kit chaine - chaine
    public function addChainKitChainTemp()
    {
        //
    }

    // Suppression d'une moto comptible
    public function deleteCompatibleBike($id)
    {
        $bike = CompatibleTempBike::where('id', $id)->first();
        $bike->delete();
        Session::flash('success', 'Moto supprimée');
        $this->emit('refreshLines');
    }

    // Suppression d'une variante
    public function deleteVariant($id)
    {
        $variant = ProductTempSwatches::where('id', $id)->first();
        $variant->delete();
        Session::flash('success', 'Variante supprimée');
        $this->emit('refreshLines');
    }

    // Suppression d'une photo
    public function deletePicture($id)
    {
        $picture = ProductTempPictures::where('id', $id)->first();
        $picture->delete();
        Session::flash('success', 'Photo supprimée');
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
        $data['temp_chains'] = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 3)->where('chains_reference', '!=', null)->get();
        $data['temp_gears'] = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 3)->where('gear_reference', '!=', null)->get();
        $data['temp_crowns'] = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 3)->where('crown_reference', '!=', null)->get();
        return view('livewire.pages.back.products.product-add.add-product', $data);
    }
}

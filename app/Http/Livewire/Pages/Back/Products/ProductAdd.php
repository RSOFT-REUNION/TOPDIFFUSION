<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\bike;
use Livewire\Component;
use App\Models\MyProduct;
use App\Models\ProductTag;
use App\Models\ProductTemp;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use App\Models\ProductTaxes;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\MyProductInfo;
use Livewire\WithFileUploads;
use App\Models\CompatibleBike;
use App\Models\MyProductStock;
use App\Models\MyProductSwatch;
use App\Models\ProductCategory;
use App\Models\ProductGroupTag;
use App\Models\ProductTempInfo;
use App\Models\MyProductPicture;
use App\Models\CompatibleTempBike;
use App\Models\ProductTempPictures;
use App\Models\ProductTempSwatches;
use Illuminate\Support\Facades\Session;

class ProductAdd extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $product;
    public $test, $title, $parent_category, $cover, $type, $pourcentage_price, $professionnal_price, $customer_price, $TVA_Custom, $TVA_None, $TVA_Class, $UGS, $brand, $stock_quantity, $short_description, $long_description, $slug, $delivery;
    public $chain, $pas, $pignon, $crown, $width, $UGS_swatch, $tire_width, $tire_height, $tire_diameter, $tire_charge, $swatch_group, $swatch_value, $picture, $info_group, $info_value;

    public $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï", "/", "(", ")"];
    public $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i", "-", "-", "-"];

    public $showAddKit = false;
    public $showAddTires = false;
    public $showAddVariant = false;
    public $showAddTag = false;
    public $showAddPicture = false;

    public $bike_selected = [];
    public $userBikeCompatible = false;
    public $findBikeIfExist;

    public $Tbikes;
    public $checkedBikes = [];

    public $search = '';
    public $jobs = [];

    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount($product_id)
    {
        $this->product = ProductTemp::where('id', $product_id)->first();
        $this->Tbikes = Bike::all();

        // Parcourez tous les motos pour vérifier s'ils sont déjà sélectionnés
        foreach ($this->Tbikes as $bike) {
            $findBikeIfChecked = CompatibleTempBike::where('bike_id', $bike->id)->first();

            // Si la moto est déjà sélectionné, ajoutez-le au tableau $checkedBikes
            if ($findBikeIfChecked) {
                $this->bike_selected[] = $bike->id;
                $this->checkedBikes[] = $bike->id;
            }
        }
    }

    public function pourcentageDelivery()
    {
        $this->pourcentage_price = $this->delivery;
    }

    public function updatedTitle()
    {
        $this->slug = strtolower(str_replace($this->characters, $this->correct_characters, $this->title));
    }

    protected $rules = [
        'title' => 'required',
        'cover' => 'nullable|image',
        'parent_category' => 'required',
        'type' => 'required',
        'brand' => 'required'
    ];

    protected $messages = [
        'title.required' => "Le nom du produit est obligatoire.",
        'cover.image' => "L'image n'est pas conforme.",
        'parent_category.required' => "La catégorie est obligatoire.",
        'type.required' => "Le type de produit est obligatoire.",
        'brand.required' => "La marque est obligatoire.",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
        $this->pourcentage_price = $this->delivery; // Initie le pourcentage de remise par rapport à la catégorie
        if ($this->customer_price && $this->pourcentage_price) {
            $this->professionnal_price = ($this->customer_price - ($this->customer_price * $this->pourcentage_price / 100));
        }
    }

    public function create(Request $request)
    {
        $this->validate();
        /*
         * Create a new product in good table and use values in temporary tables for the fill.
         */
        $product = new MyProduct;
        $product->title = $this->title;
        $product->slug = ($this->slug == $this->title) ? strtolower(str_replace($this->characters, $this->correct_characters, $this->title)) : strtolower(str_replace($this->characters, $this->correct_characters, $this->slug));
        $product->short_description = $this->short_description;
        $product->long_description = $this->long_description;
        $product->brand_id = $this->brand;
        $product->category_id = $this->parent_category;
        $product->type = $this->type;
        if ($this->cover) {
            $product->cover = strtolower(str_replace($this->characters, $this->correct_characters, $this->title)) . '.' . $this->cover->extension();
        }
        if ($product->save()) {
            // Insert picture in folders
            if ($this->cover) {
                $this->cover->storeAs('public/images/products', strtolower(str_replace($this->characters, $this->correct_characters, $this->title)) . '.' . $this->cover->extension());
            }
            // Add Informations
            $infoTemp = ProductTempInfo::where('product_id', $this->product->id)->get();
            foreach ($infoTemp as $it) {
                $info = new MyProductInfo;
                $info->product_id = $product->id;
                $info->title = $it->title;
                $info->value = $it->value;
                $info->save();
            }

            // Add Pictures
            $pictureTemp = ProductTempPictures::where('product_id', $this->product->id)->get();
            foreach ($pictureTemp as $pt) {
                $picture = new MyProductPicture();
                $picture->product_id = $product->id;
                $picture->picture_url = $pt->picture_url;
                $picture->save();
            }

            // Add Compatible Bike
            $bikes = CompatibleTempBike::all();
            foreach ($bikes as $bike) {
                $newBike = new CompatibleBike();
                $newBike->product_id = $product->id;
                $newBike->bike_id = $bike->bike_id;

                if ($newBike->save()) {
                    CompatibleTempBike::query()->delete();
                };
            }

            // Create a swatch
            if ($this->type == 1) {
                $swatch = new MyProductSwatch;
                $swatch->product_id = $product->id;
                $swatch->type = 1;
                $swatch->ugs = $this->UGS;
                $swatch->customer_price = $this->customer_price;
                $swatch->pourcentage_price = $this->pourcentage_price;
                $swatch->professionnal_price = $this->professionnal_price;
                if ($this->TVA_Custom) {
                    $swatch->default_tva = 0;
                    $swatch->tva_class_id = $this->TVA_Class;
                }
                if ($swatch->save()) {
                    // Fill the stocks
                    $stock = new MyProductStock;
                    $stock->product_id = $product->id;
                    $stock->ugs = $swatch->ugs;
                    $stock->quantity = 0;
                    $stock->save();
                }
            } elseif ($this->type == 2) {
                $swatchTemp = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 2)->get();
                foreach ($swatchTemp as $st) {
                    $swatch = new MyProductSwatch;
                    $swatch->product_id = $product->id;
                    $swatch->type = 2;
                    $swatch->ugs = $st->ugs;
                    $swatch->ugs_swatch = $st->ugs_swatch;
                    $swatch->swatch_group_id = $st->swatch_group_id;
                    $swatch->swatch_tags_id = $st->swatch_tags_id;
                    $swatch->customer_price = $st->customer_price;
                    $swatch->pourcentage_price = $st->pourcentage_price;
                    $swatch->professionnal_price = $st->professionnal_price;
                    if ($st->default_tva == 0) {
                        $swatch->default_tva = 0;
                        $swatch->tva_class_id = $st->tva_class_id;
                    }
                    if ($swatch->save()) {
                        // Fill the stocks
                        $stock = new MyProductStock;
                        $stock->product_id = $product->id;
                        $stock->is_swatch = 1;
                        $stock->ugs = $swatch->ugs . '-' . $swatch->ugs_swatch;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                }
            } elseif ($this->type == 3) {
                $kitTemp = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 3)->get();
                foreach ($kitTemp as $st) {
                    $swatch = new MyProductSwatch;
                    $swatch->product_id = $product->id;
                    $swatch->type = 3;
                    $swatch->ugs = $st->ugs;
                    $swatch->ugs_swatch = $st->ugs_swatch;
                    $swatch->chain = $st->chain;
                    $swatch->pas = $st->pas;
                    $swatch->width = $st->width;
                    $swatch->crown = $st->crown;
                    $swatch->pignon = $st->pignon;
                    $swatch->customer_price = $st->customer_price;
                    $swatch->pourcentage_price = $st->pourcentage_price;
                    $swatch->professionnal_price = $st->professionnal_price;
                    if ($st->default_tva == 0) {
                        $swatch->default_tva = 0;
                        $swatch->tva_class_id = $st->tva_class_id;
                    }
                    if ($swatch->save()) {
                        // Fill the stocks
                        $stock = new MyProductStock;
                        $stock->product_id = $product->id;
                        $stock->is_swatch = 1;
                        $stock->ugs = $swatch->ugs . '-' . $swatch->ugs_swatch;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                }
            } elseif ($this->type == 4) {
                $tireTemp = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 3)->get();
                foreach ($tireTemp as $st) {
                    $swatch = new MyProductSwatch;
                    $swatch->product_id = $product->id;
                    $swatch->type = 4;
                    $swatch->ugs = $st->ugs;
                    $swatch->ugs_swatch = $st->ugs_swatch;
                    $swatch->tire_width = $st->tire_width;
                    $swatch->tire_height = $st->tire_height;
                    $swatch->tire_diameter = $st->tire_diameter;
                    $swatch->tire_charge = $st->tire_charge;
                    $swatch->customer_price = $st->customer_price;
                    $swatch->pourcentage_price = $st->pourcentage_price;
                    $swatch->professionnal_price = $st->professionnal_price;
                    if ($st->default_tva == 0) {
                        $swatch->default_tva = 0;
                        $swatch->tva_class_id = $st->tva_class_id;
                    }
                    if ($swatch->save()) {
                        // Fill the stocks
                        $stock = new MyProductStock;
                        $stock->product_id = $product->id;
                        $stock->is_swatch = 1;
                        $stock->ugs = $swatch->ugs . '-' . $swatch->ugs_swatch;
                        $stock->quantity = 0;
                        $stock->save();
                    }
                }
            }

            return redirect()->route('back.product.list');
        }
    }

    public function createSwatch()
    {
        /*
         * Create a temporary swatches by type
         */
        if ($this->type == 1) {
            $simple = new ProductTempSwatches;
            $simple->product_id = $this->product->id;
            $simple->ugs = $this->UGS;
            $simple->customer_price = $this->customer_price;
            $simple->pourcentage_price = $this->pourcentage_price;
            $simple->professionnal_price = $this->professionnal_price;
            if ($this->TVA_Custom) {
                $simple->default_tva = 0;
                $simple->tva_class_id = $this->TVA_Class;
            }
            $simple->save();
        } elseif ($this->type == 2) {
            $swatch = new ProductTempSwatches;
            $swatch->product_id = $this->product->id;
            $swatch->type = 2;
            $swatch->ugs = $this->UGS;
            $swatch->ugs_swatch = $this->UGS_swatch;
            $swatch->swatch_group_id = $this->swatch_group;
            $swatch->swatch_tags_id = $this->swatch_value;
            $swatch->customer_price = $this->customer_price;
            $swatch->pourcentage_price = $this->pourcentage_price;
            $swatch->professionnal_price = $this->professionnal_price;
            if ($this->TVA_Custom) {
                $swatch->default_tva = 0;
                $swatch->tva_class_id = $this->TVA_Class;
            }
            $swatch->save();
        } elseif ($this->type == 3) {
            $kit = new ProductTempSwatches;
            $kit->product_id = $this->product->id;
            $kit->type = 3;
            $kit->ugs = $this->UGS;
            $kit->ugs_swatch = $this->UGS_swatch;
            $kit->pas = $this->pas;
            $kit->chain = $this->chain;
            $kit->pignon = $this->pignon;
            $kit->width = $this->width;
            $kit->crown = $this->crown;
            $kit->customer_price = $this->customer_price;
            $kit->pourcentage_price = $this->pourcentage_price;
            $kit->professionnal_price = $this->professionnal_price;
            if ($this->TVA_Custom) {
                $kit->default_tva = 0;
                $kit->tva_class_id = $this->TVA_Class;
            }
            $kit->save();
        } elseif ($this->type == 4) {
            $tire = new ProductTempSwatches;
            $tire->product_id = $this->product->id;
            $tire->type = 4;
            $tire->ugs = $this->UGS;
            $tire->ugs_swatch = $this->UGS_swatch;
            $tire->tire_width = $this->tire_width;
            $tire->tire_height = $this->tire_height;
            $tire->tire_diameter = $this->tire_diameter;
            $tire->tire_charge = $this->tire_charge;
            $tire->customer_price = $this->customer_price;
            $tire->pourcentage_price = $this->pourcentage_price;
            $tire->professionnal_price = $this->professionnal_price;
            if ($this->TVA_Custom) {
                $tire->default_tva = 0;
                $tire->tva_class_id = $this->TVA_Class;
            }
            $tire->save();
        }

        $this->emit('refreshLines');
    }

    public function addPictures()
    {
        $random_string = Str::random(8);
        $string = $random_string;
        $picture = new ProductTempPictures;
        $picture->product_id = $this->product->id;
        $picture->picture_url = strtolower($string) . '.' . $this->picture->extension();
        if ($picture->save()) {
            $this->picture->storeAs('public/images/products_attachment', strtolower($string) . '.' . $this->picture->extension());
        }
        $this->emit('refreshLines');
    }

    public function addInformations()
    {
        $info = new ProductTempInfo;
        $info->product_id = $this->product->id;
        $info->title = strtoupper($this->info_group);
        $info->value = strtoupper($this->info_value);
        $info->save();
        $this->emit('refreshLines');
    }

    public function deleteKit($id)
    {
        $kit = ProductTempSwatches::where('id', $id)->first();
        $kit->delete();
        $this->emit('refreshLines');
    }
    public function deleteTire($id)
    {
        $kit = ProductTempSwatches::where('id', $id)->first();
        $kit->delete();
        $this->emit('refreshLines');
    }
    public function deleteSwatch($id)
    {
        $kit = ProductTempSwatches::where('id', $id)->first();
        $kit->delete();
        $this->emit('refreshLines');
    }
    public function deleteInfo($id)
    {
        $kit = ProductTempInfo::where('id', $id)->first();
        $kit->delete();
        $this->emit('refreshLines');
    }
    public function deletePicture($id)
    {
        $kit = ProductTempPictures::where('id', $id)->first();
        $kit->delete();
        $this->emit('refreshLines');
    }

    public function changeDelivery()
    {
        $this->delivery = ProductCategory::find($this->parent_category)->delivery;
        $this->emit('refreshLines');
    }

    public function updatedSearch()
    {
        $query = '%' . $this->search . '%';
        if (strlen($this->search) > 1) {
            return bike::where('marque', 'like', $query)
                ->orWhere('cylindree', 'like', $query)
                ->orWhere('modele', 'like', $query)
                ->orWhere('annee', 'like', $query);
        }
    }

    public function add()
    {
        // Récupérer la liste des motos sélectionnées dans un tableau
        $selectedBikes = collect($this->bike_selected)->map(function ($bikeId) {
            return Bike::find($bikeId);
        });
        // Parcourir les motos sélectionnées et les enregistrer si elles n'existent pas
        foreach ($selectedBikes as $bike) {
            $this->findBikeIfExist = CompatibleTempBike::where('bike_id', $bike->id)->first();
            // Si la moto n'existe pas, enregistrez-la en base
            if (!$this->findBikeIfExist) {
                $compatibleBike = new CompatibleTempBike;
                $compatibleBike->bike_id = $bike->id;
                $compatibleBike->save();
                session()->flash('success', 'Sauvegardé');
            }
        }
    }


    public function render()
    {
        $data = [];

        $data = [];
        if ($this->updatedSearch() != null) {
            $data['bikes'] = $this->updatedSearch()->paginate(20);
        } else {
            $data['bikes'] = bike::orderBy('marque', 'asc')->paginate(20);
        }
        $data['categories'] = ProductCategory::all();
        $data['brands'] = ProductBrand::all();
        $data['TVAs'] = ProductTaxes::all();
        $data['pictures'] = ProductTempPictures::where('product_id', $this->product->id)->get();
        $data['kitTemp'] = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 3)->get();
        $data['tireTemp'] = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 4)->get();
        $data['swatchGroup'] = ProductGroupTag::all();
        $data['swatchValue'] = ProductTag::all();
        $data['swatchTemp'] = ProductTempSwatches::where('product_id', $this->product->id)->where('type', 2)->get();
        $data['infoTemp'] = ProductTempInfo::where('product_id', $this->product->id)->get();
        $data['pictureTemp'] = ProductTempPictures::where('product_id', $this->product->id)->get();
        $data['bikeTemp'] = CompatibleTempBike::all();
        return view('livewire.pages.back.products.product-add', $data);
    }
}

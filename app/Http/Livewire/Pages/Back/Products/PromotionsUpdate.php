<?php

namespace App\Http\Livewire\Pages\Back\Products;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\MyProduct;
use App\Models\MyProductPromotion;
use App\Models\MyProductPromotionItems;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PromotionsUpdate extends Component
{
    public $percentage, $name_promo, $dateDebut, $dateFin, $codePromo, $codePromoGen, $init, $mode, $product_selected, $products;
    public $alex = [];
    protected $listeners = ['productsSelected' => 'addSelectedProducts'];
    public $active = false;

    public function mount($id)
    {
        $this->init = MyProductPromotion::where('id', $id)->first();

        $this->name_promo = $this->init->title;
        $this->percentage = $this->init->discount;
        $this->active = $this->init->active;
        if ($this->init->code && str_starts_with($this->init->code, 'PROMO')) {
            $this->codePromo = $this->init->code;
            $this->mode = 2;
        } else {
            $this->codePromoGen = $this->init->code;
            $this->mode = 2;
        }

        if ($this->init->start_date) {
            $this->dateDebut = $this->init->start_date;
            $this->dateFin = $this->init->end_date;
            $this->mode = 1;
        }
        $this->percentage = $this->init->discount;
    }

    public function addSelectedProducts($selectedProductIds) {
        $ids = array_map('intval', $selectedProductIds);
        $selectedProducts = MyProduct::whereIn('id', $ids)->get();
        $this->products = $selectedProducts->toArray();
    }

    public function deleteProduct($productId) {
        $this->products = array_filter($this->products, function ($product) use ($productId) {
            return $product['id'] !== $productId;
        });
    }

    public function activePromo()
    {
        if($this->active === 1) {
            $this->active = "0";
        } elseif($this->active === 0) {
            $this->active = "1";
        }
    }

    public function formatDate($date)
    {
        return date("d/m/Y", strtotime($date));
    }

    public function generatePromoCode()
    {
        if (!$this->codePromo) {
            $this->codePromoGen = 'PROMO' . strtoupper(Str::random(3));
        }
    }

    protected function messages()
    {
        return [
            'name_promo.required' => 'Le nom de la promotion est obligatoire.',
            'name_promo.string' => 'Le nom de la promotion doit être une chaîne de caractères.',
            'name_promo.max' => 'Le nom de la promotion ne doit pas dépasser 95 caractères.',
            'name_promo.min' => 'Le nom de la promotion doit avoir au moins 6 caractères.',

            'mode.required' => 'Le choix du mode est obligatoire.',
            'mode.in' => 'Le mode sélectionné n’est pas valide.',

            'dateDebut.required_if' => 'La date de début est requise quand le mode est défini à 1.',
            'dateDebut.date' => 'La date de début doit être une date valide.',

            'dateFin.required_if' => 'La date de fin est requise quand le mode est défini à 1.',
            'dateFin.date' => 'La date de fin doit être une date valide.',
            'dateFin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',

            // 'codePromo.required_if' => 'Le code promo est requis quand le mode est défini à 2.',
            'codePromo.string' => 'Le code promo doit être une chaîne de caractères.',
            'codePromo.max' => 'Le code promo ne doit pas dépasser 95 caractères.',

            // 'codePromoGen.required_if' => 'Le code promo est requis quand le mode est défini à 2.',

            'percentage.required' => 'Le pourcentage est obligatoire.',
            'percentage.numeric' => 'Le pourcentage doit être un nombre.',
            'percentage.min' => 'Le pourcentage doit être au moins 0.',
            'percentage.max' => 'Le pourcentage ne doit pas dépasser 95.',
        ];
    }

    public function delete()
    {
        $itemsPromo = MyProductPromotionItems::where('group_id', $this->init->id)->get();
        foreach ($itemsPromo as $items) {
            $items->delete();
        }
        $this->init->delete();

        return redirect(route('back.product.promotions'));
    }

    public function create()
    {
        if ($this->mode == 1) {
            $validationRules = [
                'name_promo' => 'required|string|max:95|min:6',
                'mode' => 'required|in:0,1,2',
                'dateDebut' => 'required|date',
                'dateFin' => 'required|date|after_or_equal:dateDebut',
                'percentage' => 'required|numeric|min:0|max:95',
            ];
        } else if ($this->mode == 2) {
            $validationRules = [
                'name_promo' => 'required|string|max:95|min:6',
                'mode' => 'required|in:0,1,2',
                // 'codePromo' => 'required|string|max:95',
                'percentage' => 'required|numeric|min:0|max:95',
            ];
        } else {
            $validationRules = [];
        }

        $this->validate($validationRules);

        $productPromotion = new MyProductPromotion();

        foreach ($this->products as $value) {
            $createPromotion = MyProduct::find($value['id']);
            if ($createPromotion) {
                if ($this->mode == 1) {
                    $productPromotion->active = $this->active;
                    $productPromotion->title = $this->name_promo;
                    $productPromotion->discount = $this->percentage;
                    $productPromotion->start_date = $this->dateDebut;
                    $productPromotion->end_date = $this->dateFin;
                } else if ($this->mode == 2) {
                    $productPromotion->active = $this->active;
                    $productPromotion->title = $this->name_promo;
                    $productPromotion->discount = $this->percentage;
                    $productPromotion->code = $this->codePromoGen ? $this->codePromoGen : $this->codePromo;
                }


                if ($productPromotion->save()) {
                    $promoItem = new MyProductPromotionItems();
                    $promoItem->group_id = $productPromotion->id;
                    $promoItem->product_id = $createPromotion->id;
                    $promoItem->save();
                }
            }
        }
        return redirect()->route('back.product.promotions');
    }

    public function render()
    {
        $data = [];
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.back.products.promotions-update', $data);
    }
}

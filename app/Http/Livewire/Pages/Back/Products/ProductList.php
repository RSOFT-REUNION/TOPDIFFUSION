<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\CompatibleBike;
use App\Models\MyProductInfo;
use App\Models\MyProductPicture;
use App\Models\Product;
use App\Models\UserCart;
use App\Models\UserOrderItem;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\MyProduct;
use App\Models\MyProductPromotion;

class ProductList extends Component
{

    public $search = '';

    public $perPage = 30;

    public $clear;

    public $filters_count = 0;

    public $jobs = [];

    public $is_search = false;

    public function updatedSearch()
    {
        $query = '%' . $this->search . '%';

        if (auth()->user()->admin == 1) {
            if (strlen($this->search) > 2) {
                $this->jobs = MyProduct::where('title', 'like', $query)
                    ->orWhere('pourcentage_price', 'like', $query)
                    ->get();
                $this->is_search = true;
            } else if ($this->is_search) {
                $this->is_search = false;
                $this->jobs = [];
                MyProduct::all();
            }
        } else {
            if (strlen($this->search) > 2) {
                $this->jobs = MyProduct::where('title', 'like', $query)
                    ->get();
                $this->is_search = true;
            } else if ($this->is_search) {
                $this->is_search = false;
                $this->jobs = [];
                MyProduct::all();
            }
        }
    }

    public function clear()
    {
        $this->search = '';
        $this->is_search = false;
        $this->jobs = [];
    }

    public function render()
    {
        $data = [];
        // Requête pour récupérer les données de my_product avec jointure sur my_product_swatch
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get();

        if ($this->jobs) {
            $products = $this->jobs;
        } else {
            if (auth()->user()->team == 1) {
                $products = MyProduct::query()->orderBy('title')->orderBy('slug')->orderBy('cover');
            } else {
                $products = MyProduct::query()->orderBy('title');
            }
        }

        if ($this->jobs) {
            $data['products'] = $products;
        } else {
            $data['products'] = $products->paginate($this->perPage);
        }
        return view('livewire.pages.back.products.product-list', $data);
    }
}

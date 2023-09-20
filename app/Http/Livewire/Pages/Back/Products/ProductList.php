<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\Product;
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
        $data['products'] = MyProduct::select('my_products.*', 'my_product_swatches.*')
            ->leftJoin('my_product_swatches', 'my_products.id', '=', 'my_product_swatches.product_id')
            ->orderBy('my_products.created_at', 'desc')
            ->get();

        $productData = [];

        foreach ($data['products'] as $product) {
            $productData[] = [
                'productName' => $product->title,
                'productSlug' => $product->slug,
                'productProfessionnalPrice' => $product->professionnal_price,
                'productCustomerPrice' => $product->customer_price,
                'productPourcentagePrice' => $product->pourcentage_price,
            ];
        }

        $data['productData'] = $productData;

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

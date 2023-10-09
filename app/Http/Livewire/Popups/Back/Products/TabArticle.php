<?php

namespace App\Http\Livewire\Popups\Back\Products;

use App\Models\MyProduct;
use LivewireUI\Modal\ModalComponent;

class TabArticle extends ModalComponent
{
    public $all_products;
    public $search = '';
    public $perPage = 30;
    public $clear;
    public $filters_count = 0;
    public $jobs = [];
    public $is_search = false;

    public $currentPage = 1;

    public $selectedProducts = [];

    public function mount()
    {
        $this->all_products = MyProduct::all();
        $this->selectedProducts = session('selectedProducts', []);

        // Pour vider la session lorsque la page se recharge
        if (session()->has('selectedProducts')) {
            session()->forget('selectedProducts');
        }
    }

    public function btn()
    {
        session(['selectedProducts' => $this->selectedProducts]);
        $this->emit('productsSelected', $this->selectedProducts);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function updatedSearch()
    {
        $query = '%' . $this->search . '%';

        if (auth()->user()->team == 1) {
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

    public function setPage($page)
    {
        $this->currentPage = $page;
    }

    public function render()
    {
        $data = [];

        // Construisez la requête en fonction des critères de tri nécessaires
        if ($this->jobs) {
            $data['products'] = $this->jobs;
        } else {
            if (auth()->user()->team == 1) {
                $productsQuery = MyProduct::query()
                    ->orderBy('title')
                    ->orderBy('slug')
                    ->orderBy('cover');
            } else {
                $productsQuery = MyProduct::query()
                    ->orderBy('title');

            }

            // Ajoutez une clause whereDoesntHave pour exclure les produits liés à un groupe de promotions
            $productsQuery->whereDoesntHave('promotions');

            $data['products'] = $productsQuery->paginate(8, ['*'], 'page', $this->currentPage);
        }

        return view('livewire.popups.back.products.tab-article', $data);
    }


}




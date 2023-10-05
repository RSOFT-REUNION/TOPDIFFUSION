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
    }

    public function btn()
    {
        $this->emit('productsSelected', $this->selectedProducts);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

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

    public function setPage($page)
    {
        $this->currentPage = $page;
    }

    public function render()
    {
        $data = [];
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
            $data['products'] = MyProduct::paginate(8, ['*'], 'page', $this->currentPage);
        }
        return view('livewire.popups.back.products.tab-article', $data);
    }
}

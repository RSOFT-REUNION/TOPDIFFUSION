<?php

namespace App\Livewire\Backend\Popups\Product\AddProduct;

use App\Models\ProductBrand;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class AddBrand extends ModalComponent
{
    use WithPagination;

    public $brand_select;

    public $search;
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        $brandSearch = [];
        if(strlen($this->search) > 1) {
            return ProductBrand::where('name', 'like', $query)
                ->orderBy('name')
                ->take(5)
                ->get();
        }
    }

    public function selectBrand()
    {
        $brandId = ProductBrand::where('slug', $this->brand_select)->first()->id;
        $this->dispatch('brandSelected', $brandId);
        $this->closeModal();
    }

    public function getBrands()
    {
        if(strlen($this->search) > 1) {
            return $this->updatedSearch();
        } else {
            return ProductBrand::orderBy('name')->paginate(20);
        }
    }

    public function render()
    {
        $data = [];
        $data['brands'] = $this->getBrands();
        return view('livewire.backend.popups.product.add-product.add-brand', $data);
    }
}

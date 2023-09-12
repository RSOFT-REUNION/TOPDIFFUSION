<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use App\Models\ProductBrand;
use Livewire\Component;

class Brands extends Component
{

    public function deleteBrand($id)
    {
        $brand = ProductBrand::find($id);

        if ($brand) {
            MyProduct::where('brand_id', $brand->id)->update(['brand_id' => 2]);

            $brand->delete();
        }

        return redirect()->route('back.product.brands');
    }


    public function render()
    {
        $data = [];
        $data['brands'] = ProductBrand::orderBy('title', 'asc')->get();
        return view('livewire.pages.back.products.brands', $data);
    }
}

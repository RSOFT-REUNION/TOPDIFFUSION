<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\Bikes;
use Livewire\Component;
use Livewire\WithPagination;

class ProductBikes extends Component
{
    use WithPagination;

    public function deleteBike($id)
    {
        $bike = Bikes::find($id);
        $bike->delete();
    }

    public function render()
    {
        $data = [];
        $data['bikes'] = Bikes::orderBy('brand', 'asc')->orderBy('model', 'asc')->orderBy('cylinder', 'asc')->orderBy('year', 'asc')->paginate(30);
        return view('livewire.backend.pages.products.product-bikes', $data);
    }
}

<?php

namespace App\Livewire\Backend\Components\Templates;

use App\Models\Attribute;
use App\Models\Bikes;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductStock;
use App\Models\User;
use App\Models\UserGroup;
use Livewire\Component;

class Sidebar extends Component
{
    public $group_page;
    public $page;

    public function mount($group_page, $page)
    {
        $this->group_page = $group_page;
        $this->page = $page;
    }

    public function render()
    {
        $data = [];
        $data['customers'] = User::where('admin', 0)->get()->count();
        $data['groups'] = UserGroup::all()->count();
        $data['product_categories'] = ProductCategory::all()->count();
        $data['product_brands'] = ProductBrand::all()->count();
        $data['products'] = Product::all()->count();
        $data['bikes'] = Bikes::all()->count();
        $data['attributes'] = Attribute::all()->count();
        $data['stocks'] = ProductStock::all()->sum('quantity');
        return view('livewire.backend.components.templates.sidebar', $data);
    }
}

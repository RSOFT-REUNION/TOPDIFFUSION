<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\ProductCategory;
use App\Models\SettingGeneral;
use App\Models\UserSetting;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public function changeShow()
    {
        $setting = UserSetting::where('user_id', auth()->user()->id)->first();
        switch ($setting->product_categories_show)
        {
            case 1:
                $setting->product_categories_show = 2;
                $setting->update();
                break;
            case 2:
                $setting->product_categories_show = 1;
                $setting->update();
                break;
        }

        return redirect()->route('back.product.categories');
    }

    public function render()
    {
        $data = [];
        $data['categories'] = ProductCategory::all();
        $data['categories_table'] = ProductCategory::paginate(25);
        $data['categories_1'] = ProductCategory::where('level', 1)->get();
        $data['categories_2'] = ProductCategory::where('level', 2)->get();
        $data['categories_3'] = ProductCategory::where('level', 3)->get();
        $data['userSetting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        return view('livewire.pages.back.products.categories', $data);
    }
}

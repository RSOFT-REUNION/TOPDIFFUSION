<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MyProduct;
use App\Models\MyProductPicture;
use App\Models\Product;
use App\Models\SettingGeneral;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct($slug)
    {
        $myProduct = MyProduct::where('slug', $slug)->first();

        $data = [];
        $data['product'] = $myProduct;
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.products.products-page', $data);
    }

    public function showProductList($slug)
    {
        $data = [];
        $data['slug'] = $slug;
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.products.products-list', $data);
    }
}

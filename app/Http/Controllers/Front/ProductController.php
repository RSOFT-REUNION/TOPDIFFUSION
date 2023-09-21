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
        $data['page'] = 'produit';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.products.products-page', $data);
    }

    public function showProductList($slug)
    {
        $data = [];
        $data['slug'] = $slug;
        $data['page'] = 'produit liste';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.products.products-list', $data);
    }

    public function showProductListAll()
    {
        $data = [];
        // $data['slug'] = $slug;
        $data['page'] = 'tout les produit';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.products.product-list-all', $data);
    }
}

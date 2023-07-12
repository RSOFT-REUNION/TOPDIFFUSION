<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MyProduct;
use App\Models\MyProductPicture;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct($slug)
    {
        $myProduct = MyProduct::where('slug', $slug)->first();

        $data = [];
        $data['product'] = $myProduct;
        return view('pages.frontend.products.products-page', $data);
    }

    public function showProductList($slug)
    {
        $data = [];
        $data['slug'] = $slug;
        return view('pages.frontend.products.products-list', $data);
    }
}

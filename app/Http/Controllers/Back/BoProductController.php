<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGroupTag;
use App\Models\ProductTemp;
use App\Models\ProductTempSwatches;
use Illuminate\Http\Request;

class BoProductController extends Controller
{
    public function showProductList()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'list';
        return view('pages.backend.products.product-list', $data);
    }

    public function createProduct()
    {
        $proTemp = new ProductTemp;
        if($proTemp->save()) {
            $proSwatch = new ProductTempSwatches;
            $proSwatch->product_id = $proTemp->id;
            if($proSwatch->save()){
                return redirect()->route('back.product.show.create', ['id' => $proTemp->id]);
            }
        }
    }

    public function showCreateProduct($id)
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'list';
        $data['product'] = ProductTemp::where('id', $id)->first();
        return view('pages.backend.products.product-add', $data);
    }

    public function showAddProduct($id, $product)
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'list';
        $data['myProduct'] = Product::where('id', $id)->first();
        return view('pages.backend.products.product-add', $data);
    }

    public function showProductCategories()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'categories';
        return view('pages.backend.products.product-categories', $data);
    }

    public function showProductBikes()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'bikes';
        return view('pages.backend.products.product-bikes', $data);
    }

    public function showProductBrands()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'brands';
        return view('pages.backend.products.product-brands', $data);
    }

    public function showProductOptions()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'options';
        return view('pages.backend.products.product-options', $data);
    }

    public function showProductViewGroupTag($id)
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'options';
        $data['grTag'] = ProductGroupTag::where('id', $id)->first();
        return view('pages.backend.products.product-options-tag', $data);
    }

    public function showProductStocks()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'stocks';
        return view('pages.backend.products.product-stocks', $data);
    }

}

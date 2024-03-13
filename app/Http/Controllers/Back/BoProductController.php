<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\CompatibleTempBike;
use App\Models\MyProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGroupTag;
use App\Models\ProductTemp;
use App\Models\ProductTempInfo;
use App\Models\ProductTempPictures;
use App\Models\ProductTempSwatches;
use Illuminate\Http\Request;

class BoProductController extends Controller
{
    public function showProductList()
    {
        // Suppression des tables temporaire
        $temp_products = ProductTemp::all();
        $temp_swatches = ProductTempSwatches::all();
        $temp_infos = ProductTempInfo::all();
        $temp_pictures = ProductTempPictures::all();
        $temp_bikes = CompatibleTempBike::all();

        // Vérification de la quantité
        if($temp_swatches->count() > 0) {
            foreach ($temp_swatches as $temp){
                $temp->delete();
            }
        }
        if($temp_infos->count() > 0) {
            foreach ($temp_infos as $temp){
                $temp->delete();
            }
        }
        if($temp_pictures->count() > 0) {
            foreach ($temp_pictures as $temp){
                $temp->delete();
            }
        }
        if($temp_products->count() > 0) {
            foreach ($temp_products as $temp){
                $temp->delete();
            }
        }
        if($temp_bikes->count() > 0) {
            foreach ($temp_bikes as $temp){
                $temp->delete();
            }
        }

        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'list';
        return view('pages.backend.products.product-list', $data);
    }

    public function createProduct()
    {
        $proTemp = new ProductTemp;
        if ($proTemp->save()) {
            return redirect()->route('back.product.show.create', ['id' => $proTemp->id]);
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
        $data['myProduct'] = MyProduct::where('id', $id)->first();
        return view('pages.backend.products.product-add', $data);
    }

    public function showSingleProduct($product)
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'list';
        $data['product'] = MyProduct::where('id', $product)->first();
        return view('pages.backend.products.product-single', $data);
    }

    public function showProductCategories()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'categories';
        return view('pages.backend.products.product-categories', $data);
    }

    public function showSingleProductCategories($id)
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'categories';
        $data['singleCat'] = ProductCategory::where('id', $id)->first();
        return view('pages.backend.products.product-single-categories', $data);
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

    public function showPromotions()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'promotions';
        return view('pages.backend.products.promotions-list', $data);
    }

    public function showCreatePromotions()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'promotions';
        return view('pages.backend.products.promotions-create', $data);
    }

    public function showGroupPromotions()
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'promotions';
        return view('pages.backend.products.promotion-group-single', $data);
    }

    public function showGroupPromotionsUpdate($id)
    {
        $data = [];
        $data['group'] = 'products';
        $data['page'] = 'promotions';
        $data['id'] = $id;
        return view('pages.backend.products.promotions-update', $data);
    }
}

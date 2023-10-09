<?php

namespace App\Http\Middleware;

use App\Models\MyProduct;
use App\Models\ProductCategory;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BreadcrumbMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $crumbs = [
            ['url' => route('front.home'), 'label' => 'Accueil']
        ];

        if ($request->routeIs('front.product.list')) {
            $category_slug = $request->route('slug');
            $category = ProductCategory::where('slug', $category_slug)->first();
            if ($category) {
                $crumbs[] = ['url' => route('front.product.list', $category_slug), 'label' => $category->title];
            }
        }

        if ($request->routeIs('front.product')) {
            $productId = $request->route('slug');
            $product = MyProduct::where('slug', $productId)->first();
            $category = ProductCategory::where('id', $product->category_id)->first();
            if($category) {
                $crumbs[] = ['url' => route('front.product.list', $category->slug), 'label' => $category->title];
            }
            if ($product) {
                $crumbs[] = ['url' => route('front.product', $productId), 'label' => $product->title];
            }
        }

        if ($request->routeIs('front.product-all')) {
            $crumbs[] = ['url' => route('front.product-all'), 'label' => 'Voir tout'];
        }

        view()->share('crumbs', $crumbs);

      return $next($request);
    }
}

<div id="product_live">
    @if($product->type == 1)
        <div class="flex items-center">
            <div class="flex-1">
                <div class="cover">
                    <img src="{{ asset('storage/images/products/'. $product->cover) }}"/>
                </div>
            </div>
            <div class="flex-1">
                <div class="inline-flex items-center">
                    <p class="tag-marque">{{ $product->getBrand()->title }}</p>
                </div>
                <h2>{{ $product->title }}</h2>
                <h4>Référence: HSYEJZO</h4>
                <p class="resume mt-2">{{ $product->short_description }}</p>
            </div>
        </div>
    @else

    @endif

</div>

<div>
    <div class="textfield-search @if($search) textfield-search-focus @endif">
        <input type="text" wire:model="search" placeholder="Rechercher un produit, une référence..." class="focus:outline-none">
        <button type="submit">Rechercher</button>
    </div>
    @if($search)
        <div class="search-box">
            @if($items_result != null)
                @if($items_result->count() > 0)
                    <ul>
                        @foreach($items_result as $item)
                            <li>
                                <div role="button" class="search-product-container mt-2" data-href="{{ route('front.product', ['slug' => $item->slug]) }}">
                                    <div class="flex items-center">
                                        <div class="flex-none">
                                            <img src="{{ asset('storage/images/products/'. $item->cover) }}" width="100px">
                                        </div>
                                        <div class="flex-1 text-left">
                                            <div class="">
                                                <span class="marque-tag">{{ $item->getBrand()->title }}</span>
                                            </div>
                                            <p>{{ $item->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @else
                Aucun résultat trouvé
            @endif
        </div>
    @endif
</div>

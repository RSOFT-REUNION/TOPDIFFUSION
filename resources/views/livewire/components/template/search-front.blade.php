<div x-data="{ open: @entangle('search') }" x-on:click.away="open = ''">
    <div class="textfield-search" :class="{ 'textfield-search-focus': open }">
        <input type="text" wire:model="search" placeholder="Rechercher un produit, une référence..." class="focus:outline-none">
        <button type="submit">Rechercher</button>
    </div>
    @if($items_result != null)
        @if($items_result->count() > 0)
            <div class="search-box">
                <ul>
                    @foreach($items_result as $item)
                        <li>
                            <div role="button" class="search-product-container" data-href="{{ route('front.product', ['slug' => $item->slug]) }}">
                                <div class="flex items-center">
                                    <div class="flex-none">
                                        <img src="{{ asset('storage/images/products/'. $item->cover) }}" width="100px" class="h-20 rounded m-2">
                                    </div>
                                    <div class="flex-1 text-left ml-4">
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
            </div>
        @else
            <div class="search-box" >
                Aucun résultat trouvé
            </div>
        @endif
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('click', function(event) {
            let searchBar = document.querySelector('.textfield-search');
            if (!searchBar.contains(event.target)) {
                @this.set('search', '');
            }
        });
    </script>
@endpush

{{-- Ajout d'un produit simple --}}
<div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
    <div class="flex-1">
        <h2 class="font-bold">Configurer le produit</h2>
        <p class="text-sm text-gray-500">Vous êtes sur le point de configurer votre produit</p>
    </div>
    <div class="flex-none">
        @if($temp_swatch->count() > 0)
            <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-simple', {{ json_encode(['product_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Modifier</button>
        @else
            <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-simple', {{ json_encode(['product_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Configurer</button>
        @endif
    </div>
</div>

{{-- Affichage du produit configuré --}}
@if($temp_swatch->count() > 0)
    @foreach($temp_swatch as $swatch)
        @if($swatch->type == 1)
            <div class="mt-5 bg-gray-100 rounded-md p-5">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg">Code UGS</h3>
                        <p class="text-2xl font-bold">{{ $swatch->ugs }}</p>
                    </div>
                    <div class="flex-none">
                        <div class="bg-primary text-white w-[300px] grid grid-cols-2 rounded-sm">
                            <div class="py-2 px-3 border-r border-white border-opacity-10">
                                <h3>Prix HT.</h3>
                                <p class="text-xl font-bold">{{ $swatch->getPriceHT() }} €</p>
                            </div>
                            <div class="py-2 px-3">
                                <h3>Prix TTC.</h3>
                                <p class="text-xl font-bold">{{ $swatch->getPriceTTC() }} €</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif

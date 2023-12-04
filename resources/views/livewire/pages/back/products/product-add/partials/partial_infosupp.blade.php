<div>
    {{-- Ajout d'une informations --}}
    <div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
        <div class="flex-1">
            <h2 class="font-bold">Ajouter une nouvelle information</h2>
            <p class="text-sm text-gray-500">Cela peut être utile afin d'ajouter des informations essentielles au produit</p>
        </div>
        <div class="flex-none">
            <button wire:click="$emit('openModal', 'popups.back.products.product-add.info-supp', {{ json_encode(['product_temp_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter une ligne</button>
            <button type="button" class="bg-gray-200 py-2 px-2.5 rounded-md" title="Obtenir de l'aide"><i class="fa-regular fa-circle-question"></i></button>
        </div>
    </div>

    {{-- Tableau des informations --}}
    @if($informations->count() > 0)
        <div class="grid grid-cols-5 gap-4 mt-5">
            @foreach($informations as $info)
                <div class="bg-gray-100 text-center py-3 rounded-md group/info relative overflow-hidden hover:shadow-xl duration-300">
                    <p class="font-bold">{{ $info->title }}</p>
                    <p class="text-gray-500">{{ $info->value }}</p>
                    <a wire:click.prevent="deleteInfos({{ $info->id }})" class="group-hover/info:visible invisible absolute bottom-0 left-0 right-0 bg-red-300 py-1.5 text-sm cursor-pointer"><i class="fa-solid fa-trash mr-2"></i>Supprimer</a>
                </div>
            @endforeach
        </div>
    @endif
</div>

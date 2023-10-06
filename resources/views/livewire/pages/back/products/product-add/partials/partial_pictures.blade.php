<div>
    {{-- Ajout d'une informations --}}
    <div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
        <div class="flex-1">
            <h2 class="font-bold">Ajouter une nouvelle photo</h2>
            <p class="text-sm text-gray-500">Permet de présenter sous plusieurs angles vos produits</p>
        </div>
        <div class="flex-none">
            <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-pictures', {{ json_encode(['product_temp_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter une photo</button>
        </div>
    </div>

    {{-- Tableau des informations --}}
    @if($temp_pictures->count() > 0)
        <div class="grid grid-cols-5 gap-4 mt-5">
            @foreach($temp_pictures as $picture)
                <div class="border border-gray-100 text-center rounded-md group/info relative overflow-hidden hover:shadow-xl duration-300">
                    <img src="{{ asset('storage/images/products_attachment/'. $picture->picture_url) }}" class="bg-cover">
                    <a wire:click.prevent="deletePicture({{ $picture->id }})" class="group-hover/info:visible invisible absolute bottom-0 left-0 right-0 bg-red-300 py-1.5 text-sm cursor-pointer"><i class="fa-solid fa-trash mr-2"></i>Supprimer</a>
                </div>
            @endforeach
        </div>
    @endif
</div>

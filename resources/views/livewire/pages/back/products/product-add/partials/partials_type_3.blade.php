<p class="bg-red-500 text-white py-2 px-5 rounded-md font-bold mb-2">Cette notion est a revoir avec le client</p>

{{-- Ajout d'une variation --}}
<div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
    <div class="flex-1">
        <h2 class="font-bold">Ajouter un kit</h2>
        <p class="text-sm text-gray-500">L'ajout des kits permets se compose de 3 sections, le pignon, la chaine et la couronne. Vous devez configurer votre kit dans l'ordre indiqué.</p>
    </div>
    <div class="flex-none">
        <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-kits', {{ json_encode(['product_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Configurer</button>
        <button type="button" class="bg-gray-200 py-2 px-2.5 rounded-md" title="Obtenir de l'aide"><i class="fa-regular fa-circle-question"></i></button>
    </div>
</div>


{{-- Ajout d'une variation --}}
<div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
    <div class="flex-1">
        <h2 class="font-bold">Ajouter une nouvelle variante</h2>
        <p class="text-sm text-gray-500">Les variantes de produits permettent à l'utilisateur de sélectionner différentes composantes pour un même produit</p>
    </div>
    <div class="flex-none">
        <button wire:click="$emit('openModal', 'popups.back.products.product-add.type2', {{ json_encode(['product_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter une variante</button>
        <button type="button" class="bg-gray-200 py-2 px-2.5 rounded-md" title="Obtenir de l'aide"><i class="fa-regular fa-circle-question"></i></button>
    </div>
</div>

@if($temp_swatch->count() > 0)
    <div class="mt-5 table-box-outline">
        <table>
            <thead>
            <tr>
                <th>Code UGS</th>
                <th>Type</th>
                <th>Valeur</th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
                <th>TVA</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($temp_swatch as $swatch)
                    <tr>
                        <td>{{ $swatch->ugs }}/{{ $swatch->ugs_swatch }}</td>
                        <td>{{ $swatch->getVariantGroup()->title }}</td>
                        <td><span class="bg-gray-200 px-2 py-0.5 text-sm rounded-md">@if($swatch->getVariantGroup()->type == 1) {{ $swatch->getVariantItem()->key }} @else {{ $swatch->getVariantItem()->title }} <i class="fa-solid fa-circle ml-1" style="color: {{ $swatch->getVariantItem()->key }}"></i> @endif</span></td>
                        <td>{{ $swatch->getPriceHT() }} €</td>
                        <td>{{ $swatch->getPriceTTC() }} €</td>
                        <td>{{ $swatch->getTVA() }}</td>
                        <td>
                            <a wire:click.prevent="deleteVariant({{ $swatch->id }})" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

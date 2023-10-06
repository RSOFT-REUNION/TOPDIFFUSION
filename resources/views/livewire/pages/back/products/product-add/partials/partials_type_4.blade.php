{{-- Ajout d'une variation --}}
<div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
    <div class="flex-1">
        <h2 class="font-bold">Ajouter un nouveau pneu</h2>
        <p class="text-sm text-gray-500">Vous pouvez ajouter plusieurs pneus.</p>
    </div>
    <div class="flex-none">
        <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-tires', {{ json_encode(['product_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter un pneu</button>
        <button type="button" class="bg-gray-200 py-2 px-2.5 rounded-md" title="Obtenir de l'aide"><i class="fa-regular fa-circle-question"></i></button>
    </div>
</div>

@if($temp_swatch->count() > 0)
    <div class="table-box-outline mt-5">
        <table>
            <thead>
            <tr>
                <th>Code UGS</th>
                <th>Position</th>
                <th>Largeur</th>
                <th>Hauteur</th>
                <th>Diamètre</th>
                <th>Indice de charge</th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($temp_swatch as $swatch)
                    <tr>
                        <td>{{ $swatch->ugs }}/{{$swatch->ugs_swatch}}</td>
                        <td>{{ $swatch->tire_position }}</td>
                        <td>{{ $swatch->tire_width }}</td>
                        <td>{{ $swatch->tire_height }}</td>
                        <td>{{ $swatch->tire_diameter }}</td>
                        <td>{{ $swatch->tire_charge }}</td>
                        <td>{{ $swatch->getPriceHT() }} €</td>
                        <td>{{ $swatch->getPriceTTC() }} €</td>
                        <td>
                            <a wire:click.prevent="deleteVariant({{ $swatch->id }})" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif


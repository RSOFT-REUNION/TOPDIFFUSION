<div>
    {{-- Ajout de motos --}}
    <div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
        <div class="flex-1">
            <h2 class="font-bold">Ajouter de nouvelles motos</h2>
            <p class="text-sm text-gray-500">Sélectionnez parmis la liste des motos les motos qui sont compatible avec votre produit</p>
        </div>
        <div class="flex-none">
            <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-bikes', {{ json_encode(['product_temp_id' => $product->id]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter des motos</button>
            <button type="button" class="bg-gray-200 py-2 px-2.5 rounded-md" title="Obtenir de l'aide"><i class="fa-regular fa-circle-question"></i></button>
        </div>
    </div>

    {{-- Liste des motos --}}
    @if($bikes->count() > 0)
        <div class="table-box-outline mt-2">
            <table>
                <thead>
                <tr>
                    <th>Marque</th>
                    <th>Cylindrée</th>
                    <th>Modèle</th>
                    <th>Année</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($bikes as $bike)
                    <tr>
                        <td>{{ $bike->getBike()->marque }}</td>
                        <td>{{ $bike->getBike()->cylindree }}</td>
                        <td>{{ $bike->getBike()->modele }}</td>
                        <td>{{ $bike->getBike()->annee }}</td>
                        <td><a wire:click="deleteCompatibleBike({{ $bike->id }})" class="text-gray-500 hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@if($kit_type == 1)
    {{-- Ajout d'une chaine --}}
    <form wire:submit.prevent="addChains">
        @csrf
        <div class="textfield mb-2">
            <label for="chains_reference">Référence de la chaine</label>
            <input type="text" id="chains_reference" wire:model.live="chains_reference" placeholder="Entrez la référence de votre chaine" class="">
            @error('chains_reference')
                <p class="text-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="textfield mb-2">
            <label for="chains_ugs">Code UGS</label>
            <input type="text" id="chains_ugs" wire:model.live="chains_ugs" placeholder="Entrez la référence UGS de votre chaine" class="">
            @error('chains_ugs')
            <p class="text-error">{{ $errors->first('chains_ugs') }}</p>
            @enderror
        </div>
    </form>
    <div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
        <div class="flex-1 pr-5">
            <h2 class="font-bold">Ajouter une longueur</h2>
            <p class="text-sm text-gray-500">Lors de l'achat d'une chaîne, que ça soit pour un achat unique ou en tant que composant d'un kit, la longueur de celle-ci doit s'adapter au pignon et à la couronne.</p>
        </div>
        <div class="flex-none">
            @if($chains_reference && $chains_ugs)
                <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-chain-length', {{ json_encode(['product_id' => $product->id, 'element_reference' => $chains_reference, 'element_ugs' => $chains_ugs]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter</button>
            @endif
        </div>
    </div>
    <div class="mt-10">
        <div class="table-box-outline">
            <table>
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Longeur</th>
                        <th>Prix HT</th>
                        <th>Prix TTC</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($temp_chains as $chain)
                    <tr>
                        <td>{{ $chain->ugs }}{{ $chain->ugs_swatch }}</td>
                        <td>{{ $chain->chains_length }}</td>
                        <td>{{ number_format($chain->price_ht, '2', ',', ' ') }} €</td>
                        <td>{{ number_format($chain->price_ttc, '2', ',', ' ') }} €</td>
                        <td><a wire:click="deleteLength({{ $chain->id }})" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@elseif($kit_type == 2)
    {{-- Ajout d'un pignon --}}
    <form wire:submit.prevent="addGear">
        @csrf
        <div class="textfield mb-2">
            <label for="gear_reference">Référence du pignon</label>
            <input type="text" id="gear_reference" wire:model.live="gear_reference" placeholder="Entrez la référence de votre pignon" class="">
            @error('gear_reference')
            <p class="text-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="textfield mb-2">
            <label for="gear_ugs">Code UGS</label>
            <input type="text" id="gear_ugs" wire:model.live="gear_ugs" placeholder="Entrez la référence UGS de votre pignon" class="">
            @error('gear_ugs')
            <p class="text-error">{{ $errors->first('gear_ugs') }}</p>
            @enderror
        </div>
    </form>
    <div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
        <div class="flex-1 pr-5">
            <h2 class="font-bold">Ajouter une denture</h2>
        </div>
        <div class="flex-none">
            @if($gear_reference && $gear_ugs)
                <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-chain-length', {{ json_encode(['product_id' => $product->id, 'element_reference' => $gear_reference, 'element_ugs' => $gear_ugs]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter</button>
            @endif
        </div>
    </div>
    <div class="mt-10">
        <div class="table-box-outline">
            <table>
                <thead>
                <tr>
                    <th>Référence</th>
                    <th>Denture</th>
                    <th>Prix HT</th>
                    <th>Prix TTC</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($temp_gears as $gear)
                    <tr>
                        <td>{{ $gear->ugs }}{{ $gear->ugs_swatch }}</td>
                        <td>{{ $gear->gear_tooth }}</td>
                        <td>{{ number_format($gear->price_ht, '2', ',', ' ') }} €</td>
                        <td>{{ number_format($gear->price_ttc, '2', ',', ' ') }} €</td>
                        <td><a wire:click="deleteLength({{ $gear->id }})" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    {{-- Ajout d'une couronne --}}
    <form wire:submit.prevent="addCrown">
        @csrf
        <div class="textfield mb-2">
            <label for="crown_reference">Référence de la couronne</label>
            <input type="text" id="crown_reference" wire:model.live="crown_reference" placeholder="Entrez la référence de votre couronne" class="">
            @error('crown_reference')
            <p class="text-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="textfield mb-2">
            <label for="crown_ugs">Code UGS</label>
            <input type="text" id="crown_ugs" wire:model.live="crown_ugs" placeholder="Entrez la référence UGS de votre couronne" class="">
            @error('crown_ugs')
            <p class="text-error">{{ $errors->first('crown_ugs') }}</p>
            @enderror
        </div>
    </form>
    <div class="flex items-center bg-gray-100 px-5 py-3 rounded-md">
        <div class="flex-1 pr-5">
            <h2 class="font-bold">Ajouter une denture</h2>
        </div>
        <div class="flex-none">
            @if($crown_reference && $crown_ugs)
                <button wire:click="$emit('openModal', 'popups.back.products.product-add.add-chain-length', {{ json_encode(['product_id' => $product->id, 'element_reference' => $crown_reference, 'element_ugs' => $crown_ugs]) }})" type="button" class="bg-secondary px-3 py-2 rounded-md">Ajouter</button>
            @endif
        </div>
    </div>
    <div class="mt-10">
        <div class="table-box-outline">
            <table>
                <thead>
                <tr>
                    <th>Référence</th>
                    <th>Denture</th>
                    <th>Prix HT</th>
                    <th>Prix TTC</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($temp_crowns as $crown)
                    <tr>
                        <td>{{ $crown->ugs }}{{ $crown->ugs_swatch }}</td>
                        <td>{{ $crown->crown_tooth }}</td>
                        <td>{{ number_format($crown->price_ht, '2', ',', ' ') }} €</td>
                        <td>{{ number_format($crown->price_ttc, '2', ',', ' ') }} €</td>
                        <td><a wire:click="deleteLength({{ $crown->id }})" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif




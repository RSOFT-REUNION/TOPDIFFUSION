<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Options des produits</h1>
        </div>
        <div class="flex-none inline-flex items-center">

        </div>
    </div>
    <div id="entry-content">
        <div>
            <div class="flex items-center">
                <div class="flex-1">
                    <h2 class="subtitle">Group d'options</h2>
                </div>
                <div class="flex-none inline-flex items-center">
                    <a wire:click="$emit('openModal', 'pages.back.products.popup-add-group-tag')" class="btn-secondary cursor-pointer block"><i class="fa-solid fa-plus mr-3"></i>Ajouter un groupe</a>
                    @if($group->count() > 0)
                        <p class="ml-2 text-tag-count">{{ $group->count() }}</p>
                    @endif
                </div>
            </div>
            @if($group->count() > 0)
                <div class="table-box-outline mt-5">
                    <table>
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Nb. de variantes</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($group as $gr)
                                <tr role="button" data-href="{{ route('back.product.options-tag', ['id' => $gr->id]) }}" class="hover:bg-gray-50">
                                    <td>{{ $gr->title }}</td>
                                    <td>{!! $gr->getTypeText() !!}</td>
                                    <td>--</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty-text mt-5">Vous n'avez pas encore ajouter de groupe d'option</p>
            @endif
        </div>


        {{-- Ajout de pignon --}}
        <div class="mt-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2 class="subtitle">Kit chaines | <span class="text-secondary">Liste des pignons</span></h2>
                </div>
                <div class="flex-none inline-flex items-center">
                    <button wire:click="" aria-label="Importer" title="Importer" class="bg-gray-100 py-2.5 px-3.5 mr-2 rounded-lg border border-transparent hover:border-gray-200"><i class="fa-solid fa-file-import"></i></button>
                    <a wire:click="$emit('openModal', 'popups.back.products.product-option.add-pignon')" class="btn-secondary cursor-pointer block"><i class="fa-solid fa-plus mr-3"></i>Ajouter un pignon</a>
                    @if($pignons->count() > 0)
                        <p class="ml-2 text-tag-count">{{ $pignons->count() }}</p>
                    @endif
                </div>
            </div>
            @if($pignons->count() > 0)
                <div class="table-box-outline mt-5">
                    <table>
                        <thead>
                        <tr>
                            <th><i class="fa-solid fa-image"></i></th>
                            <th>Pièce</th>
                            <th>Référence</th>
                            <th>Dentures</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pignons as $pignon)
                            <tr>
                                <td class="w-[80px]"><img src="{{ asset('storage/images/kit_parts/'. $pignon->picture_url) }}" width="70px"></td>
                                <td>{{ $pignon->title }}</td>
                                <td>{{ $pignon->reference }}</td>
                                <td>{{ $pignon->gearing }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty-text mt-5">Vous n'avez pas encore ajouté de pignons</p>
            @endif
        </div>

        {{-- Ajout de chaines --}}
        <div class="mt-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2 class="subtitle">Kit chaines | <span class="text-secondary">Liste des chaines</span></h2>
                </div>
                <div class="flex-none inline-flex items-center">
                    <button wire:click="" aria-label="Importer" title="Importer" class="bg-gray-100 py-2.5 px-3.5 mr-2 rounded-lg border border-transparent hover:border-gray-200"><i class="fa-solid fa-file-import"></i></button>
                    <a wire:click="$emit('openModal', 'popups.back.products.product-option.add-chain')" class="btn-secondary cursor-pointer block"><i class="fa-solid fa-plus mr-3"></i>Ajouter une chaine</a>
                    @if($chains->count() > 0)
                        <p class="ml-2 text-tag-count">{{ $chains->count() }}</p>
                    @endif
                </div>
            </div>
            @if($chains->count() > 0)
                <div class="table-box-outline mt-5">
                    <table>
                        <thead>
                        <tr>
                            <th><i class="fa-solid fa-image"></i></th>
                            <th>Pièce</th>
                            <th>Type</th>
                            <th>Couleur</th>
                            <th>Pas</th>
                            <th>Longueur</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($chains as $chain)
                            <tr>
                                <td class="w-[80px]"><img src="{{ asset('storage/images/kit_parts/'. $chain->picture_url) }}" width="70px"></td>
                                <td>{{ $chain->title }}</td>
                                <td>{{ $chain->type }}</td>
                                <td>{{ $chain->color }}</td>
                                <td>{{ $chain->pas }}</td>
                                <td>{{ $chain->length }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty-text mt-5">Vous n'avez pas encore ajouter de chaines</p>
            @endif
        </div>

        {{-- Ajout de couronne --}}
        <div class="mt-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2 class="subtitle">Kit chaines | <span class="text-secondary">Liste des couronnes</span></h2>
                </div>
                <div class="flex-none inline-flex items-center">
                    <button wire:click="" aria-label="Importer" title="Importer" class="bg-gray-100 py-2.5 px-3.5 mr-2 rounded-lg border border-transparent hover:border-gray-200"><i class="fa-solid fa-file-import"></i></button>
                    <a wire:click="$emit('openModal', 'popups.back.products.product-option.add-crown')" class="btn-secondary cursor-pointer block"><i class="fa-solid fa-plus mr-3"></i>Ajouter une couronne</a>
                    @if($crowns->count() > 0)
                        <p class="ml-2 text-tag-count">{{ $crowns->count() }}</p>
                    @endif
                </div>
            </div>
            @if($crowns->count() > 0)
                <div class="table-box-outline mt-5">
                    <table>
                        <thead>
                        <tr>
                            <th><i class="fa-solid fa-image"></i></th>
                            <th>Pièce</th>
                            <th>Référence</th>
                            <th>Dentures</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($crowns as $crown)
                            <tr>
                                <td class="w-[80px]"><img src="{{ asset('storage/images/kit_parts/'. $crown->picture_url) }}" width="70px"></td>
                                <td>{{ $crown->title }}</td>
                                <td>{{ $crown->reference }}</td>
                                <td>{{ $crown->gearing }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty-text mt-5">Vous n'avez pas encore ajouter de couronne</p>
            @endif
        </div>
    </div>
</div>

<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Motos</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <a wire:click="$emit('openModal', 'popups.back.products.import-bikes')" class="btn-icon mr-2 cursor-pointer"><i class="fa-solid fa-file-import"></i></a>
            <a wire:click="$emit('openModal', 'pages.back.products.popup-add-bikes')" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter une moto</a>
            @if($bikes->count() > 0)
                <p class="ml-2 text-tag-count">{{ $bikes->count() }}</p>
            @endif
        </div>
    </div>
    <div id="entry-content">
        @if($bikes->count() > 0)
            <div class="table-box-outline">
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
                            <td>{{ $bike->marque }}</td>
                            <td>{{ $bike->cylindree }}</td>
                            <td>{{ $bike->modele }}</td>
                            <td>{{ $bike->annee }}</td>
                            <td style="width: 70px"><a href="" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $bikes->links() }}
            </div>
        @else
            <p class="empty-text">Vous n'avez pas encore ajouté de motos</p>
        @endif
    </div>
</div>

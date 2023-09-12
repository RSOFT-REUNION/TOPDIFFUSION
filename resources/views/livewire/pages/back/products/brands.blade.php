<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Marques</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <a href="" class="btn-icon mr-2"><i class="fa-solid fa-file-import"></i></a>
            <a wire:click="$emit('openModal', 'pages.back.products.popup-add-brands')" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter une marque</a>
            @if($brands->count() > 0)
                <p class="ml-2 text-tag-count">{{ $brands->count() }}</p>
            @endif
        </div>
    </div>
    <div id="entry-content">
        @if($brands->count() > 0)
            <div class="table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nom</th>
                        <th>URL Officiel</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>
                                    <div class="force-center">
                                        <img src="{{ asset('storage/images/brands/'.$brand->picture) }}" width="70px">
                                    </div>
                                </td>
                                <td>{{ $brand->title }}</td>
                                <td>@if($brand->url) {{ $brand->url }} @else -- @endif</td>
                                <td>
                                    <button wire:click="deleteBrand({{ $brand->id }})" class="btn-icon_secondary"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text">Vous n'avez pas encore ajouté de marques</p>
        @endif
    </div>
</div>

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
    </div>
</div>

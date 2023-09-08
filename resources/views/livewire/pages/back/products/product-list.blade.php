<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Produits</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <a href="" class="btn-icon mr-2"><i class="fa-solid fa-magnifying-glass"></i></a>
            <input wire:model.debounce.100ms="search" type="text" placeholder="Rechercher un produit..." class="bg-transparent px-2 py-3 focus:outline-none border-none focus:border-none duration-300 hover:tracking-wider dark:border-none">
            @if ($search)
                <button wire:click="clear" class="px-3">
                    <i class="fa-solid fa-times"></i>
                </button>
            @endif
            <a href="" class="btn-icon mr-2"><i class="fa-solid fa-file-import"></i></a>
            <a href="{{ route('back.product.create') }}" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter un produit</a>
        </div>
    </div>
    <div id="entry-content">
        @if($products->count() > 0)
            <div class="table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text mt-2">Vous n'avez pas encore ajouté d'article</p>
        @endif
    </div>
</div>

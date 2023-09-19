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
            {{-- * Import CSV à gérer plus tard --}}
            {{-- <a href="" class="btn-icon mr-2"><i class="fa-solid fa-file-import"></i></a> --}}
            <a href="{{ route('back.product.create') }}" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter un produit</a>
        </div>
    </div>
    <div id="entry-content">
        @if($products->count() > 0)
            <div class="table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>Nom du Produit</th>
                        <th>Nom URL</th>
                        <th>Prix Professionel</th>
                        <th>Prix Client</th>
                        @if ($productPourcentagePrice)
                        <th>Pourcentage</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $productName }}</td>
                            <td>{{ $productSlug }}</td>
                            <td>{{ $productProfessionnalPrice }} €</td>
                            <td>{{ $productCustomerPrice }} €</td>
                            @if ($productPourcentagePrice)
                            <td>{{ $productPourcentagePrice }} %</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text mt-2">Vous n'avez pas encore ajouté d'article</p>
        @endif
    </div>
</div>

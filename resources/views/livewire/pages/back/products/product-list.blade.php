<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Produits</h1>
{{--            <h1><a href="">Produits</a></h1>--}}
        </div>
        <div class="flex-none inline-flex items-center">
            <div class="bg-slate-100 mr-3 rounded-md pl-5">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input wire:model.debounce.100ms="search" type="text" placeholder="Rechercher un produit..." class="bg-transparent px-2 py-3 focus:outline-none border-none focus:border-none duration-300 hover:tracking-wider dark:border-none w-[300px]">
                @if ($search)
                    <button wire:click="clear" class="px-3">
                        <i class="fa-solid fa-times"></i>
                    </button>
                @endif
            </div>
            {{-- * Import CSV à gérer plus tard --}}
            <a href="" class="btn-icon mr-2"><i class="fa-solid fa-file-import"></i></a>
            <a href="{{ route('back.product.create') }}" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter un produit</a>
        </div>
    </div>
    <div id="entry-content">
        @if(count($products) > 0)
            <div class="table-box-outline">
                <table>
                    {{-- {{ dd(auth()->user()->customerGroup->name) }} --}}
                    <thead>
                    <tr>
                        <th><i class="fa-solid fa-image"></i></th>
                        <th>UGS</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Prix Client HT</th>
                        <th>Prix Pro. TTC</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr role="button" data-href="{{ route('back.product.single', ['product' => $product->id]) }}" class="hover:text-blue-500">
                                <td class="w-[70px]"><img src="{{ asset('storage/images/products/'. $product->cover) }}" width="50px"></td>
                                <td>{{ $product->getUgs() }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{!! $product->getTypeBadge() !!}</td>
                                <td>{{ number_format($product->getPriceHT(), '2', ',', ' ') }} €</td>
                                <td>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</td>
                                <td><i class="fa-solid fa-eye"></i></td>
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

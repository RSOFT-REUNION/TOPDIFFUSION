<div>
    <div class="flex-none inline-flex items-center w-full">
        <a href="" class="btn-icon mr-2"><i class="fa-solid fa-magnifying-glass"></i></a>
        <input wire:model.debounce.100ms="search" type="text" placeholder="Rechercher un produit..." class="bg-transparent py-5 outline-none border-none duration-300 hover:tracking-wider dark:border-none w-full">
        @if ($search)
            <button wire:click="clear" class="px-3">
                <i class="fa-solid fa-times"></i>
            </button>
        @endif
    </div>
    <hr class="text-gray-200">

    <div class="mt-7 px-5 pb-5">
        @if($products->count() > 0)
            <div class="table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>#</th>
                        <th>Nom</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <input type="checkbox" wire:model="selectedProducts" value="{{ $product->id }}" {{ in_array($product->id, $selectedProducts) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a wire:click="btn">Ajouter</a>
        @else
            <p class="empty-text mt-2">Vous n'avez pas encore ajouté d'article</p>
        @endif
    </div>
</div>

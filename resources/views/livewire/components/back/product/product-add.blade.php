<div>
    @if($product->type == 1)
        <!-- Simple product -->
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="subtitle">Catégories du produit</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('openModal', 'pages.back.products.popup-add-product-categories', {{ json_encode(['product_id' => $product->id]) }})" class="cursor-pointer btn-outline block text-center">Ajouter une catégorie</a>
            </div>
        </div>
        @if($categories->count() > 0)
            <div class="mt-3 table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>ID Catégorie</th>
                        <th>Nom</th>
                        <th>Catégorie principal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->getId() }}</td>
                            <td>{{ $category->getTitle() }}</td>
                            <td>@if($category->principal == 1) <i class="fa-solid fa-square-check text-green-500"></i> @else <i class="fa-solid fa-rectangle-xmark text-red-500"></i> @endif</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text mt-3">Vous n'avez pas encore ajouté de catégories</p>
        @endif
        <hr class="my-3">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="subtitle">Photos supplémentaire</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('openModal', 'pages.back.products.popup-add-product-picture', {{ json_encode(['product_id' => $product->id]) }})" class="cursor-pointer btn-outline block text-center">Ajouter une photo</a>
            </div>
        </div>
        @if($pictures->count() > 0)
            <div class="grid grid-cols-4 gap-5 mt-3">
                @foreach($pictures as $pic)
                    <div>
                        <img src="{{ asset('storage/images/products_attachment/'. $pic->picture_name) }}">
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-text mt-3">Vous n'avez pas ajouté de photos</p>
        @endif
        <hr class="my-3">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="subtitle">Informations supplémentaire</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('openModal', 'pages.back.products.popup-add-product-informations', {{ json_encode(['product_id' => $product->id]) }})" class="cursor-pointer btn-outline block text-center">Ajouter une information</a>
            </div>
        </div>
        @if($pictures->count() > 0)
            <div class="grid grid-cols-4 gap-5 mt-3">
                @foreach($pictures as $pic)
                    <div>
                        <img src="{{ asset('storage/images/products_attachment/'. $pic->picture_name) }}">
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-text mt-3">Vous n'avez pas ajouté de photos</p>
        @endif
    @else
        <!-- Variant product -->
    @endif

</div>

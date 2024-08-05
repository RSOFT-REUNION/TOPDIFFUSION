<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Liste des produits</h1>
        <div>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.product.add-product'})" class="btn-primary"><i class="fa-solid fa-plus mr-3"></i>Ajouter une nouveau produit</button>
        </div>
    </div>
    <div class="mt-5">
        <div class="table-box">
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Prix unitaire</th>
                    <th>Catégorie</th>
                    <th>Marque</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr role="button" data-href="{{ route('bo.products.single', ['product_id' => $product->id]) }}">
                        <td class="text-slate-400 border-r">{{ $product->id }}</td>
                        <td>
                            <div>
                                <p class="">{{ $product->name }}</p>
                                <p class="text-sm text-slate-400">{{ $product->slug }}</p>
                            </div>
                        </td>
                        <td>{!! $product->getTypeBadge() !!}</td>
                        <td class="font-title font-bold">{{ number_format($product->getUnitPriceWithoutDiscount(), 2, ',', ' ') }} €</td>
                        <td>{{ $product->getCategory()->name }}</td>
                        <td>{{ $product->getBrand()->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

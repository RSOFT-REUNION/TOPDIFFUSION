<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Stocks</h1>
        </div>
        <div class="flex-none">
            <a href="" class="mr-3 hover:text-orange-400" title="Exporter la liste des articles avec leurs stocks"><i class="fa-solid fa-file-export"></i></a>
            <a class="btn-secondary cursor-pointer">Réaliser un inventaire</a>
        </div>
    </div>
    <div id="entry-content">
        <div class="grid grid-cols-4 gap-4">
            <div class="grid-item-button text-red-500">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-arrow-trend-down fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>{{ $off_stock->count() }} articles</h3>
                        <p>En rupture de stock</p>
                    </div>
                </div>
            </div>
            <div class="grid-item-button text-amber-600">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-shapes fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>{{ $low_stock->count() }} articles</h3>
                        <p>Avec un stock faible</p>
                    </div>
                </div>
            </div>
            <div class="grid-item-button">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-cart-shopping fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>3 articles</h3>
                        <p>Dans un panier</p>
                    </div>
                </div>
            </div>
            <div class="grid-item-button border border-transparent hover:border-gray-300 cursor-pointer duration-300" wire:click="$emit('openModal', 'popups.back.products.stocks.show-all-stock')">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>{{ $stocks->count() }} articles</h3>
                        <p>En stock</p>
                    </div>
                </div>
            </div>
        </div>
        @if($low_stock->count() == 0 && $off_stock->count() == 0)
            <p class="empty-text mt-5">Tous vos stocks sont à jour</p>
        @endif
        @if($low_stock->count() > 0)
            <div class="mt-5">
                <form wire:submit.prevent="updateLowStock">
                    @csrf
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h2 class="subtitle">Articles avec un faible stock</h2>
                        </div>
                        <div class="flex-none">
                            <button type="submit" class="btn-secondary cursor-pointer">Mettre à jour les stocks</button>
                        </div>
                    </div>
                    <div class="mt-3 table-box-outline">
                        <table>
                            <thead>
                            <tr>
                                <th>Article</th>
                                <th>Code UGS</th>
                                <th>Quantité</th>
                                <th>Depuis le</th>
                                <th>Nouvelle quantité</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($low_stock as $low)
                                <tr>
                                    <td>{{ $low->product()->title }}</td>
                                    <td>{{ $low->productSwatch()->ugs }}</td>
                                    <td>{{ $low->quantity }}</td>
                                    <td>{{ $low->getUpdatedDate() }}</td>
                                    <td class="width-300">
                                        <input type="number" wire:model="updatedLowQuantities.{{ $low->id }}" min="1" step="1" class="focus:outline-none border border-gray-200 px-2 py-1 rounded-lg" placeholder="Entrez une quantiter">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        @endif
        @if($off_stock->count() > 0)
            <div class="mt-5">
                <form wire:submit.prevent="updateOffStock">
                    @csrf
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h2 class="subtitle">Articles en rupture de stock</h2>
                        </div>
                        <div class="flex-none">
                            <button type="submit" class="btn-secondary cursor-pointer">Mettre à jour les stocks</button>
                        </div>
                    </div>
                    <div class="mt-3 table-box-outline">
                        <table>
                            <thead>
                            <tr>
                                <th>Article</th>
                                <th>Code UGS</th>
                                <th>En rupture depuis</th>
                                <th>Nouvelle quantité</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($off_stock as $off)
                                <tr>
                                    <td>{{ $off->product()->title }}</td>
                                    <td>{{ $off->productSwatch()->ugs }}</td>
                                    <td>{{ $off->getUpdatedDate() }}</td>
                                    <td class="width-300">
                                        <input type="number" wire:model="updatedQuantities.{{ $off->id }}" min="1" step="1" class="focus:outline-none border border-gray-200 px-2 py-1 rounded-lg" placeholder="Entrez une quantité">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        @endif

    </div>
</div>

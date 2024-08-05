<div>
    <div class="inline-flex items-center w-full">
        <h1 class="font-title font-bold text-xl">Stocks</h1>
    </div>
    <div class="mt-5 grid grid-cols-3 gap-5">
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $stock_available->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. produit en stock</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $stock_low->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. produit avec un stock faible</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $stock_off->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. produit avec un en rupture de stock</p>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="mt-5 table-box">
            <table>
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td><div>
                                <p class="font-bold">{{ $stock->getProduct()->name }}</p>
                                <p class="text-sm text-slate-400">{{ $stock->getProductVariant()->color_name }} - {{ $stock->getProductVariant()->size_name }}</p>
                            </div></td>
                        <td class="font-title">{{ $stock->quantity }}</td>
                        <td><button wire:click="$dispatch('openModal', {component: 'backend.popups.product.edit-single-stock', arguments: { product_id: {{ $stock->product_id }}, product_data: {{ $stock->variant_id }} }})" class="hover:underline hover:text-blue-500">Modifier la quantité</button></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

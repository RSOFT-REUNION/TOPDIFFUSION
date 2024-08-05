<div>
    <div class="container mx-auto my-10">
        <div class="flex gap-10">
            <div class="flex-1">
                <a href="{{ route('fo.home') }}" class="btn-slate-icon inline-flex items-center"><i class="fa-solid fa-arrow-left mr-3"></i>Retour à l'accueil</a>
                <div class="mt-10 table-box">
                    <table>
                        <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix unit. (HT)</th>
                            <th>Quantité</th>
                            <th>Prix total (HT)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <tr class="divide-x">
                                <td>
                                    <div class="inline-flex items-center gap-4">
                                        @if($item->product()->cover)
                                            <img width="100px" class="rounded-lg overflow-hidden" src="{{ asset('storage/products/covers/'. $item->product()->cover) }}" alt="{{ $item->product()->name }}">
                                        @endif
                                        <div>
                                            <p class="font-title font-bold">{{ $item->product()->name }}</p>
                                            @if($item->product()->type == 'variable')
                                                <p class="text-slate-400">Couleur : {{ $item->productData()->color_name }}</p>
                                                <p class="text-slate-400">Taille : {{ $item->productData()->size_name }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="font-title">{{ number_format($item->productData()->price_unit, '2', ',', ' ') }} €</td>
                                <td class="font-title">
                                    <div class="inline-flex items-center bg-slate-100 border rounded-lg overflow-hidden">
                                        <button wire:click="minusQuantity({{ $item->id }})" class="px-3 text-slate-400 hover:text-blue-500"><i class="fa-solid fa-minus"></i></button>
                                        <p class="p-2 font-title">{{ $item->quantity }}</p>
                                        <button wire:click="plusQuantity({{ $item->id }})" class="px-3 text-slate-400 hover:text-blue-500"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    @if($item->product()->getStock()->quantity != $item->quantity)
                                        <p class="text-sm text-slate-400 mt-2">En stock: {{ $item->product()->getStock()->quantity }}</p>
                                    @endif
                                </td>
                                <td class="font-title">{{ number_format($item->productData()->price_unit * $item->quantity, '2', ',', ' ') }} €</td>
                                <td>
                                    <div class="inline-flex items-center gap-4">
                                        <button wire:click="removeItem({{ $item->id }})" class="hover:text-red-500"><i class="fa-regular fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex-none border-l px-5 w-[400px]">
                <h1 class="font-title font-bold text-2xl">Sommaire</h1>
                <ul class="divide-y mt-5">
                    <li>
                        <div class="inline-flex items-center w-full justify-between my-2">
                            <p class="text-slate-400">Nombre de produit</p>
                            <p class="font-title">{{ $cartItems->count() }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="inline-flex items-center w-full justify-between my-2">
                            <p class="text-slate-400">Quantité de produit</p>
                            <p class="font-title">{{ $cartItems->sum('quantity') }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="inline-flex items-center w-full justify-between my-2">
                            <p class="text-slate-400">Montant total HT</p>
                            <p class="font-title">{{ number_format($cart->getCartTotalHT(), '2', ',', '') }} €</p>
                        </div>
                    </li>
                    <li>
                        <div class="inline-flex items-center w-full justify-between my-2">
                            <p class="text-slate-400">Montant remise particulière</p>
                            <p class="font-title">{{ number_format($cart->getGroupDiscount(), '2', ',', '') }} €</p>
                        </div>
                    </li>
                    <li>
                        <div class="inline-flex items-center w-full justify-between my-2">
                            <p class="text-slate-400">Montant TVA</p>
                            <p class="font-title">{{ number_format($cart->getTVA(), '2', ',', '') }} €</p>
                        </div>
                    </li>
                    @if(\App\Helpers\ConfigHelper::getSettings()['shipping'])
                        <li>
                            <div class="inline-flex items-center w-full justify-between my-2">
                                <p class="text-slate-400">Frais de livraison</p>
                                <p class="font-title">{{ number_format($cart->getShippingTax(), 2, ',', ' ') }} €</p>
                            </div>
                        </li>
                    @endif
                    <li>
                        <div class="inline-flex items-center w-full justify-between my-2">
                            <p class="text-slate-400">Montant totale TTC</p>
                            <p class="font-title text-primary font-bold text-xl">{{ number_format($cart->getTotalPrice(), '2', ',', '') }} €</p>
                        </div>
                    </li>
                </ul>
                <div class="mt-5">
                    @if(\App\Helpers\ConfigHelper::getSettings()['payment'] == 1)
                        <button wire:click="proceedToPayment('card')"  class="btn-primary w-full"><i wire:loading class="fa-solid fa-spinner fa-spin mr-2"></i>Procéder au paiement</button>
                    @else
                        <p class="text-red-500 text-center">Le paiement par carte est temporairement désactivé</p>
                    @endif
                    @if(auth()->user()->type == 1)
                        <div class="bg-slate-100 mt-2 rounded-lg p-3">
                            <h2 class="font-title font-bold">Payer plus tard</h2>
                            <button wire:click="proceedToPayment('later')" class="btn-primary w-full mt-2">Paiement en espèces</button>
                            <button wire:click="proceedToPayment('virement')" class="btn-primary w-full mt-2">Paiement par virement ou chèque</button>
                        </div>
                    @endif
                    @if(\App\Models\ShippingPoint::all()->count() > 0)
                        <button wire:click="$dispatch('openModal', {component: 'frontend.popups.products.add-shipping-point'})" class="btn-slate w-full mt-2">
                            @if($shipping_address)
                                {{ \App\Models\ShippingPoint::find($shipping_address)->name }}
                            @else
                                Livraison en point relais
                            @endif
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
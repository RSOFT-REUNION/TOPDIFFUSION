<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Livraison</h1>
    </div>
    <div class="mt-5">
        <div class="inline-flex items-center w-full justify-between pb-5">
            <div>
                <p>Activer la livraison</p>
                <p class="text-slate-400 text-sm">Activer les frais de livraison pour les particuliers</p>
            </div>
            <!-- Toggle Button -->
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:click="changeActiveShipping" value="" @if($shippingActive) checked @endif class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            </label>
        </div>
    </div>
    <div class="mt-5 border-t pt-5">
        <div class="inline-flex items-center justify-between w-full">
            <h2 class="font-title font-bold text-lg">Frais de livraison</h2>
            <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.settings.add-shipping'})" class="btn-slate">Ajouter un nouveau frais</button>
        </div>
        @if($taxes->count() > 0)
            <div class="table-box-outline mt-5">
                <table>
                    <thead>
                    <tr>
                        <th>Montant</th>
                        <th>A partir de</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taxes as $tax)
                        <tr class="group *:font-title">
                            <td>{{ number_format($tax->amount, 2, ',', ' ') }} €</td>
                            <td>{{ number_format($tax->max_price, 2, ',', ' ') }} €</td>
                            <td><button wire:click="deleteTax({{ $tax->id }})" class="text-red-500 invisible group-hover:visible"><i class="fa-regular fa-delete-left"></i></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-slate-400 mt-5">Aucun frais de livraison n'a été ajouté</p>
        @endif
    </div>
    <div class="mt-5 pt-5 border-t">
        <div class="inline-flex items-center justify-between w-full">
            <h2 class="font-title font-bold text-lg">Point relais</h2>
            <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.settings.add-shipping-point'})" class="btn-slate">Ajouter une nouvelle adresse</button>
        </div>
        @if($points->count() > 0)
            <div class="table-box-outline mt-5">
                <table>
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($points as $point)
                        <tr class="group">
                            <td class="border-r font-bold">
                                <div>
                                    <p>{{ $point->name }}</p>
                                    <p class="text-slate-400 text-sm">{{ $point->phone }}</p>
                                </div>
                            </td>
                            <td>{{ $point->address }}@if($point->address_bis), {{ $point->address_bis }} @endif</td>
                            <td>{{ $point->city }} ({{ $point->zip_code }}) </td>
                            <td><button wire:click="deletePoint({{ $point->id }})" class="text-red-500 invisible group-hover:visible"><i class="fa-regular fa-delete-left"></i></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-slate-400 mt-5">Aucun point relais n'a été ajouté</p>
        @endif
    </div>
</div>

<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Paiement & taxes</h1>
        </div>
    </div>
    <div id="entry-content">
        <div class="container-box-page">
            <div class="entry-header">
                <h2>TVA</h2>
            </div>
            <div class="entry-content">
                <div class="btn-check-line flex items-center">
                    <div class="flex-1">
                        <label for="tarif_write">Tarif saisie avec la TVA</label>
                        <p>Par défaut, tout les tarifs seront saisie avec en TTC</p>
                    </div>
                    <div class="flex-none">
                        <label for="tarif_write" class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:click="tarif_write" id="tarif_write" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
                <div class="btn-check-line flex items-center mt-2">
                    <div class="flex-1">
                        <label for="tarif_write">Affichage des tarif TTC</label>
                        <p>Afficher tout les tarifs des produits en TTC</p>
                    </div>
                    <div class="flex-none">
                        <label for="tarif_write" class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:click="tarif_write" id="tarif_write" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
                <div class="mt-2 flex items-center">
                    <div class="flex-1">
                        <h3>Classes de TVA</h3>
                        <p class="text-gray-500 text-sm">Lister les classes de taxes que vous avez besoin ci-dessous</p>
                    </div>
                    <div class="flex-none">
                        <a wire:click="$emit('openModal', 'popups.back.setting.add-taxes')" class="btn-secondary block cursor-pointer">Ajouter une classe</a>
                    </div>
                </div>
                @if($taxes->count() > 0)
                    <div class="mt-2 table-box-outline">
                    <table>
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Code pays</th>
                            <th>Code état</th>
                            <th>Taux</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($taxes as $tax)
                                <tr>
                                    <td>{{ $tax->title }}</td>
                                    <td>{{ $tax->country_code }}</td>
                                    <td>{{ $tax->state_code }}</td>
                                    <td>{{ number_format($tax->rate, '2', ',', ' ') }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="empty-text mt-2">Vous n'avez pas encore ajouté de classe de TVA</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Paiement</h1>
    </div>
    <div class="mt-5">
        <div class="inline-flex items-center w-full justify-between pb-5">
            <div>
                <p>Paiement sur le site</p>
                <p class="text-slate-400 text-sm">Autorisation d'effectuer des paiements depuis le site.</p>
            </div>
            <!-- Toggle Button -->
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:click="changePaymentActive" value="" @if($payment_active) checked @endif class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            </label>
        </div>
        <div class="border-t pt-5">
            {{--<h2 class="font-title font-bold text-lg">Gestion des tarifs</h2>
            <div class="divide-y mt-2">
                <div class="inline-flex items-center w-full justify-between py-3">
                    <div>
                        <p>Tarifs saisie en TTC</p>
                        <p class="text-slate-400 text-sm">Par défaut tous les tarifs saisie seront en TTC, un calcul sera ensuite effectué afin de retrouver le tarif HT</p>
                    </div>
                    <!-- Toggle Button -->
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:click="changePaymentTTC" value="" @if($payment_TTC) checked @endif class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <div class="inline-flex items-center w-full justify-between py-5">
                    <div>
                        <p>Affichage des tarifs en TTC pour tous</p>
                        <p class="text-slate-400 text-sm">Par défaut, les clients "professionnel" bénéficie d'un affichage de tarif en HT, avec cette option, tous les tarifs affiché seront en TTC</p>
                    </div>
                    <!-- Toggle Button -->
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:click="changeShowTTC" value="" @if($TTC_show) checked @endif class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>--}}
            <div class="mt-3 inline-flex w-full items-center justify-between pt-5">
                <h2 class="font-title font-bold text-lg">Règles des TVA</h2>
                <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.settings.add-tva'})" class="btn-slate">Ajouter une nouvelle règle</button>
            </div>
            @if($tvas->count() > 0)
                <div class="mt-5 table-box">
                    <table>
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Taux</th>
                            <th>Code pays</th>
                            <th>Code état</th>
                            <th>Par défaut</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tvas as $tva)
                            <tr class="group">
                                <td>{{ $tva->name }}</td>
                                <td class="border-r font-title font-bold">{{ $tva->rate }}</td>
                                <td>{{ $tva->country }}</td>
                                <td>{{ $tva->state }}</td>
                                <td>{!! $tva->getDefault() !!}</td>
                                <td>
                                    <button type="button" wire:click="deleteTva({{ $tva->id }})" class="hover:text-blue-500 p-2 invisible group-hover:visible">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-5">
                    <p class="text-slate-400">Vous n'avez pas encore ajouter de règles de TVA</p>
                </div>
            @endif
        </div>
    </div>
</div>

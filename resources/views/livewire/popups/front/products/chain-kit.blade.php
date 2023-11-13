<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Séléctionner votre kit chaine AFAM</h2>
                <p class="text-slate-400 text-sm capitalize">{{ $bike->marque }} {{ $bike->cylindree }} {{ $bike->modele }} {{ $bike->annee }}</p>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <div class="bg-slate-100 p-4 rounded-md">
            <h2 class="text-xl font-bold text-slate-500">Kit Afam aluminium standard</h2>
            <div class="flex items-center gap-2 mt-4">
                <div class="flex-none rounded-sm border border-slate-300">
                    <div class="bg-slate-300 font-bold px-5 py-3">
                        Pignon
                    </div>
                    <div class="p-4">
                        <div class="textfield-white">
                            <label for="sprocket_size">Denture</label>
                            <select id="sprocket_size">
                                <option value="1">14</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex-grow">
                                <div class="text-input-white">
                                    <label for="chain_parts">Pièce</label>
                                    <p>73301-14</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grow rounded-sm border border-slate-300">
                    <div class="bg-slate-300 font-bold px-5 py-3">
                        Chaîne
                    </div>
                    <div class="p-4">
                        <div class="textfield-white">
                            <label for="chain_type">Type de chaine</label>
                            <select id="chain_type">
                                <option value="1">A520MX6</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex-none w-1/4">
                                <div class="text-input-white">
                                    <label for="chain_color">Couleur</label>
                                    <p>Or</p>
                                </div>
                            </div>
                            <div class="flex-none w-1/4">
                                <div class="text-input-white">
                                    <label for="chain_length">Longueur</label>
                                    <p>118</p>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="text-input-white">
                                    <label for="chain_parts">Pièce</label>
                                    <p>A520MX6-GG 118L</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-none rounded-sm border border-slate-300">
                    <div class="bg-slate-300 font-bold px-5 py-3">
                        Couronne
                    </div>
                    <div class="p-4">
                        <div class="textfield-white">
                            <label for="crown_size">Denture</label>
                            <select id="crown_size">
                                <option value="1">51</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex-grow">
                                <div class="text-input-white">
                                    <label for="chain_parts">Pièce</label>
                                    <p>72304N-51</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 text-right">
            <div class="inline-flex items-center">
                <p class="font-bold text-xl pr-2 mr-2 border-r border-slate-200">342,00 €</p>
                <button class="btn-secondary">Ajouter mon kit au panier</button>
            </div>
        </div>
    </div>
</div>

<div>
    <x-templates.header-popup label="Configurer un kit chaine" icon=""/>
    <div class="p-5">
        <form wire:submit="sendToCart">
            @csrf
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-slate-100 border rounded-xl overflow-hidden p-3">
                    <h2 class="bg-slate-200 block font-bold rounded-lg p-2">Pignon</h2>
                    <div class="textfield-light mt-3">
                        <label for="pignon_denture">Denture</label>
                        <select id="pignon_denture" wire:model.live="pignon_denture">
                            <option value="">Sélectionner une denture</option>
                            @foreach($pignons as $pignon)
                                <option value="{{ $pignon->id }}">{{ $pignon->getPignonInformations()['denture'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="bg-slate-100 border rounded-xl overflow-hidden p-3">
                    <h2 class="bg-slate-200 block font-bold rounded-lg p-2">Chaîne</h2>
                    <div class="textfield-light mt-3">
                        <label for="chain_type">Type de chaine</label>
                        <select id="chain_type" wire:model.live="chain_type">
                            <option value="">Sélectionner un type</option>
                            @foreach($chains as $chain)
                                <option value="{{ $chain->id }}">{{ $chain->getChainInformations()['ugs'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="bg-slate-100 border rounded-xl overflow-hidden p-3">
                    <h2 class="bg-slate-200 block font-bold rounded-lg p-2">Couronne</h2>
                    <div class="textfield-light mt-3">
                        <label for="crown_denture">Denture</label>
                        <select id="crown_denture" wire:model.live="crown_denture">
                            <option value="">Sélectionner une denture</option>
                            @foreach($crowns as $crown)
                                <option value="{{ $crown->id }}">{{ $crown->getCrownInformations()['denture'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-5 justify-end inline-flex items-center gap-5 w-full">
                @if($kit_price > 0)
                    <p class="font-title font-bold text-lg">{{ number_format($kit_price, 2, ',', ' ') }} €</p>
                @endif
                <x-elements.buttons.btn-submit label="Ajouter au panier" class="" icon=""/>
            </div>
        </form>
        <div class="mt-5">
            <h2 class="font-title font-bold text-xl text-primary">Chaînes possible</h2>
            <div class="table-box mt-4">
                <table>
                    <thead>
                    <tr>
                        <th>UGS</th>
                        <th>Pas</th>
                        <th>Longueur</th>
                        <th>Dénomination</th>
                        <th>Couleur</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($chains as $chain)
                        <tr class="@if($chain_type == $chain->id) bg-primary @endif">
                            <td>{{ $chain->getChainInformations()['ugs'] }}</td>
                            <td>{{ $chain->getChainInformations()['pas'] }}</td>
                            <td>{{ $chain->getChainInformations()['longueur'] }}</td>
                            <td>{{ $chain->name }}</td>
                            <td>{{ $chain->getChainInformations()['couleur'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-5 border-t pt-5">
            <h2 class="font-title font-bold text-xl text-primary">Pignons possible</h2>
            <div class="table-box mt-4">
                <table>
                    <thead>
                    <tr>
                        <th>UGS</th>
                        <th>Pas</th>
                        <th>Denture</th>
                        <th>Dénomination</th>
                        <th>Matière</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pignons as $pignon)
                        <tr class="@if($pignon_denture == $pignon->id) bg-primary @endif">
                            <td>{{ $pignon->getPignonInformations()['ugs'] }}</td>
                            <td>{{ $pignon->getPignonInformations()['pas'] }}</td>
                            <td>{{ $pignon->getPignonInformations()['denture'] }}</td>
                            <td>{{ $pignon->name }}</td>
                            <td>{{ $pignon->getPignonInformations()['matiere'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-5 border-t pt-5">
            <h2 class="font-title font-bold text-xl text-primary">Couronnes possible</h2>
            <div class="table-box mt-4">
                <table>
                    <thead>
                    <tr>
                        <th>UGS</th>
                        <th>Pas</th>
                        <th>Denture</th>
                        <th>Dénomination</th>
                        <th>Matière</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($crowns as $crown)
                        <tr class="@if($crown_denture == $crown->id) bg-primary @endif">
                            <td>{{ $crown->getCrownInformations()['ugs'] }}</td>
                            <td>{{ $crown->getCrownInformations()['pas'] }}</td>
                            <td>{{ $crown->getCrownInformations()['denture'] }}</td>
                            <td>{{ $crown->name }}</td>
                            <td>{{ $crown->getCrownInformations()['matiere'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

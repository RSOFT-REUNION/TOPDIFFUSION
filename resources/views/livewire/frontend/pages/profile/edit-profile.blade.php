<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-xl">Mes informations</h1>
        <div class="inline-flex items-center gap-2">
            <button wire:click="$dispatch('openModal', {component: 'frontend.popups.profile.edit-password'})" class="btn-slate">Modifier mon mot de passe</button>
        </div>
    </div>
    <div class="mt-5">
        <form wire:submit="editProfile">
            <div class="flex items-center gap-3">
                <x-elements.inputs.textfield type="text" label="Nom" name="lastname" placeholder="Entrez votre nom" class="flex-1" livewire="yes" require="" />
                <x-elements.inputs.textfield type="text" label="Prénom" name="firstname" placeholder="Entrez votre prénom" class="flex-1" livewire="yes" require="" />
            </div>
            <div class="flex items-center gap-3 mt-3">
                <x-elements.inputs.textfield type="tel" label="Numéro de téléphone" name="phone" placeholder="Entrez votre numéro de téléphone" class="flex-1" livewire="yes" require="" />
                <x-elements.inputs.textfield type="email" label="Adresse e-mail" name="email" placeholder="Entrez votre adresse e-mail" class="flex-1" livewire="yes" require="" />
            </div>
            @if($lastname != auth()->user()->lastname || $firstname != auth()->user()->firstname || $phone != auth()->user()->phone || $email != auth()->user()->email)
                <div class="mt-3">
                    <x-elements.buttons.btn-submit class="w-full" label="Enregistrer" icon="" />
                </div>
            @endif
        </form>
    </div>
    <div class="mt-5">
        <div class="inline-flex items-center justify-between w-full">
            <h2 class="font-title font-bold text-lg">Adresse du client</h2>
            <button wire:click="$dispatch('openModal', {component: 'frontend.popups.profile.add-address'})" class="btn-slate">Ajouter une adresse</button>
        </div>
        @if($userAddresses->count() > 0)
            <div class="table-box-outline mt-5">
                <table>
                    <thead>
                    <tr>
                        <th>Par défaut</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userAddresses as $address)
                        <tr class="group">
                            <td>{!! $address->is_default ? '<i class="fa-solid fa-badge-check text-green-500"></i>' : '--' !!}</td>
                            <td>
                                <div>
                                    <p class="">{{ $address->address }}</p>
                                    <p class="text-sm text-slate-400">{{ $address->address_bis }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="">{{ $address->city }} ({{ $address->zip_code }})</p>
                                </div>
                            </td>
                            <td><button wire:click="deleteAddress({{ $address->id }})" class="group-hover:visible invisible text-red-500"><i class="fa-regular fa-delete-left"></i></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mt-3 text-slate-400">Vous n'avez pas encore enregistré d'adresse.</p>
        @endif
    </div>
</div>

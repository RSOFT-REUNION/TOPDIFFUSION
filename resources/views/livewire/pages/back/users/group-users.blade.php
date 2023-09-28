<div>
    <!-- Vue pour la création d'un groupe de clients -->

    <form wire:submit.prevent="createGroupUser">
        @csrf
        <div class="textfield">
            <label for="name">Nom de Groupe Utilisateurs <span class="text-red-500">*</span></label>
            <input type="text" id="name" wire:model="name" placeholder="Entrez un nom de groupe"
                class="@if ($errors->has('name')) input-error @endif" value="{{ old('name') }}">
        </div>

        {{-- ! CE QUI EST COMMENTE PAS BESOIN POUR LE MOMENT A LAISSE AU CAS OU --}}
        {{-- <div class="textfield mt-2">
            <label for="discount_percentage">Pourcentage de remise (%) <span class="text-red-500">*</span></label>
            <input type="text" wire:model="discount_percentage" id="discount_percentage"
                placeholder="Entrez une remise en pourcentage"
                class="@if ($errors->has('discount_percentage')) input-error @endif" pattern="[0-9]+(\.[0-9]+)?" min="0"
                max="90" value="{{ old('discount_percentage') }}" />
        </div> --}}
        {{-- <label for="isDefault">Groupe par défaut :</label>
        <input type="checkbox" wire:model="isDefault" id="isDefault"> --}}

        <div class="mt-4">
            <label>Sélectionnez les utilisateurs à ajouter au groupe :</label>
            <select id="userSelect" wire:model="selectedUsers" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" size="5">
                @foreach ($usersList as $user)
                    <option value="{{ $user->id }}">{{ $user->lastname }} {{ $user->firstname }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-10">
            <button type="submit" class="btn-secondary block w-full">Ajouter</button>
        </div>
    </form>

</div>

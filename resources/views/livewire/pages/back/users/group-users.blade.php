<div>
    <!-- Vue pour la création d'un groupe de clients -->
    <form wire:submit.prevent="createGroupUser">
        @csrf
        <div class="textfield">
            <label for="name">Nom de Groupe Utilisateurs <span class="text-red-500">*</span></label>
            <input required type="text" id="name" wire:model="name" placeholder="Entrez un nom de groupe" class="@if ($errors->has('name')) input-error @endif" value="{{ old('name') }}">
            @error('name')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="textfield mt-2">
            <label for="discount_percentage">Pourcentage de remise (%) <span class="text-red-500">*</span></label>
            <input type="text" wire:model="discount_percentage" id="discount_percentage"
                placeholder="Entrez une remise en pourcentage"
                class="@if ($errors->has('discount_percentage')) input-error @endif" pattern="[0-9]+(\.[0-9]+)?" min="0"
                max="90" required value="{{ old('discount_percentage') }}" />
            @error('discount_percentage')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="btn-check-line flex items-center mt-2">
            <div class="flex-1">
                <label for="is_default">Groupe par défaut :</label>
                <input type="checkbox" wire:model="is_default" id="is_default">
                <p>Si "Groupe par défaut" est coché toutes les catégories qui n'ont pas été configuré manuellement auront <span class="font-bold">{{ $discount_percentage }} %</span> de remise</p>
            </div>
        </div>
        <div class="mt-4">
            <label>Sélectionnez les utilisateurs à ajouter au groupe :</label>
            <div class="space-y-2">
                @foreach ($usersList as $user)
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="selectedUsers" value="{{ $user->id }}" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2">{{ $user->lastname }} {{ $user->firstname }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="mt-10">
            <button type="submit" class="btn-secondary block w-full">Ajouter</button>
        </div>
    </form>

    {{-- Affichage des groupes avec les remises --}}
    <div>
        @foreach ($discounts as $category)
{{--            {{ dd($category) }}--}}
            <div class="bg-red-700">
                <span>Catégorie : {{ $category['category_name'] }}</span>
            </div>
            @foreach ($userInfoFromGroup as $groupData)
                <div class="bg-red-700">
                    <span>Nom du groupe de clients : {{ $groupData['group_name'] }}</span>
                </div>
                @foreach ($groupData['users'] as $userData)
                    <div class="bg-yellow-500">
                        @if ($userData)
                            <span>ID de l'utilisateur : {{ $userData['user_id'] }}</span>
                            <br>
                            <span>Nom de l'utilisateur : {{ $userData['user_lastname'] }}</span>
                            <br>
                            <span>Prénom de l'utilisateur : {{ $userData['user_firstname'] }}</span>

                            {{-- Bouton pour détacher cet utilisateur de TOUS les groupes --}}
                            <button wire:click="detachUserFromGroup({{ $userData['user_id'] }}, {{ $category['group_id'] }})">Détacher de ce groupe</button>
                        @else
                            <span>Aucun utilisateur associé à ce groupe</span>
                        @endif
                    </div>
                @endforeach
                <br>
                <div class="bg-blue-500">
                    <span>Nom du groupe de clients : {{ $category['group_name'] }}</span>
                </div>
                <div class="bg-green-800">
                    <span>Pourcentage de remise : {{ $category['discount_percentage'] }} %</span>
                </div>
            @endforeach
            <br>
        @endforeach
    </div>
</div>

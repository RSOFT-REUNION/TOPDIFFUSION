<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2><i class="fa-solid fa-plus mr-3"></i>Ajouter un groupe</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <!-- Vue pour la création d'un groupe de clients -->

        <form wire:submit.prevent="createGroupUser">
            @csrf
            <div class="textfield">
                <label for="name">Nom du groupe d'utilisateurs <span class="text-red-500">*</span></label>
                <input type="text" id="name" wire:model="name" placeholder="Entrez un nom de groupe"
                       class="@if ($errors->has('name')) input-error @endif" value="{{ old('name') }}">
            </div>

            <div class="textfield mt-2">
                <label for="discount_percentage">Pourcentage de remise (%) <span class="text-red-500">*</span></label>
                <input type="text" wire:model="discount_percentage" id="discount_percentage"
                       placeholder="Entrez la remise pour ce groupe"
                       class="@if ($errors->has('discount_percentage')) input-error @endif" pattern="[0-9]+(\.[0-9]+)?" min="0"
                       max="90" required value="{{ old('discount_percentage') }}" />
                @error('discount_percentage')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="btn-check-line flex items-center mt-2">
                <div class="flex-1">
                    <label for="is_default">Remise par défaut :</label>
                    <input type="checkbox" wire:model="is_default" id="is_default">
                    <p>Si "Remise par défaut" est coché toutes les catégories qui n'ont pas été configuré manuellement auront <span class="font-bold">{{ $discount_percentage }} %</span> de remise.</p>
                </div>
            </div>

            <div class="mt-4">
                <label>Sélectionnez les utilisateurs à ajouter au groupe :</label>
                <div class="btn-check-line flex items-center mt-2">
                    <p>Les utilisateurs mis dans un groupe ne pourront pas être ajoutés à un autre groupe.</p>
                </div>
                <div class="space-y-2 mt-2">
                    @foreach ($usersList as $user)
                        <label class="inline-flex items-center">
                            <input id="userSelect" type="checkbox" wire:model="selectedUsers" value="{{ $user->id }}" class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2">{{ $user->lastname }} {{ $user->firstname }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Ajouter</button>
            </div>
        </form>

    </div>
    <script>
        const userSelect = document.getElementById('userSelect');

        userSelect.addEventListener('click', function(event) {
            const option = event.target;
            if (option.tagName === 'OPTION' && !option.selected) {
                option.selected = true;
            }
        });

        userSelect.addEventListener('dblclick', function(event) {
            const option = event.target;
            if (option.tagName === 'OPTION') {
                option.selected = false;
            }
        });
    </script>
</div>



<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2><i class="fa-solid fa-plus mr-3"></i>Ajouter d'un groupe</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">

        <form wire:submit.prevent="createGroupUser">
            @csrf
            <div class="textfield">
                <label for="name">Nom du groupe<span class="text-red-500">*</span></label>
                <input type="text" id="name" wire:model="name" placeholder="Entrez un nom de groupe" class="@if ($errors->has('name')) input-error @endif" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <p class="text-red-500 text-sm ml-2 mt-1">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="description">Description du groupe</label>
                <textarea id="description" wire:model="description" placeholder="Entrez une description du groupe" class="@if ($errors->has('name')) input-error @endif">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <p class="text-red-500 text-sm ml-2 mt-1">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <div class="textfield mt-2">
                <label for="discount_percentage">Pourcentage de remise (%) <span class="text-red-500">*</span></label>
                <input type="text" wire:model="discount_percentage" id="discount_percentage"
                       placeholder="Entrez la remise pour ce groupe"
                       class="@error('discount_percentage')) input-error @enderror" pattern="[0-9]+(\.[0-9]+)?" min="0"
                       max="90" required value="{{ old('discount_percentage') }}" />
                @error('discount_percentage')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                {{--<label>Sélectionnez les utilisateurs à ajouter au groupe :</label>
                <div class="btn-check-line flex items-center mt-2">
                    <p>Les utilisateurs mis dans un groupe ne pourront pas être ajoutés à un autre groupe sans être supprimé au préalable depuis le groupe.</p>
                </div>
                <div class="textfield-search items-center">
                    <label for="search"><i class="fa-solid fa-magnifying-glass mr-2 ml-2"></i></label>
                    <input id="search" type="text" wire:model="search" placeholder="Rechercher un nom, un prénom, un email..." class="focus:outline-none">
                </div>
                <div class="space-y-2 mt-2"><div class="table-box-outline mt-2">
                    <table>
                        <thead>
                        <tr class="text-center">
                            <th>Sélection</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($usersList as $user)
                            <tr>
                                <td>
                                    <label for="userSelect">
                                        <input id="userSelect" class="form-checkbox h-5 w-5 text-blue-600" type="checkbox" wire:model="selectedUsers" value="{{ $user->id }}" {{ $checkedUsers ? 'checked' : '' }}>
                                    </label>
                                </td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach

                        @if($usersList->isEmpty())
                            <tr>
                                <td colspan="4">Pas de résultat correspondant à <span class="text-red-500 font-bold">"{{ $search }}"</span></td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>--}}
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Ajouter</button>
            </div>
            </div>
        </form>
    </div>
</div>



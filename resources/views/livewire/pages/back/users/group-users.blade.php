<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Groupe Clients</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <a class="btn-secondary" wire:click="$emit('openModal', 'popups.back.users.add-groupe-users')">Ajouter un groupe</a>
        </div>
    <!-- Vue pour la création d'un groupe de clients  BRUNO-->
    {{-- <form wire:submit.prevent="createGroupUser">
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
    </form> --}}

    <div id="entry-content" class="flex flex-row gap-5 flex-wrap justify-center mt-10">
        @foreach ($groupUser as $index => $group)
            <div class="card-container bg-[#f0f0f0] rounded-lg relative p-2 h-[360px]" x-data="{ flipped: false }">
                <div class="card w-[300px] h-[300px]" :class="{ 'flipped': flipped }">
                    <div class="card-front absolute w-full]">
                        <div class="grid grid-cols-2 grid-rows-2 gap-1 w-[300px]">
                            <div class="object-cover rounded-md h-[120px] bg-secondary flex flex-row justify-center items-center text-4xl text-white">A</div>
                            <div class="object-cover rounded-md h-[120px] bg-secondary flex flex-row justify-center items-center text-4xl text-white">B</div>
                            <div class="object-cover rounded-md h-[120px] bg-secondary flex flex-row justify-center items-center text-4xl text-white">B</div>
                            <div class="object-cover rounded-md h-[120px] bg-secondary flex flex-row justify-center items-center text-4xl text-white">A</div>
                        </div>
                        <div class="border-t border-dashed mt-4 mb-3 px-4">
                            <div class="flex flex-row mt-3 justify-between">
                                <div class="flex flex-col">
                                    <div>
                                        <h2 class="font-bold text-xl">{{ $group->name }}</h2>
                                    </div>
                                    <div class="mt-2 flex flex-row items-center gap-x-3">
                                        <i class="fa-solid fa-circle-info text-gray-400"></i><h3 class="font-light text-sm text-gray-400">Remise de {{ $group->discount_percentage }}%</h3>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="bg-secondary px-3.5 py-2 rounded-full hover:bg-opacity-70 hover:shadow-slate-300 hover:drop-shadow-xl duration-500 hover:scale-105 cursor-pointer" wire:click.stop="startEditing({{ $group->id }})" @click="flipped = !flipped">
                                        <i class="fa-solid fa-plus text-2xl text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-back absolute w-full h-full" @click.stop style="backface-visibility: hidden; transform: rotateY(180deg);">
                        <div class="bg-[#f0f0f0] rounded-lg relative">
                            <div class="grid grid-cols-2 grid-rows-2 gap-1 w-[300px]">
                                <select id="userSelect" wire:model="selectedUsers" multiple class="w-full h-[200px] bg-gray-50 col-span-2 row-span-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" size="5">
                                    @foreach ($usersList as $user)
                                        <option value="{{ $user->id }}">{{ $user->lastname }} {{ $user->firstname }}</option>
                                    @endforeach
                                </select>
                                <button wire:click="stopEditing({{ $group->id }})" @click="flipped = false" class="bg-secondary w-full col-span-2 py-1.5 font-medium rounded-lg">Enregistrer</button>
                            </div>
                            <div class="border-t border-dashed mt-5 mb-3 px-4">
                                <div class="flex flex-row mt-4 justify-between">
                                    <div class="flex flex-col">
                                        <div>
                                            <input type="text" wire:model="name" value="{{ $name }}">
                                        </div>
                                        <div class="mt-2 flex flex-row items-center gap-x-3">
                                            <i class="fa-solid fa-circle-info text-gray-400"></i><h3 class="font-light text-sm text-gray-400">Remise de <input type="text" class="w-12"  wire:model="discount" value="{{ $discount }}">%</h3>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="bg-secondary px-3.5 py-2 rounded-full hover:bg-opacity-70 hover:shadow-slate-300 hover:drop-shadow-xl duration-500 hover:scale-105 cursor-pointer" @click="flipped = false">
                                            <i class="fa-solid fa-xmark text-2xl text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($index == 2 || $index == 4 || $index == 6 || $index == 8 || $index == 10) <!-- Après le troisième élément -->
                <div class="w-full border-t border-dashed my-5"></div>
            @endif
        @endforeach
    </div>
    @include('components.flash-messages')
    {{-- Affichage des groupes avec les remises BRUNO --}}
    {{-- <div>
        @foreach ($discounts as $category)
                   {{ dd($category) }}
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

                            Bouton pour détacher cet utilisateur de TOUS les groupes
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
    </div> --}}
</div>

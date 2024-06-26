<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Groupe Clients</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <a class="btn-secondary cursor-pointer" wire:click="$emit('openModal', 'popups.back.users.add-groupe-users')">Ajouter un groupe</a>
        </div>
    </div>
    @if($groupUser->isEmpty())
        <h1 class="flex justify-center font-bold">PAS DE GROUPE ENCORE CREE</h1>
    @else
    <div id="entry-content" class="flex flex-row gap-5 flex-wrap justify-center mt-10">
        @foreach ($groupUser as $index => $group)
            <div class="card-container bg-[#f0f0f0] rounded-lg relative p-2 h-[360px]" x-data="{ flipped: false }">
                <div class="card w-[300px] h-[300px]" :class="{ 'flipped': flipped }">
                    <div class="card-front absolute w-full]">
                        <div class="grid grid-cols-2 grid-rows-2 gap-1 w-[300px]">
                            @foreach ($group->users as $user)
                                @if (!empty($user->firstname))
                                    <div class="object-cover rounded-md h-[120px] bg-secondary flex flex-row justify-center items-center text-4xl text-white">{{ strtoupper(substr($user->firstname, 0, 1)) }}</div>
                                @endif
                            @endforeach
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
                                <ul class="w-full h-[200px] bg-gray-50 col-span-2 row-span-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 overflow-auto" size="5">
                                    <div class="btn-check-line flex items-center mt-2">
                                        <p class="ml-2 mr-2">Utilisateurs sans groupe.</p>
                                    </div>
                                    @foreach ($usersList as $user)
                                        <li class="flex items-center justify-between py-2">
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" wire:model="selectedUsers" value="{{ $user->id }}" class="form-checkbox h-5 w-5 text-blue-600">
                                                <span>{{ $user->firstname }} {{ $user->lastname }} ({{$user->customer_code}})</span>
                                            </label>
                                        </li>
                                    @endforeach
                                        <div class="btn-check-line flex items-center mt-2">
                                            <p class="ml-2 mr-2">Utilisateurs actuellement dans le groupe.</p>
                                        </div>
                                    @foreach ($usersWithRelation as $user)
                                        <li class="flex items-center justify-between py-2">
                                            <label class="flex items-center space-x-2">
                                                <span>{{ $user->firstname }} {{ $user->lastname }} ({{$user->customer_code}})</span>
                                            </label>
                                            <button wire:click.prevent="removeUserFromGroup({{ $user->id }})" class="text-red-600 hover:text-red-800 focus:outline-none">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>

                                <button wire:click="updateGroupUser({{ $group->id }})" @click="flipped = false" class="bg-secondary w-full col-span-2 py-1.5 font-medium rounded-lg">Enregistrer</button>
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
            @if (($index + 1) % 3 == 0) <!-- Après le troisième élément -->
                <div class="w-full border-t border-dashed my-5"></div>
            @endif
        @endforeach
    </div>
    @include('components.flash-messages')
    @endif
</div>

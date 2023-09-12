<div>
    <form wire:submit.prevent="create" enctype="multipart/form-data">
        <div id="entry-header" class="flex items-center">
            <div class="my-2 mr-7">
                <a onclick="window.history.back()" class="bg-secondary px-5 py-2 rounded-lg dark:bg-gray-700 cursor-pointer">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </a>
            </div>
            <div class="flex-1">
                <h1>Ajout d'une promotion</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <button type="submit" class="btn-secondary flex gap-x-4 items-center"><i class="fa-solid fa-square-plus text-lg"></i>Publier ma promotion</button>
            </div>
        </div>

        <div id="entry-content">
            <div class="grid grid-cols-3 mt-10 gap-x-7">
                <div class="col-span-2">
                    <div class="flex flex-col w-full mb-4 text-xl font-bold">
                        <input type="text" wire:model="percentage" min="0" max="95" id="title" class="py-4 px-4 rounded bg-[#f0f0f0]" placeholder="Entrez le nom de votre promotion">
                    </div>
                    <div class="flex flex-col w-full mb-4 relative">
                        <label for="title" class="my-1 mx-2">Type de remise<span class="text-red-500">*</span></label>
                        <select wire:model="" id="parent_category" class="py-2.5 px-4 rounded bg-[#f0f0f0] appearance-none" wire:click="" wire:change="">
                            <option value="0">-- Sélectionnez un type de remise --</option>
                            <option value="1">Remise par période</option>
                            <option value="2">Remise par code promo</option>
                        </select>
                        <div class=" absolute right-5 top-10 text-xl">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="title" class="my-1 mx-2">Pourcentage de remise<span class="text-red-500">*</span></label>
                        <input type="number" wire:model="percentage" min="0" max="95" id="title" class="py-2.5 px-4 rounded bg-[#f0f0f0]" placeholder="Entrez un pourcentage de remise">
                    </div>
                </div>
                <div>
                    <div class="bg-[#f0f0f0] h-full p-3 rounded-lg">
                        <div class="grid grid-cols-2 grid-rows-2 gap-1 w-full">
                            <img src="{{ asset('img/background/Group 46.png') }}" class="w-full" alt="">
                            <img src="{{ asset('img/background/Group 46.png') }}" class="w-full" alt="">
                            <img src="{{ asset('img/background/Group 46.png') }}" class="w-full" alt="">
                            <img src="{{ asset('img/background/Group 46.png') }}" class="w-full" alt="">
                        </div>
                        <div class="pl-3 pb-3">
                            <div class="flex flex-row mt-4 justify-between">
                                <div class="flex flex-col">
                                    <div>
                                        <h1 class="font-bold text-xl">titre de la card</h1>
                                    </div>
                                    <div class="mt-4 flex flex-row items-center gap-x-3">
                                        <i class="fa-solid fa-circle-info"></i><h1 class="font-light text-sm text-gray-400">Du 01/01 au 30/01</h1>
                                    </div>
                                </div>
                                <div class="pr-3 ">
                                    <label wire:click.stop for="state" class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="state" class="sr-only peer">
                                        <div class="w-11 h-6 bg-red-700 text-gray-300 peer peer-checked:bg-green-600 peer-checked:after:border-white peer-checked:after:translate-x-full peer-focus:outline-none rounded-full  after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div id="entry-content">
            @if($products->count() > 0)
                <div class="flex items-center gap-10">
                    <div class="flex w-3/6">
                        <div class="table-box-outline">
                            <table>
                                <thead>
                                <tr>
                                    <th><input id="checkbox" type="checkbox" value="" class="w-4 h-4 bg-yellow-900 border-[#FBBC34] rounded focus:ring-yellow-500"></th>
                                    <th>Nom</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><input id="checkbox" wire:model="checkedProducts.{{ $product->id }}" type="checkbox" value="" class="w-4 h-4 bg-yellow-900 border-[#FBBC34] rounded focus:ring-yellow-500"></td>
                                            <td>{{ $product->title }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex-1 justify-center items-center rounded h-full w-full">
                        <div class="">
                            <div class="flex flex-col w-full">
                                <label for="title" class="my-1 mx-2">Nom du groupe de la promotion<span class="text-red-500">*</span></label>
                                <input type="text" wire:model="title" id="title" class="py-2.5 px-4 rounded bg-[#f0f0f0]" placeholder="Entrez le nom de la promotion..">
                            </div>
                            <div class="flex flex-col w-full">
                                <label for="title" class="my-1 mx-2">Pourcentage de promotion<span class="text-red-500">*</span></label>
                                <input type="number" wire:model="percentage" min="0" max="95" id="title" class="py-2.5 px-4 rounded bg-[#f0f0f0]" placeholder="Entrez le pourcentage de la promotion..">
                            </div>
                            <div class="flex justify-center items-center h-full m-12">
                                <div class="flex flex-col w-[300px]">
                                    <div class="bg-[#f0f0f0] flex flex-col gap-4 h-[300px] shrink-0 items-center p-8 rounded-lg">
                                        <div class="bg-[#d9d9d9] flex flex-wrap self-stretch shrink-0 mb-2 ml-px rounded-lg">
                                            <div class="w-1/2 p-2">
                                                <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-1-hero.jpg') }}" alt="Description de l'image 1"/>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-1-hero.jpg') }}" alt="Description de l'image 2"/>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-1-hero.jpg') }}" alt="Description de l'image 3"/>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-1-hero.jpg') }}" alt="Description de l'image 4"/>
                                            </div>
                                        </div>
                                        <div class="whitespace-nowrap text-center font-semibold w-3/4">
                                            {{ $title }}
                                        </div>
                                        <div class="whitespace-nowrap text-xl font-semibold text-[#fbbc34] w-12">
                                            @if($percentage)
                                                {{ $percentage }}%
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <p class="empty-text mt-2">Vous n'avez pas encore article</p>
                @endif
            </div> --}}
    </form>
</div>

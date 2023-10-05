<div>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
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
                <a class="hover:bg-red-100 duration-500 ease-out px-4 py-3 rounded-full mr-7 cursor-pointer" wire:click="delete">
                    <i class="fa-solid fa-trash"></i>
                </a>
                <button type="submit" class="btn-secondary flex gap-x-4 items-center"><i class="fa-solid fa-square-plus text-lg"></i>Publier ma promotion</button>
            </div>
        </div>

        <div id="entry-content">
            <div class="grid grid-cols-4 mt-10 gap-x-7">
                <div class="col-span-3">
                    <div class="flex flex-col w-full mb-4">
                        <input type="text" wire:model="name_promo" min="0" max="95" id="title" class="py-4 px-4 rounded bg-[#f0f0f0] outline-secondary text-xl font-bold" placeholder="Entrez le nom de votre promotion">
                        @error('name_promo') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col w-full mb-4 relative">
                        <label for="title" class="my-1 mx-2">Type de remise<span class="text-red-500">*</span></label>
                        <select wire:model="mode" id="parent_category" class="py-2.5 px-4 rounded bg-[#f0f0f0] appearance-none outline-secondary" wire:click="" wire:change="">
                            <option value="0">-- Sélectionnez un type de remise --</option>
                            <option value="1">Remise par période</option>
                            <option value="2">Remise par code promo</option>
                        </select>
                        <div class=" absolute right-5 top-10 text-xl">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        @error('mode') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    @if ($mode == 1)
                        <div class="flex flex-rowl w-full gap-x-2 mb-4 relative">
                            <div class="flex flex-col w-full ">
                                <label for="dateDebut" class="my-1 mx-2">Date de début<span class="text-red-500">*</span></label>
                                <input type="date" wire:model="dateDebut" min="0" max="95" id="dateDebut" class="py-2.5 px-4 rounded w-full bg-[#f0f0f0] outline-secondary">
                                @error('dateDebut') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex flex-col w-full">
                                <label for="dateFin" class="my-1 mx-2">Date de fin<span class="text-red-500">*</span></label>
                                <input type="date" wire:model="dateFin" min="0" max="95" id="dateFin" class="py-2.5 px-4 rounded w-full bg-[#f0f0f0] outline-secondary">
                                @error('dateFin') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @elseif($mode == 2)
                        <div class="flex flex-col w-full mb-4 relative">
                            <label for="codePromo" class="my-1 mx-2">Code promo<span class="text-red-500">*</span></label>
                            <div class="rounded bg-[#f0f0f0] flex flex-row items-center" for="codePromo">
                                @if ($codePromoGen)
                                    <input type="text" wire:model="codePromoGen" min="0" max="95" id="codePromo" class="bg-[#f0f0f0] py-2.5 px-4 rounded w-full outline-secondary" placeholder="Générer votre code de promo">
                                @else
                                    <input type="text" wire:model="codePromo" min="0" max="95" id="codePromo" class="bg-[#f0f0f0] py-2.5 px-4 rounded w-full outline-secondary" placeholder="Générer votre code de promo">
                                @endif
                                <a wire:click="generatePromoCode" class="bg-secondary rounded h-1/2 mr-1 py-1.5 px-7 cursor-pointer">Générer</a>
                            </div>
                            @error('codePromoGen') <span class="text-red-500">{{ $message }}</span> @enderror
                            @error('codePromo') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    <div class="flex flex-col w-full">
                        <label for="title" class="my-1 mx-2">Pourcentage de remise<span class="text-red-500">*</span></label>
                        <input type="number" wire:model="percentage" min="0" max="95" id="title" class="py-2.5 px-4 rounded bg-[#f0f0f0] outline-secondary" placeholder="Entrez un pourcentage de remise">
                        @error('percentage') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="bg-[#f0f0f0] rounded-lg relative">
                    <div class="bg-secondary absolute z-10 py-1.5 w-1/4 flex flex-row items-center justify-center rounded-tr rounded-br top-5 font-bold">
                        @if ($percentage)
                            <h2>{{ $percentage }} %</h2>
                        @else
                            <div class="bg-gray-600 animate-pulse h-2 w-2/3 rounded my-2"></div>
                        @endif
                    </div>
                    <div class="grid grid-cols-2 grid-rows-2 gap-1 p-2">
                        @if ($products)
                            @foreach ($products as $key => $index)
                                @if ($key <= 3)
                                    <img class="h-[150px] w-full rounded" src="{{ asset('storage/images/products/'. $index['cover']) }}" alt="logo">
                                @endif
                            @endforeach
                        @else
                            <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                            <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                            <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                            <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                        @endif
                    </div>
                    <div class="pl-3 pb-3">
                        <div class="flex flex-row mt-2 justify-between p-2">
                            <div class="flex flex-col w-full">
                                <div>
                                    @if ($name_promo)
                                        <h1 class="font-bold text-xl">{{ $name_promo }}</h1>
                                    @else
                                        <div class="bg-gray-600 animate-pulse h-2 w-2/3 rounded"></div>
                                    @endif
                                </div>
                                <div class="mt-5 flex flex-row items-center gap-x-3">
                                    @if ($mode == 1 && $dateDebut || $dateFin)
                                        <i class="fa-solid fa-circle-info text-gray-400"></i>
                                        <h1 class="font-light text-sm text-gray-400">Du @if ($dateDebut) {{ $this->formatDate($this->dateDebut) }}  @endif au {{ $this->formatDate($this->dateFin) }}</h1>
                                    @elseif ($mode == 2 && ($codePromo || $codePromoGen))
                                        <i class="fa-solid fa-circle-info text-gray-400"></i>
                                        <h1 class="font-light text-sm text-gray-400">@if($codePromo) {{ $codePromo }} @elseif($codePromoGen) {{ $codePromoGen }} @endif</h1>
                                    @else
                                        <i class="fa-solid fa-circle-info text-gray-400"></i>
                                        <div class="bg-gray-400 animate-pulse h-2 w-1/3 rounded"></div>
                                    @endif
                                </div>
                            </div>
                            <div class="pr-3 mt-1">
                                <label class="relative inline-flex items-center mr-5 cursor-pointer" wire:click="activePromo">
                                    <input type="checkbox" value="" class="sr-only" @if($active) checked @endif wire:model="active"> <!-- Ajout du wire:model pour la synchronisation -->
                                    <div class="{{ $active ? 'bg-green-600' : 'bg-red-600' }} w-11 h-6 rounded-full transition-all">
                                        <div class="{{ $active ? 'translate-x-full bg-white' : 'translate-x-0 bg-gray-400' }} absolute top-0.5 left-[2px] w-5 h-5 rounded-full transition-transform"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-10 text-[#EFEFEF]">

        <div class="mt-10">
            <div  class="flex items-center">
                <div class="flex-1 text-xl font-bold">
                    <h1>Articles</h1>
                </div>
                <div class="flex-none inline-flex items-center">
                    <a wire:click="$emit('openModal', 'popups.back.products.tab-article')" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter un article</a>
                </div>
            </div>
            <div class="grid grid-cols-4 auto-rows-auto gap-2 w-full h-full flex-wrap mt-7">
                @if ($products)
                    @foreach ($products as $index => $articles)
                        <div class="h-[22vh] relative group shadow rounded-lg">
                            <img class="rounded-lg h-[22vh] hover:bg-black hover:drop-shadow-xl" src="{{ asset('storage/images/products/'. $articles['cover']) }}" alt="Description de l'image 1"/>
                            <div class="flex flex-row justify-center items-end w-full h-full bg-black absolute top-0 rounded-lg opacity-0 group-hover:opacity-100 visibility-hidden group-hover:visibility-visible transition-opacity duration-300 shadow" style="background: rgb(2,0,36);
                            background: linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(255,255,255,0) 100%);" wire:click="deleteProduct({{$articles['id']}})"><i class="fa-solid fa-trash text-white mb-5 cursor-pointer"></i></div>
                            <h2 class="px-4 text-xl">{{ $articles['title'] }}</h2>
                        </div>
                    @endforeach
                @endif
            </div>
                @if(!$products)
                    <div class="w-full flex flex-row justify-center items-center bg-gray-100 py-4 rounded-lg">
                        Pas d'article dans la promotion
                    </div>
                @endif
        </div>
    </form>
</div>

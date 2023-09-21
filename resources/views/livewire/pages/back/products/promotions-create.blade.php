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
            <div class="grid grid-cols-4 mt-10 gap-x-7">
                <div class="col-span-3">
                    <div class="flex flex-col w-full mb-4 text-xl font-bold">
                        <input type="text" wire:model="name_promo" min="0" max="95" id="title" class="py-4 px-4 rounded bg-[#f0f0f0] outline-secondary" placeholder="Entrez le nom de votre promotion">
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
                    </div>
                    @if ($mode == 1)
                        <div class="flex flex-rowl w-full gap-2 mb-4 relative">
                            <div class="flex flex-col w-full gap-2">
                                <label for="dateDebut" class="my-1 mx-2">Date de début<span class="text-red-500">*</span></label>
                                <input type="date" wire:model="dateDebut" min="0" max="95" id="dateDebut" class="py-2.5 px-4 rounded w-full bg-[#f0f0f0] outline-secondary">
                            </div>
                            <div class="flex flex-col w-full gap-2">
                                <label for="dateFin" class="my-1 mx-2">Date de fin<span class="text-red-500">*</span></label>
                                <input type="date" wire:model="dateFin" min="0" max="95" id="dateFin" class="py-2.5 px-4 rounded w-full bg-[#f0f0f0] outline-secondary">
                            </div>
                        </div>
                    @elseif($mode == 2)
                        <div class="flex flex-col w-full relative">
                            <label for="codePromo" class="my-1 mx-2">Code promo<span class="text-red-500">*</span></label>
                            <div class="rounded bg-[#f0f0f0] flex flex-row items-center" for="codePromo">
                                @if ($codePromoGen)
                                    <input type="text" wire:model="codePromoGen" min="0" max="95" id="codePromo" class="bg-[#f0f0f0] py-2.5 px-4 rounded w-full outline-secondary" placeholder="Générer votre code de promo">
                                @else
                                    <input type="text" wire:model="codePromo" min="0" max="95" id="codePromo" class="bg-[#f0f0f0] py-2.5 px-4 rounded w-full outline-secondary" placeholder="Générer votre code de promo">
                                @endif
                                <a wire:click="generatePromoCode" class="bg-secondary rounded h-1/2 mr-1 py-1.5 px-7 cursor-pointer">Générer</a>
                            </div>
                        </div>
                    @endif
                    <div class="flex flex-col w-full">
                        <label for="title" class="my-1 mx-2">Pourcentage de remise<span class="text-red-500">*</span></label>
                        <input type="number" wire:model="percentage" min="0" max="95" id="title" class="py-2.5 px-4 rounded bg-[#f0f0f0] outline-secondary" placeholder="Entrez un pourcentage de remise">
                    </div>
                </div>
                <div class="bg-[#f0f0f0] rounded-lg relative">
                    <div class="bg-secondary absolute z-10 py-1.5 w-1/4 flex flex-row items-center justify-center rounded-tr rounded-br top-5 font-bold">
                        @if ($percentage)
                            <h2>{{ $percentage }} %</h2>
                        @else
                            <div class="bg-gray-600 animate-pulse h-2 w-2/3 rounded my-2"></div>
                            <style>
                            @keyframes pulse {
                                0%, 100% {
                                    opacity: 1;
                                }
                                50% {
                                    opacity: 0.4;
                                }
                            }
                            </style>
                        @endif
                    </div>
                    <div class="grid grid-cols-2 grid-rows-2 gap-1 p-2">
                        <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                        <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                        <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                        <img class="animate-pulse h-[150px] w-full rounded" src="{{ asset('img/background/Group 46.png') }}" alt="logo">
                        <style>
                        @keyframes pulse {
                            0%, 100% {
                                opacity: 1;
                            }
                            50% {
                                opacity: 0.4;
                            }
                        }
                        </style>
                    </div>
                    <div class="pl-3 pb-3">
                        <div class="flex flex-row mt-2 justify-between p-2">
                            <div class="flex flex-col w-full">
                                <div>
                                    @if ($name_promo)
                                        <h1 class="font-bold text-xl">{{ $name_promo }}</h1>
                                    @else
                                        <div class="bg-gray-600 animate-pulse h-2 w-2/3 rounded"></div>
                                        <style>
                                        @keyframes pulse {
                                            0%, 100% {
                                                opacity: 1;
                                            }
                                            50% {
                                                opacity: 0.4;
                                            }
                                        }
                                        </style>
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
                                        <style>
                                        @keyframes pulse {
                                            0%, 100% {
                                                opacity: 1;
                                            }
                                            50% {
                                                opacity: 0.4;
                                            }
                                        }
                                        </style>
                                    @endif
                                </div>
                            </div>
                            <div class="pr-3">
                                <label class="relative inline-flex items-center mr-5 cursor-pointer text-gray-200">
                                    <input type="checkbox" value="" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-700 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
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
            <div class="grid grid-cols-4 auto-rows-auto gap-2 w-full h-full flex-wrap">
                {{-- @if ($product_selected)
                    @foreach ($product_selected as $index =>$articles)
                        <div class="h-[22vh] relative group shadow rounded-lg">
                            <img class="rounded-lg h-[22vh] hover:bg-black hover:drop-shadow-xl" src="{{ asset('storage/images/products/'. $articles[$index]->cover) }}" alt="Description de l'image 1"/>
                            <div class="flex flex-row justify-center items-end w-full h-full bg-black absolute top-0 rounded-lg opacity-0 group-hover:opacity-100 visibility-hidden group-hover:visibility-visible transition-opacity duration-300 shadow" style="background: rgb(2,0,36);
                            background: linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(255,255,255,0) 100%);"><i class="fa-solid fa-trash text-white mb-5 cursor-pointer"></i></div>
                            <h2 class="px-4 text-xl">{{ $articles->title }}</h2>
                        </div>
                    @endforeach
                @else
                        pas d'article dans la promotion
                @endif --}}
                <a wire:click="btn">test</a>
                {{-- <div class="h-[22vh] relative group shadow rounded-lg">
                    <img class="rounded-lg h-[22vh] hover:bg-black hover:drop-shadow-xl" src="{{ asset('storage/medias/main-carousel-img2.jpg') }}" alt="Description de l'image 1"/>
                    <div class="flex flex-row justify-center items-end w-full h-full bg-black absolute top-0 rounded-lg opacity-0 group-hover:opacity-100 visibility-hidden group-hover:visibility-visible transition-opacity duration-300 shadow" style="background: rgb(2,0,36);
                    background: linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(255,255,255,0) 100%);"><i class="fa-solid fa-trash text-white mb-5 cursor-pointer"></i></div>
                    <h2 class="px-4 text-xl">Produit 1</h2>
                </div> --}}
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

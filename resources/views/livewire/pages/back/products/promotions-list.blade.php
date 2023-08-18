<div>
    <div>
        <div id="entry-header" class="flex items-center">
            <div class="flex-1">
                <h1>Promotion</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <a href="" class="btn-icon mr-2"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="" class="btn-icon mr-2"><i class="fa-solid fa-file-import"></i></a>
                <a href="{{ route('back.product.promotions-create') }}" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter une promotion</a>
            </div>
        </div>
        <div id="entry-content" class="flex flex-row gap-10">
            @if($productsPromotion)
            @foreach ($productsPromotion as $item)
                <button class="cursor-pointer" wire:click="GoToPromoSingle({{ $item->id }})">
                    <div class="flex flex-col w-[300px] hover:shadow-slate-300 hover:drop-shadow-xl hover:duration-500 hover:scale-105">
                        <div class="bg-[#f0f0f0] flex flex-col gap-4 h-full shrink-0 items-center p-8 rounded-lg">
                            <div class="bg-[#d9d9d9] flex flex-wrap self-stretch shrink-0 mb-2 ml-px rounded-lg">
                                <div class="w-1/2 p-2">
                                    <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-1-hero.jpg') }}" alt="Description de l'image 1"/>
                                </div>
                                <div class="w-1/2 p-2">
                                    <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-2-hero.jpg') }}" alt="Description de l'image 2"/>
                                </div>
                                <div class="w-1/2 p-2">
                                    <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-2-hero.jpg') }}" alt="Description de l'image 3"/>
                                </div>
                                <div class="w-1/2 p-2">
                                    <img class="object-cover w-full rounded-lg" src="{{ asset('img/medias/slide-1-hero.jpg') }}" alt="Description de l'image 4"/>
                                </div>
                            </div>
                            <div class="whitespace-nowrap text-center font-semibold w-3/4">
                                {{ $item->title }}
                            </div>
                            <div class="whitespace-nowrap text-center font-semibold w-3/4">
                                <span class="text-red-700">{{ $item->end_date }}Date limite</span>
                            </div>
                            <label wire:click.stop for="state-{{ $item->id }}" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="state-{{ $item->id }}" class="sr-only peer">
                                <div class="w-11 h-6 bg-red-700 peer @if($item->active) peer-checked:bg-green-600 peer-checked:after:border-white peer-checked:after:translate-x-full @endif peer-focus:outline-none rounded-full  after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600"></div>
                            </label>
                            <div class="whitespace-nowrap text-xl font-semibold text-[#fbbc34] w-12">
                                {{ $item->discount }} %
                            </div>
                        </div>
                    </div>
                </button>
            @endforeach
                {{-- <button class="cursor-pointer" wire:click="GoToPromoSingle">
                    <div class="flex flex-col w-[300px] hover:shadow-slate-300 hover:drop-shadow-xl hover:duration-500 hover:scale-105">
                        <div class="bg-[#f0f0f0] flex flex-col gap-4 h-full shrink-0 items-center p-8 rounded-lg">
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
                                Nom de la promotions
                            </div>
                            <div class="whitespace-nowrap text-center font-semibold w-3/4">
                                <span class="text-red-700">Date limite</span>
                            </div>
                            <label for="state" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="state" class="sr-only peer">
                                <div class="w-11 h-6 bg-red-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                            </label>
                            <div class="whitespace-nowrap text-xl font-semibold text-[#fbbc34] w-12">
                                20 %
                            </div>
                        </div>
                    </div>
                </button> --}}
            @else
                <p class="empty-text mt-2">Vous n'avez pas encore de promotion</p>
            @endif
        </div>
    </div>
</div>

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
                <div class="flex flex-col w-[300px] cursor-pointer hover:shadow-slate-300 hover:drop-shadow-xl hover:duration-500 hover:scale-105">
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
                            {{ $item->promotion_group }}
                        </div>
                        <div class="whitespace-nowrap text-xl font-semibold text-[#fbbc34] w-12">
                            {{ $item->promotion }} %
                        </div>
                    </div>
                </div>
            @endforeach

                <div class="flex flex-col w-[300px] cursor-pointer hover:shadow-slate-300 hover:drop-shadow-xl hover:duration-500 hover:scale-105">
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
                            Nom de la promotions
                        </div>
                        <div class="whitespace-nowrap text-xl font-semibold text-[#fbbc34] w-12">
                            20 %
                        </div>
                    </div>
                </div>
            @else
                <p class="empty-text mt-2">Vous n'avez pas encore de promotion</p>
            @endif
        </div>
    </div>

</div>

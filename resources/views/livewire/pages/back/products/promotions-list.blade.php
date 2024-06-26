<div>
    <div>
        <div id="entry-header" class="flex items-center">
            <div class="flex-1">
                <h1>Promotion</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <a href="" class="btn-icon mr-2"><i class="fa-solid fa-magnifying-glass"></i></a>
                {{-- <a href="" class="btn-icon mr-2"><i class="fa-solid fa-file-import"></i></a> --}}
                <a href="{{ route('back.product.promotions-create') }}" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter une promotion</a>
            </div>
        </div>
        <div id="entry-content" class="flex flex-row gap-5 flex-wrap justify-center mt-10">
            @if($productsPromotion)
                @foreach ($productsPromotion as $index => $promo)
                    <a class="bg-[#f0f0f0] rounded-lg hover:shadow-slate-300 duration-300 hover:scale-105 relative cursor-pointer" href="{{ route("back.product.promotions-update", ['id' => $promo->id]) }}">
                        <div class="bg-secondary absolute py-1.5 w-1/4 flex flex-row items-center justify-center rounded-tr rounded-br top-5 font-bold">
                            <h2>{{ $promo->discount }} %</h2>
                        </div>
                        <div class="grid grid-cols-2 grid-rows-2 gap-1 w-[300px] p-2">
                            @foreach ($promo->products as $index => $product)
                                @if ($index < 4)
                                    <img class="object-cover rounded-md h-[120px]" src="{{ asset('storage/images/products/' . $product->cover) }}" alt="Image du produit en promotion"/>
                                @endif
                            @endforeach
                        </div>
                        <div class="pl-3 pb-3">
                            <div class="flex flex-row mt-2 justify-between">
                                <div class="flex flex-col">
                                    <div>
                                        <h1 class="font-bold text-xl">{{ $promo->title }}</h1>
                                    </div>
                                    <div class="mt-2 flex flex-row items-center gap-x-3">
                                        <i class="fa-solid fa-circle-info text-gray-400"></i><h1 wire:click="items({{ $promo->id }})" class="font-light text-sm text-gray-400">
                                            @if ($promo->code)
                                                {{ $promo->code }}
                                            @elseif($promo->start_date && $promo->end_date)
                                                {{ $this->formatDate($promo->start_date )}} au {{ $this->formatDate($promo->end_date )}}
                                            @endif
                                        </h1>
                                    </div>
                                </div>
                                <div class="pr-3 mt-1.5">
                                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" wire:click="changeActive({{ $promo->id }})" value="" class="sr-only" @if($promo->active) checked @endif>
                                        <div class="{{ $promo->active ? 'bg-green-600' : 'bg-red-600' }} w-11 h-6 rounded-full transition-all">
                                            <div class="{{ $promo->active ? 'translate-x-full bg-white' : 'translate-x-0 bg-gray-400' }} absolute top-0.5 left-[2px] w-5 h-5 rounded-full transition-transform"></div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </a>
                    @if (($index + 1) % 4 == 0) <!-- Après le troisième élément -->
                        <div class="w-full border-t border-dashed my-5"></div>
                    @endif
                @endforeach
            @else
                <p class="empty-text mt-2">Vous n'avez pas encore de promotions</p>
            @endif
        </div>
    </div>
</div>

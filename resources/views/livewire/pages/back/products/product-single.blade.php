<div class="ml-[300px] p-5">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3">
                    <a href="{{ route('back.product.list') }}" class="bg-slate-100 py-2 px-3 rounded-md duration-300 border border-transparent hover:border-slate-200"><i class="fa-solid fa-arrow-left"></i></a>
                    <h1 class="text-2xl font-bold">{{ $product->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="entry-content">
        <div class="flex gap-2">
            <div class="flex-1">
                <div class="force-center">
                    <div class="w-1/2">
                        <img src="{{ asset('storage/images/products/'. $product->cover) }}">
                    </div>
                </div>
                <div class="mt-3">
                    <div class="bg-secondary flex items-center gap-2">
                        <div class="flex-1">

                        </div>
                        <div class="flex-none">

                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="border-2 border-slate-100 rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h2 class="font-bold text-xl">Informations sur le produit</h2>
                                <form wire:submit.prevent="" class="mt-5">
                                    @csrf
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1">
                                            <div class="textfield">
                                                <label for="title">Nom du produit</label>
                                                <input type="text" id="title" wire:model="title" placeholder="Entrez le titre du produit" value="{{ $product->title }}">
                                                @error('title')
                                                <p class="text-sm text-red-500 ml-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="textfield mt-2">
                                                <label for="short_description">Description courte</label>
                                                <textarea id="short_description" wire:model="short_description" placeholder="Entrez une description courte">{{ $product->short_description }}</textarea>
                                                @error('short_description')
                                                <p class="text-sm text-red-500 ml-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="textfield">
                                                <label for="slug">Slug du produit</label>
                                                <input type="text" id="slug" wire:model="slug" placeholder="Entrez le slug du produit" value="{{ $product->slug }}">
                                                @error('slug')
                                                <p class="text-sm text-red-500 ml-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="textfield mt-2">
                                                <label for="long_description">Description longue</label>
                                                <textarea id="long_description" wire:model="long_description" placeholder="Entrez une description longue">{{ $product->long_description }}</textarea>
                                                @error('long_description')
                                                <p class="text-sm text-red-500 ml-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="flex-none">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-none w-[300px]">
                <div class="bg-secondary rounded-xl p-3">
                    <div class="flex items-baseline">
                        <div class="flex-1">
                            <p class="">Tarif (HT)</p>
                        </div>
                        <div class="flex-none">
                            <h2 class="text-3xl font-bold">{{ number_format($product->getPriceHT(), '2', ',', ' ') }} €</h2>
                        </div>
                    </div>
                    <div class="bg-white py-2 px-3 text-slate-400 rounded-md mt-3">
                        <div class="flex items-baseline">
                            <div class="flex-1">
                                <p class="">Quantité en stock</p>
                            </div>
                            <div class="flex-none">
                                <h2 class="text-3xl font-bold">{{ $product_stock->quantity }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="block w-full bg-red-100 text-red-500 mt-2 py-2 rounded-md duration-300 hover:bg-red-500 hover:text-white">Désactiver mon produit</button>
            </div>
        </div>
    </div>
</div>

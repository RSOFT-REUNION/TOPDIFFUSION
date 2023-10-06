<div>
    <form wire:submit.prevent="createProduct" enctype="multipart/form-data">
        @csrf
        <div id="entry-header" class="flex items-center">
            <div class="my-2 mr-7">
                <a onclick="window.history.back()" class="bg-secondary px-5 py-2 rounded-lg dark:bg-gray-700 cursor-pointer">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </a>
            </div>
            <div class="flex-1">
                <h1>Ajout d'un produit</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <button type="submit" class="btn-secondary">Créer l'article<i class="fa-solid fa-floppy-disk ml-3"></i></button>
            </div>
        </div>

        {{-- Nom de l'article --}}
        <div class="textfield">
            <input type="text" id="title" wire:model="title" placeholder="Entrez le nom du produit" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
            @if($errors->has('title'))
                <p class="text-error">{{ $errors->first('title') }}</p>
            @endif
        </div>
        <p class="bg-gray-100 text-sm px-2 py-1 rounded-md mt-2 text-gray-500">Affichage dans l'url: @if($this->title) <b><input class="rounded border border-gray-600 pl-2" wire:model="slug" type="text"></b> @else Entrez le nom du produit.. @endif</p>
    </form>

    <div class="entry-content">
        {{-- Affichage des différentes sections --}}
        <div class="mt-7">
            {{-- Liste des menus --}}
            <ul class="inline-flex">
                <li><a wire:click="changeTab('1')" class="@if($tab === '1') bg-primary border border-transparent text-white @else bg-gray-100 text-gray-600 border border-transparent hover:border-gray-200 @endif px-10 py-3 rounded-md font-bold cursor-pointer duration-300">Informations</a></li>
                <li><a wire:click="changeTab('2')" class="ml-2 @if($type) @if($tab === '2') bg-primary border border-transparent text-white @else bg-gray-100 text-gray-600 border border-transparent hover:border-gray-200 @endif px-10 py-3 rounded-md font-bold cursor-pointer duration-300 @else border border-gray-200 text-gray-400 px-10 py-3 rounded-md italic @endif">@if(!$type) Type de produit @elseif($type == 1) Produit simple @elseif($type == 2) Produit variable @elseif($type == 3) Kit chaine @elseif($type == 4) Pneus @endif</a></li>
                <li><a wire:click="changeTab('3')" class="ml-2 @if($tab === '3') bg-primary border border-transparent text-white @else bg-gray-100 text-gray-600 border border-transparent hover:border-gray-200 @endif px-10 py-3 rounded-md font-bold cursor-pointer duration-300">Informations supplémentaire</a></li>
                <li><a wire:click="changeTab('4')" class="ml-2 @if($tab === '4') bg-primary border border-transparent text-white @else bg-gray-100 text-gray-600 border border-transparent hover:border-gray-200 @endif px-10 py-3 rounded-md font-bold cursor-pointer duration-300">Motos compatible</a></li>
                <li><a wire:click="changeTab('5')" class="ml-2 @if($tab === '5') bg-primary border border-transparent text-white @else bg-gray-100 text-gray-600 border border-transparent hover:border-gray-200 @endif px-10 py-3 rounded-md font-bold cursor-pointer duration-300">Photos</a></li>
            </ul>

            {{-- INFORMATIONS --}}
            @if($tab === '1')
                <div class="mt-5 border-2 border-gray-100 p-5 rounded-lg">
                    @include('livewire.pages.back.products.product-add.partials.partial_information')
                </div>
            @endif

            {{-- TYPES --}}
            @if($tab === '2')
                <div class="mt-5 border-2 border-gray-100 p-5 rounded-lg">
                    @include('livewire.pages.back.products.product-add.partials.partial_type')
                </div>
            @endif

            {{-- INFO SUPP --}}
            @if($tab === '3')
                <div class="mt-5 border-2 border-gray-100 p-5 rounded-lg">
                    @include('livewire.pages.back.products.product-add.partials.partial_infosupp')
                </div>
            @endif

            {{-- MOTOS --}}
            @if($tab === '4')
                <div class="mt-5 border-2 border-gray-100 p-5 rounded-lg">
                    @include('livewire.pages.back.products.product-add.partials.partial_bikes')
                </div>
            @endif

            {{-- PHOTOS --}}
            @if($tab === '5')
                <div class="mt-5 border-2 border-gray-100 p-5 rounded-lg">
                    @include('livewire.pages.back.products.product-add.partials.partial_pictures')
                </div>
            @endif
        </div>
    </div>
</div>

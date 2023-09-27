<div class="container mx-auto" x-data="{ open: false }">
    <div class="arianne my-4 inline-flex items-center">
        @livewire('components.breadcrumb', ['crumbs' => $crumbs])
    </div>
    <div class="entry-header mt-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>{{ $category->title }}</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                @if($products->count() > 0)
                    <a @click="open = !open" class="btn-secondary cursor-pointer">
                        <i class="fa-solid fa-filter mr-3"></i>Filtrer
                    </a>
                    <p class="text-tag-count ml-2">{{ $products->count() }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="content pb-10">
        @if($products->count() > 0)
            <div class="grid grid-cols-3 gap-10 mt-10">
                @foreach($products as $product)
                    @livewire('components.front.products.product-thumbnails', ['product_id' => $product->id])
                @endforeach
            </div>
            <div class="mt-5">
                {{ $products->links() }}
            </div>
        @else
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="force-center">
                        <object data="{{ asset('img/icons/Empty-amico.svg') }}" width="400px"></object>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="subtitle">Cette catégorie semble vide..</h2>
                    <p class="text-gray-500 mt-3">N'hésitez pas à nous contacter si vous souhaitez plus d'informations ou à parcourir nos autres catégories</p>
                </div>
            </div>
        @endif
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="transform opacity-0 -translate-x-full"
         x-transition:enter-end="transform opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="transform opacity-100 translate-x-0"
         x-transition:leave-end="transform opacity-0 -translate-x-full"
         class="rounded-md w-96 p-7 absolute top-1/2 transform left-10 -translate-y-1/2 grp">

         <div class="bg-gray-100 rounded-md w-96 p-7 absolute top-1/2 transform left-10 -translate-y-1/2 grp">
            <h2 class="font-bold text-2xl mb-7">Filtre</h2>
            <div>
                <div class="flex flex-row items-center justify-between">
                    <h3 class="font-medium">Categories</h3>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <div class="border-l ml-1 pl-5 mt-5 py-2">
                    <div class="flex flex-col gap-y-6">
                        <a class="flex justify-between cursor-pointer">Categories<span>41</span></a>
                        <a class="flex justify-between cursor-pointer">Categories<span>41</span></a>
                        <a class="flex justify-between cursor-pointer">Categories<span>41</span></a>
                    </div>
                </div>
            </div>
            <div class="mt-7">
                <div class="flex flex-row items-center justify-between">
                    <h3 class="font-medium">Couleurs</h3>
                    <i class="fa-solid fa-caret-left"></i>
                </div>
            </div>
            <div class="mt-7">
                <div class="flex flex-row items-center justify-between">
                    <h3 class="font-medium">Taille</h3>
                    <i class="fa-solid fa-caret-left"></i>
                </div>
            </div>
            <div class="mt-7">
                <div class="flex flex-row items-center justify-between">
                    <h3 class="font-medium">Prix</h3>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <div class="border-l ml-1 pl-5 mt-5 py-2">
                    <div class="flex flex-col gap-y-6">
                        <div class="flex flex-col justify-center gap-y-3">
                            <div class="flex flex-row gap-x-3">
                                <input type="radio" class="bg-secondary text-secondary" name="croissant" id="croissant">
                                <label for="croissant">Croissant</label>
                            </div>
                            <div class="flex flex-row gap-x-3">
                                <input type="radio" name="decroissant" id="decroissant">
                                <label for="decroissant">Décroissant</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

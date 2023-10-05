<div>
    <div class="flex-none inline-flex items-center w-full">
        <a href="" class="btn-icon mr-2 ml-4"><i class="fa-solid fa-magnifying-glass"></i></a>
        @if ($search)
            <button wire:click="clear" class="px-3">
                <i class="fa-solid fa-times text-red-500"></i>
            </button>
        @endif
        <input wire:model.debounce.100ms="search" type="text" placeholder="Rechercher un produit..." class="bg-transparent py-5 outline-none border-none duration-300 hover:tracking-wider dark:border-none w-full">
        <div class="flex-none mr-4">
            <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
        </div>
    </div>
    <hr class="text-gray-200">

    <div class="mt-7 px-5 pb-5">
        @if($products->count() > 0)
            <div>
                <div class="min-w-full bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sélectionner
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $product)
                                <tr>
                                    <td class="px-6 py-6 whitespace-nowrap flex justify-center items-center">
                                        <input type="checkbox" wire:model="selectedProducts" value="{{ $product->id }}" class="text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ in_array($product->id, $selectedProducts) ? 'checked' : '' }}>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $product->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $product->title }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
                <div class="flex mt-10">
                <nav class="flex flex-row items-center justify-center w-full">
                    @if ($products->onFirstPage())
                        <span aria-disabled="true" wire:click.prevent="setPage({{ $products->currentPage() - 1 }})">
                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-300 rounded-l-lg bg-white border border-gray-300 cursor-default leading-5"><i class="fa-solid fa-angle-left"></i></span>
                        </span>
                    @else
                        <span aria-disabled="true" wire:click.prevent="setPage({{ $products->currentPage() - 1 }})">
                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-700 bg-white rounded-l-lg border border-gray-300 cursor-pointer leading-5 hover:text-black hover:bg-secondary "><i class="fa-solid fa-angle-left"></i></span>
                        </span>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span aria-current="page">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-300 bg-white border border-gray-300 cursor-default leading-5">{{ $page }}</span>
                            </span>
                        @else
                            <a wire:click.prevent="setPage({{ $page }})" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-black hover:bg-secondary focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 cursor-pointer">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($products->hasMorePages())
                        <span aria-disabled="true" wire:click.prevent="setPage({{ $products->currentPage() + 1 }})">
                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-700 bg-white rounded-r-lg border border-gray-300 cursor-pointer leading-5 hover:text-black hover:bg-secondary "><i class="fa-solid fa-angle-right"></i></span>
                        </span>
                    @else
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-300 bg-white rounded-r-lg  border border-gray-300 cursor-default leading-5"><i class="fa-solid fa-angle-right"></i></span>
                        </span>
                    @endif
                </nav>
                @if ($selectedProducts)
                    <div class="w-10 bg-secondary flex justify-center items-center rounded-md">{{ count($selectedProducts) }}</div>
            @endif
            </div>
                @endif
            <div class="mt-10">
                <a wire:click="btn" class="btn-secondary w-full flex justify-center items-center">Ajouter</a>
            </div>
        @else
            <p class="empty-text mt-2">Vous n'avez pas encore ajouté d'article</p>
        @endif
    </div>
</div>

<div>
    <form wire:submit.prevent="create" enctype="multipart/form-data">
        <div id="entry-header" class="flex items-center">
            <div class="flex-1">
                <h1>Ajout d'une promotion</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <button type="submit" class="btn-secondary">Publier ma promotion</button>
            </div>
        </div>
        <div id="entry-content">
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
                                    {{-- <button wire:click='test'></button> --}}
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
            </div>
    </form>
</div>

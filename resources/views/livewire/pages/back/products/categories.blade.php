<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Catégories</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            {{-- * Import CSV à travaillé plus tard --}}
            {{-- <a wire:click="$emit('openModal', 'popups.back.products.import-categories')" class="btn-icon mr-2 cursor-pointer"><i class="fa-solid fa-file-import"></i></a> --}}
            @if($userSetting->product_categories_show == 1)
                <a wire:click="changeShow" class="btn-icon mr-2 cursor-pointer" title="Affichage sous forme de tableaux"><i class="fa-solid fa-table"></i></a>
            @else
                <a wire:click="changeShow" class="btn-icon mr-2 cursor-pointer" title="Affichage sous forme de liste"><i class="fa-solid fa-list"></i></a>
            @endif
            <a wire:click="$emit('openModal', 'pages.back.products.popup-add-category')" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter une catégorie</a>
            @if($categories->count() > 0)
                <p class="ml-2 text-tag-count">{{ $categories->count() }}</p>
            @endif
        </div>
    </div>
    <div id="entry-content">
        @if($categories->count() > 0)
            @if($userSetting->product_categories_show == 1)
                <ul>
                @foreach($categories_1 as $cat1)
                    <li class="@if($cat1->level === 2) ml-5 border-l-2 border-amber-400 pl-3 @elseif($cat1->level === 3) ml-10 border-l-2 border-gray-400 pl-3 @endif">
                        <div class="category-container">
                            <div class="category-content">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-400"><b>Niveau {{ $cat1->level }}</b> | {{ $cat1->slug }} </p>
                                    @if($cat1->delivery)
                                        <span class="bg-[#FBBC34] px-2 rounded-md text-black border font-semibold border-[#D9D9D9]">{{ $cat1->delivery }} %</span>
                                    @endif
                                </div>
                                <h2>{{ $cat1->title }}</h2>
                            </div>
                        </div>
                    </li>
                    @foreach($categories_2 as $cat2)
                        @if($cat2->parent_id == $cat1->id)
                            <li class="@if($cat2->level === 2) ml-5 border-l-2 border-amber-400 pl-3 @elseif($cat2->level === 3) ml-10 border-l-2 border-gray-400 pl-3 @endif">
                                <div class="category-container">
                                    <div class="category-content">
                                        <div class="inline-flex items-center">
                                            <p class="text-sm text-gray-400"><b>Niveau {{ $cat2->level }}</b> | {{ $cat2->slug }} </p>
                                        </div>
                                        <h2>{{ $cat2->title }}</h2>
                                    </div>
                                </div>
                            </li>
                            @foreach($categories_3 as $cat3)
                                @if($cat3->parent_id == $cat2->id)
                                    <li class="@if($cat3->level === 2) ml-5 border-l-2 border-amber-400 pl-3 @elseif($cat3->level === 3) ml-10 border-l-2 border-gray-400 pl-3 @endif">
                                        <div class="category-container">
                                            <div class="category-content">
                                                <div class="inline-flex items-center">
                                                    <p class="text-sm text-gray-400"><b>Niveau {{ $cat3->level }}</b> | {{ $cat3->slug }} </p>
                                                </div>
                                                <h2>{{ $cat3->title }}</h2>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        @endif

                    @endforeach
                @endforeach
            </ul>
            @else
                <div class="table-box-outline">
                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Slug</th>
                            <th>Niveau</th>
                            <th>Cat. parent</th>
                            <th>Nb. articles</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories_table as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->title }}</td>
                                <td>{{ $cat->slug }}</td>
                                <td>{{ $cat->level }}</td>
                                <td>@if($cat->parent_id == null) -- @else {{ $cat->getParentCategory()->title }} @endif</td>
                                <td>{{ $cat->getProductsCount() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {{ $categories_table->links() }}
                </div>
            @endif
        @else
            <p class="empty-text">Vous n'avez pas encore ajouté de catégories</p>
        @endif
    </div>
</div>

<div>
    {{-- <div class="inline-flex items-center" x-data="{ open: @entangle('active_tab') }" x-on:click.away="open = ''">
        @foreach($menus as $menu)
            <a wire:click="@if($tab != $menu->id) changeTab({{ $menu->id }}) @else changeTab('') @endif" class="btn-menu-level-1 @if($tab == $menu->id) btn-menu-level-1_active @endif">{{ $menu->title }}@if($menu->hasSubCategory()->count() > 0 ) @if($tab == $menu->id) <i class="ml-2 fa-solid fa-chevron-up"></i> @else <i class="ml-2 fa-solid fa-chevron-down"></i> @endif @endif</a>
        @endforeach
    </div>
    @if($tab && $menus_level_2->count() > 0)
        <div class="menu-mega">
            <div class="menu-mega-container">
                <div class="grid grid-cols-4 gap-10">
                    @foreach($menus_level_2 as $mem)
                        @if($mem->parent_id === $tab)
                            <div class="menu-mega-categories">
                                <h2><a href="{{ route('front.product.list', ['slug' => $mem->slug]) }}">{{ $mem->title }}</a></h2>
                                <ul class="mt-3">
                                    @foreach($menus_level_3 as $mem3)
                                        @if($mem3->parent_id === $mem->id)
                                            <li><a href="{{ route('front.product.list', ['slug' => $mem3->slug]) }}">{{ $mem3->title }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif --}}

    {{-- <div class="relative inline-flex items-center w-full">
        @foreach($menus as $menu)
            <div class="py-3 group" x-data="{ isOpen: false }"
                 @mouseenter="isOpen = true"
                 @mouseleave="isOpen = false"
                 :class="{ 'bg-white text-black': isOpen }">

                <a href="#" class="btn-menu-level-1">
                    {{ $menu->title }}
                </a>

                <div x-show="isOpen"
                     x-cloak
                     x-transition:enter="transition-all ease-in-out duration-700"
                     x-transition:enter-start="opacity-0 max-h-0 overflow-y-hidden"
                     x-transition:enter-end="opacity-100 max-h-[1000px] overflow-y-auto"
                     x-transition:leave="transition-all ease-in-out duration-300"
                     x-transition:leave-start="opacity-100 max-h-[1000px] overflow-y-auto"
                     x-transition:leave-end="opacity-0 max-h-0 overflow-y-hidden"
                     class="absolute left-0 z-10 grid w-full grid-flow-row-dense grid-cols-1 gap-4 mt-2 text-black bg-white rounded-bl-lg rounded-br-lg shadow-2xl md:grid-cols-4 max-h-96">

                    @foreach($menus_level_2 as $mem)
                        @if($mem->parent_id === $menu->id)
                            <div class="px-4 menu-mega-categories">
                                <h2 class="my-5 font-bold hover:text-secondary">
                                    <a href="{{ route('front.product.list', ['slug' => $mem->slug]) }}">{{ $mem->title }}</a>
                                </h2>
                                @foreach($menus_level_3 as $mem3)
                                    @if($mem3->parent_id === $mem->id)
                                        <ul class="px-4 py-2 my-5 hover:bg-gray-200">
                                            <li><a href="{{ route('front.product.list', ['slug' => $mem3->slug]) }}">{{ $mem3->title }}</a></li>
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div> --}}

    <div class="relative inline-flex items-center w-full">
        @foreach($menus as $menu)
            <div class="py-3 group" x-data="{ isOpen: false, subMenuOpenIndex: null }"
                 @mouseenter="isOpen = true"
                 @mouseleave="isOpen = false"
                 :class="{ 'bg-white text-black': isOpen }">

                <a href="#" class="btn-menu-level-1">
                    {{ $menu->title }}
                </a>

                <div x-show="isOpen"
                    x-cloak
                    x-transition:enter="transition-all ease-in-out duration-700"
                    x-transition:enter-start="opacity-0 max-h-0 overflow-y-hidden"
                    x-transition:enter-end="opacity-100 max-h-[1000px] overflow-y-auto"
                    x-transition:leave="transition-all ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 max-h-[1000px] overflow-y-auto"
                    x-transition:leave-end="opacity-0 max-h-0 overflow-y-hidden"
                    class="absolute left-0 z-10 flex flex-col w-full gap-4 p-4 mt-2 text-black bg-white rounded-bl-lg rounded-br-lg shadow-2xl max-h-96">

                    @foreach($menus_level_2 as $index => $mem)
                        @if($mem->parent_id === $menu->id)
                            <div class="flex flex-col w-1/5 px-4 overflow-hidden outline-none menu-mega-categories group"
                            @mouseenter="subMenuOpenIndex = {{ $index }}"
                            @mouseleave="subMenuOpenIndex = null">
                                <h2 class="my-0 font-bold hover:text-secondary"
                                    @if ($index != $index)
                                        @mouseenter="{{'subMenuOpen'.$index}} = false"
                                    @endif
                                    @mouseenter="{{'subMenuOpen'.$index}} = true"
                                    >
                                    {{-- @mouseleave="subMenuOpen = false"> --}}
                                    <a href="{{ route('front.product.list', ['slug' => $mem->slug]) }}">{{ $mem->title }}</a>
                                </h2>

                                <!-- Sous-menu -->
                                <div
                                x-cloak
                                x-show="subMenuOpenIndex === {{ $index }}"
                                x-transition:enter="transition-all ease-in-out duration-700"
                                x-transition:enter-start="opacity-0 max-h-0 overflow-y-hidden"
                                x-transition:enter-end="opacity-100 max-h-[1000px] overflow-y-auto"
                                x-transition:leave="transition-all ease-in-out duration-300"
                                x-transition:leave-start="opacity-100 max-h-[1000px] overflow-y-auto"
                                x-transition:leave-end="opacity-0 max-h-0 overflow-y-hidden"
                                @mouseleave="{{'subMenuOpen'.$index}} = false"
                                class="absolute top-[15px] left-[300px] h-56 flex flex-wrap flex-col bg-white text-black z-10 rounded-lg">
                                @if ($index) <!-- Après le troisième élément -->
                                    <div class="absolute h-full border-l border-dashed"></div>
                                @endif
                                    <!-- Contenu du sous-menu -->
                                    @foreach($menus_level_3 as $mem3)
                                        @if($mem3->parent_id === $mem->id)
                                            <ul class="ml-20">
                                                <li><a class="flex flex-col px-4 py-2 hover:bg-gray-200" href="{{ route('front.product.list', ['slug' => $mem3->slug]) }}">{{ $mem3->title }}</a></li>
                                            </ul>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>


</div>


{{-- grid grid-flow-row-dense grid-cols-1 md:grid-cols-4 --}}
{{-- @if ($index == 2 || $index == 4 || $index == 6 || $index == 8 || $index == 10) <!-- Après le troisième élément -->
                <div class="w-full my-5 border-t border-dashed"></div>
            @endif --}}

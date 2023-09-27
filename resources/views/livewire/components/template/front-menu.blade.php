<div>
    {{-- <div class="inline-flex items-center" x-data="{ open: @entangle('active_tab') }" x-on:click.away="open = ''">
        @foreach($menus as $menu)
            <a wire:click="@if($tab != $menu->id) changeTab({{ $menu->id }}) @else changeTab('') @endif" class="btn-menu-level-1 @if($tab == $menu->id) btn-menu-level-1_active @endif">{{ $menu->title }}@if($menu->hasSubCategory()->count() > 0 ) @if($tab == $menu->id) <i class="fa-solid fa-chevron-up ml-2"></i> @else <i class="fa-solid fa-chevron-down ml-2"></i> @endif @endif</a>
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
    {{-- <div class="inline-flex items-center">
        @foreach($menus as $menu)
        <div class="group relative py-3">
            <a wire:click="@if($tab != $menu->id) changeTab({{ $menu->id }}) @else changeTab('') @endif" class="btn-menu-level-1 @if($tab == $menu->id) btn-menu-level-1_active @endif">{{ $menu->title }}@if($menu->hasSubCategory()->count() > 0 ) @if($tab == $menu->id) <i class="fa-solid fa-chevron-up ml-2"></i> @else <i class="fa-solid fa-chevron-down ml-2"></i> @endif @endif</a>
                <div class="absolute left-0 mt-2 w-full bg-white text-black opacity-0 group-hover:opacity-100 transition z-10">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 3</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 3</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 3</a>
                </div>
        </div>
        @endforeach
    </div> --}}
    {{-- <div class="inline-flex items-center">
        @foreach($menus as $menu)
            <div class="group relative py-3">
                <a href="#" class="btn-menu-level-1">
                    {{ $menu->title }}
                    @if($menu->hasSubCategory()->count() > 0 )
                        <i class="fa-solid fa-chevron-down ml-2"></i>
                    @endif
                </a>
                <div class="absolute left-0 mt-2 w-full bg-white text-black transform scale-y-0 group-hover:scale-y-100 origin-top transition-transform z-10">
                    @foreach($menus_level_2 as $mem)
                        @if($mem->parent_id === $menu->id)
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
        @endforeach
    </div> --}}

    <div class="inline-flex items-center w-full">
        @foreach($menus as $menu)
            <div class="group relative w-full py-3">
                <a href="#" class="btn-menu-level-1">
                    {{ $menu->title }}
                    @if($menu->hasSubCategory()->count() > 0 )
                        <i class="fa-solid fa-chevron-down ml-2"></i>
                    @endif
                </a>
                <div class="absolute left-0 mt-2 flex h-96 flex-col flex-wrap  w-full bg-white text-black transform scale-y-0 group-hover:scale-y-100 origin-top transition-transform z-10 shadow-2xl rounded-br-lg rounded-bl-lg">
                    {{-- <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 3</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 3</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 3</a> --}}
                    @foreach($menus_level_2 as $mem)
                        @if($mem->parent_id === $menu->id)
                            <div class="menu-mega-categories px-4">
                                <h2 class="font-bold my-5 hover:text-secondary"><a href="{{ route('front.product.list', ['slug' => $mem->slug]) }}">{{ $mem->title }}</a></h2>
                                    @foreach($menus_level_3 as $mem3)
                                        @if($mem3->parent_id === $mem->id)
                                            <ul class="my-5 px-4 py-2 hover:bg-gray-200">
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
    </div>



</div>
{{-- @push('scripts')
    <script>
        document.addEventListener('click', function(event) {
            @this.set('active_tab', '');
        });
    </script>
@endpush --}}

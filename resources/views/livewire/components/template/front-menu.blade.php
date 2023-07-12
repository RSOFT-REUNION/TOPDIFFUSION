<div>
    <div class="inline-flex items-center">
        @foreach($menus as $menu)
            <a wire:click="@if($tab != $menu->id) changeTab({{ $menu->id }}) @else changeTab('') @endif" class="btn-menu-level-1 @if($tab == $menu->id) btn-menu-level-1_active @endif">{{ $menu->title }}@if($menu->hasSubCategory()->count() > 0 ) <i class="fa-solid fa-chevron-down ml-2"></i> @endif</a>
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
    @endif

</div>

<a href="{{ $route }}" class="@if($page == $myPage) btn-sidebar-active @else btn-sidebar @endif {{ $class }}" title="{{ $label }}">
    <div><i class="fa-regular fa-{{ $icon }} mr-3"></i>{{ $label }}</div>
    @if($count > 0)
        <span class="text-sm border rounded-full py-1 px-2">{{ $count }}</span>
    @endif
</a>

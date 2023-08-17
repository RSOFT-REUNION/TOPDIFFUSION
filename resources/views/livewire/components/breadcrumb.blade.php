<div class="flex space-x-2 text-sm text-gray-600">
    @foreach($crumbs as $index => $crumb)
        @if ($index == count($crumbs) - 1)
            <span>{{ $crumb['label'] }}</span>
        @else
            <a href="{{ $crumb['url'] }}" class="text-blue-400 hover:text-blue-500">{{ $crumb['label'] }}</a>
            <span class="text-gray-400">/</span>
        @endif
    @endforeach
</div>

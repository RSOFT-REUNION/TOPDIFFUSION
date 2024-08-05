<div class="container mx-auto my-10">
    <div class="inline-flex items-center justify-between w-full border-b pb-4">
        <div class="inline-flex items-center gap-5 ">
            <span class="border rounded-full py-1 px-2">{{ count($products) }}</span>
            <div>
                <h1 class="font-title font-bold text-xl">Produits associés</h1>
                <h3 class="text-slate-400">{{ $bike->brand }} {{ $bike->model }} ({{$bike->cylinder}}) - {{ $bike->year }}</h3>
            </div>
        </div>
        <div class="inline-flex items-center gap-5 ">
            <button wire:click="$dispatch('openModal', {component: 'frontend.popups.products.kit-chain', arguments: { bike: {{ $bike->id }} }})" class="btn-slate inline-flex items-center gap-3"><img src="{{ asset('img/icons/chain.svg') }}" width="24px">Kits chaines compatible</button>
        </div>
    </div>
    @if(count($products) > 0)
        <div class="mt-5 grid grid-cols-4 gap-5">
            @foreach($products as $product)
                @livewire('frontend.components.products.thumbnails', ['product' => $product])
            @endforeach
        </div>
    @else
        <p class="py-5 text-center text-slate-400">Aucun produit n'est référencé pour cette moto</p>
    @endif
</div>

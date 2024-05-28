<div wire:click="goToView" class="duration-300 hover:scale-105 hover:drop-shadow-lg cursor-pointer">
    <div class="bg-slate-100 aspect-square rounded-xl overflow-hidden">
        @if($product->cover)
            <img src="{{ asset('storage/products/covers/'. $product->cover) }}" alt="{{ $product->slug }}" class="object-cover w-full h-full p-10">
        @else
            <div class="flex h-full">
                <div class="m-auto">
                    <i class="fa-solid fa-image-slash fa-3x text-slate-300"></i>
                </div>
            </div>
        @endif
    </div>
    <div class="mt-3 mx-3 relative">
        <p class="font-bold text-lg">{{ $product->name }}</p>
        @if(auth()->check())
            @if(auth()->user()->settings()->public_price == 0)
            <p class="font-title font-bold text-2xl text-primary">{{ number_format($product->getUnitPrice(), 2, ',', ' ') }} €</p>
            @else
                <div class="inline-flex items-center gap-4">
                    <p class="font-title font-bold text-2xl text-primary">{{ number_format($product->getUnitPrice(), 2, ',', ' ') }} €</p>
                    <span class="text-sm text-slate-400 border py-1 px-2 rounded-full bg-slate-100">{{ auth()->user()->group()->discount }}%</span>
                </div>
                <div class="mt-2 border-t p-2">
                    <div class="inline-flex items-center w-full justify-between *:text-sm *:text-slate-400">
                        <p class="">Prix public conseillé:</p>
                        <p class="font-title">{{ number_format($product->getUnitPriceWithoutDiscount(), 2, ',', ' ') }} €</p>
                    </div>
                </div>
            @endif
        @else
            <p class="font-title font-bold text-2xl text-primary">{{ number_format($product->getUnitPrice(), 2, ',', ' ') }} €</p>
        @endif
        <button type="button" class="absolute top-0 bottom-0 right-3" title="Ajouter aux favoris" aria-label="Ajouter aux favoris"><i class="fa-regular fa-heart"></i></button>
    </div>
</div>

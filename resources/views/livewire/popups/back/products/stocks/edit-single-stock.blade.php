<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Stocks de l'article</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>

    <div class="entry-content">
        <form wire:submit.prevent="">
            @csrf
            @foreach($swatches as $swatch)
                <div class="flex items-center gap-2 mb-2">
                    <div class="flex-1">
                        <div class="grid @if($product->type == 1) grid-cols-1 @else grid-cols-3 @endif">
                            <div class="border-r border-slate-200">
                                <p class="text-slate-400">Référence UGS</p>
                                @if($product->type != 1)
                                    <p class="">{{ $swatch->ugs }}-{{ $swatch->ugs_swatch }}</p>
                                @else
                                    <p class="font-bold">{{ $swatch->ugs }}</p>
                                @endif
                            </div>
                            @if($product->type != 1)
                                <div class="border-r border-slate-200 pl-2">
                                    <p class="text-slate-400">Quantité en stock</p>
                                    <p class="">{{ $swatch->getSwatchStockQuantity() }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-none">
                        <div class="textfield-line">
                            <input type="number" placeholder="Ajouter une quantité en stock" wire:model="updateQuantities.{{ $swatch->id }}" value="">
                            <button type="submit" class=""><i class="fa-solid fa-floppy-disk"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
</div>

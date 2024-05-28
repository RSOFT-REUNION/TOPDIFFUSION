<div>
    <x-templates.header-popup label="Ajout d'un produit" icon=""/>
    <div class="p-5">
        <form wire:submit.prevent="addProduct">
            @csrf
            <p class="text-slate-400">L'ajout de produit se déroule en plusieurs étapes. Merci de suivre correctement chacune d'entre elles afin de configurer votre produit.</p>
            <h2 class="mt-3 font-bold text-md font-title">Sélectionner votre type de produit</h2>
            <div class="grid grid-cols-2 gap-5 mt-5">
                <label for="simple">
                    <input type="radio" id="simple" name="type" wire:model.live="type" value="simple" hidden>
                    <div class="border p-5 force-center gap-5 rounded-xl duration-300 cursor-pointer @if($type == 'simple') bg-primary hover:bg-primary/30 @else hover:bg-slate-100 @endif">
                        <img src="{{ asset('img/icons/produit_simple.svg') }}" width="60px">
                        <div>
                            <span>Produit simple</span>
                            <p class="text-sm text-slate-600">Ex: Disque de frein, Feux...</p>
                        </div>
                    </div>
                </label>
                <label for="variable">
                    <input type="radio" id="variable" name="type" wire:model.live="type" value="variable" hidden>
                    <div class="border p-5 force-center gap-5 rounded-xl duration-300 cursor-pointer @if($type == 'variable') bg-primary hover:bg-primary/30 @else hover:bg-slate-100 @endif">
                        <img src="{{ asset('img/icons/variant_product.svg') }}" width="60px">
                        <div>
                            <span>Produit décliné</span>
                            <p class="text-sm text-slate-600">Ex: Casques, vêtements...</p>
                        </div>
                    </div>
                </label>
                {{--<label for="tire" class="col-span-2">
                    <input type="radio" id="tire" name="type" wire:model.live="type" value="tire" hidden>
                    <div class="border p-5 force-center gap-5 rounded-xl duration-300 cursor-pointer @if($type == 'tire') bg-primary hover:bg-primary/30 @else hover:bg-slate-100 @endif">
                        <img src="{{ asset('img/icons/tire.svg') }}" width="60px">
                        <div>
                            <span>Pneumatique</span>
                            <p class="text-sm text-slate-600">Ex: Pneus avant...</p>
                        </div>
                    </div>
                </label>--}}
            </div>
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Continuer" icon="arrow-right"/>
        </form>
    </div>
</div>

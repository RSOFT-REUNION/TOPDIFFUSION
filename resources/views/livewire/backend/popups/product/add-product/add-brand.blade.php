<div>
    <x-templates.header-popup label="Sélectionner une marque de produit" icon=""/>
    <form wire:submit.prevent="selectBrand">
        @csrf
        <div class="p-5">
            <x-elements.inputs.textfield type="text" label="Rechercher une marque" name="search" class="" livewire="yes" require="" placeholder="Entrez le nom d'une marque"/>
            <div class="mt-5 grid grid-cols-5 gap-5">
                @foreach($brands as $brand)
                    <label for="{{ $brand->slug }}">
                        <input type="radio" id="{{ $brand->slug }}" wire:model.live="brand_select" name="brand_select" value="{{ $brand->slug }}" hidden>
                        <div class="bg-slate-100 rounded-xl border p-5 relative cursor-pointer @if($brand_select == $brand->slug) border-primary @endif flex flex-col h-full duration-300 hover:bg-white hover:scale-105">
                            <div class="m-auto">
                                <div class="force-center">
                                    <img src="{{ asset('storage/products/brands/'. $brand->logo) }}" width="150px">
                                </div>
                                <p class="text-center mt-3">{{ $brand->name }}</p>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="p-5 text-right border-t inline-flex items-center justify-between w-full">
            <p>
                @if($brand_select)
                    Marque sélectionné : <span class="uppercase font-bold">{{ $brand_select }}</span>
                @endif
            </p>
            <x-elements.buttons.btn-submit class="" label="Sélectionner" icon="arrow-right"/>
        </div>
    </form>
</div>

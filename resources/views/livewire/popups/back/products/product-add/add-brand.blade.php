<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Marques</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

    </div>
    <form wire:submit.prevent="addBrand" class="p-5">
        @csrf
        <div class="grid grid-cols-5 gap-5">
            @foreach($brands as $brand)
                <div>
                    <label for="brand-{{ $brand->id }}">
                        <div class="flex border border-gray-100 py-5 justify-center items-center rounded-md h-[100px] hover:bg-gray-100 cursor-pointer duration-300 @if($brand_check == $brand->id) border-primary @endif">
                            <img src="{{ asset('storage/images/brands/'. $brand->picture) }}" width="100px">
                        </div>
                    </label>
                    <input type="radio" wire:model="brand_check" value="{{ $brand->id }}" id="brand-{{ $brand->id }}" class="hidden">
                    <p class="text-center text-sm text-gray-500 mt-2">{{ $brand->title }}</p>
                </div>
            @endforeach
        </div>
        @if($brand_check)
            <div class="mt-5">
                <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300">Définir</button>
            </div>
        @endif
    </form>
</div>

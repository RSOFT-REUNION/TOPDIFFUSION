<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Catégories</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="addCategory" class="p-5">
        @csrf
        <div class="textfield">
            <label for="category">Catégorie<span class="text-red-500">*</span></label>
            <select wire:model="category" id="category">
                <option value="">-- Sélectionner une catégorie --</option>

                @foreach($categories_level_1 as $category1)
                    <optgroup label="{{ $category1->title }}">
                        @foreach($categories_level_2 as $category2)
                            @if($category2->parent_id === $category1->id)
                                <option value="{{ $category2->id }}">{{ $category2->title }}</option>

                                @foreach($categories_level_3 as $category3)
                                    @if($category3->parent_id === $category2->id)
                                        <option value="{{ $category3->id }}">— {{ $category3->title }}</option>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </optgroup>
                @endforeach
            </select>

        @if($errors->has('parent_category'))
                <p class="text-error">{{ $errors->first('parent_category') }}</p>
            @endif
        </div>
        <div class="mt-5">
            <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300">Définir</button>
        </div>
    </form>
</div>

<form wire:submit.prevent="addType">
    @csrf
    @if($temp_product->type === 1 || $type === 1)
        {{-- Il s'agit d'un produit simple --}}
        @include('livewire.pages.back.products.product-add.partials.partials_type_1')
    @elseif($temp_product->type === 2 || $type === 2)
        {{-- Il s'agit d'un produit variable --}}
        @include('livewire.pages.back.products.product-add.partials.partials_type_2')
    @elseif($temp_product->type === 3 || $type === 3)
        {{-- Il s'agit d'un kit chaine --}}
        @include('livewire.pages.back.products.product-add.partials.partials_type_3')
    @elseif($temp_product->type === 4 || $type === 4)
        {{-- Il s'agit d'un pneu --}}
        @include('livewire.pages.back.products.product-add.partials.partials_type_4')
    @endif
</form>

<div class="inline-flex items-center justify-between w-full px-5 py-3 bg-secondary text-white">
    <div class="inline-flex items-center gap-3">
        @if($icon)
            <i class="fa-solid fa-{{ $icon }}"></i>
        @endif
        <h2 class="font-title font-bold text-xl">{{ $label }}</h2>
    </div>
    <button wire:click="$dispatch('closeModal')" class="py-2 px-4 hover:bg-red-100 hover:text-red-500 rounded-full" title="Fermer"><i class="fa-solid fa-xmark"></i></button>
</div>

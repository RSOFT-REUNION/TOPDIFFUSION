<div class="container-resume-cart container mx-auto" id="cart_resume">
    <div class="container-resume-cart-content bg-white drop-shadow-2xl mt-2 rounded-lg px-5 py-3">
        <div class="flex items-center border-b border-gray-100 pb-2">
            <div class="flex-1">
                <h2 class="text-2xl font-bold">Mon panier</h2>
            </div>
            <div class="flex-none">
                <button type="button" onclick="window.location.href=('{{ route('front.cart') }}')" class="btn-outline">Voir mon panier<i class="fa-solid fa-arrow-right ml-2"></i></button>
            </div>
        </div>
        <div class="mt-3">
            @livewire('components.front.cart-resume')
        </div>
    </div>
</div>

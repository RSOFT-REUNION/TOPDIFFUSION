<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Livraison</h1>
        </div>
    </div>
    <div id="entry-content">
        <p class="bg-red-100 border border-red-200 text-red-500 px-5 py-2 rounded-md">
            Vous devez noter que les frais de livraison ne sont pas applicables pour les professionnels
        </p>
        <div class="container-box-page mt-5">
            <div class="entry-header">
                <h2>Configuration de la livraison</h2>
            </div>
            <div class="entry-content">
                <div class="flex flex-row justify-between items-center border-b border-gray-200 pb-4 mt-4">
                    <div>
                        <h2>Frais de port et d'emballage</h2>
                        <p class="text-[13px] text-[#808080]">Vous pouvez définir un montant pour les frais de port et l'emballage des produits.</p>
                    </div>
                    <form wire:submit.prevent="updateShippingPrice" class="inline-flex items-center">
                        @csrf
                        <div class="">
                            <input type="number" step="0.1" wire:model="shipping_price" placeholder="Entrez un montant" class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                        </div>
                        @if($setting->shipping_price != $shipping_price)
                            <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>
                </div>

                <div class="flex flex-row justify-between items-center border-b border-gray-200 pb-4 mt-4">
                    <div>
                        <h2>Montant maximum pour une livraison payante</h2>
                        <p class="text-[13px] text-[#808080]">Vous pouvez définir un montant maximum pour qu'une commande ait le droit à la livraison gratuite</p>
                    </div>
                    <form wire:submit.prevent="updateShippingLimit" class="inline-flex items-center">
                        @csrf
                        <div class="">
                            <input type="number" step="0.1" wire:model="shipping_limit" placeholder="Entrez un montant" class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                        </div>
                        @if($setting->shipping_limit != $shipping_limit)
                            <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <p class="text-[13px] text-[#808080]">Vous pouvez définir un montant pour les frais de port et
                            l'emballage des produits.</p>
                    </div>
                    <form wire:submit.prevent="updateShippingPrice" class="inline-flex items-center">
                        @csrf
                        <div class="">
                            <input type="number" step="0.1" wire:model="shipping_price"
                                placeholder="Entrez un montant"
                                class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                        </div>
                        @if ($setting->shipping_price != $shipping_price)
                            <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i
                                    class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>
                </div>

                <div class="flex flex-row justify-between items-center border-b border-gray-200 pb-4 mt-4">
                    <div>
                        <h2>Montant maximum pour une livraison payante</h2>
                        <p class="text-[13px] text-[#808080]">Vous pouvez définir un montant maximum pour qu'une
                            commande ait le droit à la livraison gratuite</p>
                    </div>
                    <form wire:submit.prevent="updateShippingLimit" class="inline-flex items-center">
                        @csrf
                        <div class="">
                            <input type="number" step="0.1" wire:model="shipping_limit"
                                placeholder="Entrez un montant"
                                class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                        </div>
                        @if ($setting->shipping_limit != $shipping_limit)
                            <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i
                                    class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- Formulaire d'ajout de point relais --}}
<div class="flex flex-col bg-secondary border-primary text-primary w-full rounded-[8px] mt-4 p-4 duration-500">
    <h2 class="text-2xl font-bold mb-3">Ajout d'un Point Relais</h2>

    <div class="flex items-center mb-3">
        <label for="nameRelayPoint" class="mr-2">Nom du point relais</label>
        <input wire:model="nameRelayPoint" type="text" id="nameRelayPoint" placeholder="La poste" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>

    <div class="flex items-center mb-3">
        <label for="adressRelayPoint" class="mr-2">Adresse du point relais</label>
        <input wire:model="adressRelayPoint" type="text" id="adressRelayPoint" placeholder="108 Rue des Bons Enfants" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>

    <div class="mb-3">
        <label for="openingHours">Heures d'ouverture</label>
        <textarea wire:model='openingHours' name="openingHours" id="openingHours" cols="30" rows="7" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            Lundi : 09h00 - 10h00
            Mardi : 09h00 - 17h00
            Mercredi : 09h00 - 17h00
            Jeudi : 09h00 - 17h00
            Vendredi : 09h00 - 17h00
            Samedi : 09h00 - 12h00
        </textarea>
    </div>

    <div class="flex items-center mb-3">
        <label for="availableRelayPoint">Point relais disponible</label>
        <input wire:model='availableRelayPoint' type="checkbox" id="availableRelayPoint" class="w-6 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-2" required>
    </div>

    <div class="flex items-center mb-3">
        <label for="conctactPhone" class="mr-2">Numéro de téléphone du Point relais</label>
        <input wire:model="conctactPhone" type="text" id="conctactPhone" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0693 123 456" required>
    </div>

    <div class="flex items-center mb-3">
        <label for="conctactEmail" class="mr-2">Email du Point relais</label>
        <input wire:model="conctactEmail" type="email" id="conctactEmail" placeholder="adresse-email@gmail.com" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
    </div>

    @if ($nameRelayPoint && $adressRelayPoint && $conctactPhone && $conctactEmail)
        <button wire:click="addRelayPoint" class="bg-primary text-secondary rounded px-4 py-2 hover:bg-secondary hover:text-primary transition duration-300">Ajouter Point Relais</button>
    @endif()
</div>


        @if (session()->has('message'))
            <div class="alert alert-success" id="confirmation-message">
                {{ session('message') }}
            </div>

            <script>
                $(document).ready(function() {
                    setTimeout(function() {
                        $('#confirmation-message').fadeOut();
                    }, 2000);
                });
            </script>
        @endif

    </div>
</div>

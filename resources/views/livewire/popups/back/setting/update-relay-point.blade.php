<div>
    <form wire:submit="updateRelayPoint">
        <div class="flex flex-row items-center justify-between bg-white border border-b border-gray-200 px-[30px] py-6">
            <div class="flex flex-row items-center gap-x-4">
                <i class="fa-solid fa-map-location-dot text-[20px]"></i>
                <h2 class="text-[20px]">Modifier le Point Relais : </h2>
            </div>
            <button wire:click="$emit('closeModal')"><i class="fa-solid fa-xmark text-[20px]"></i></button>
        </div>
        <div class="px-[30px]">
            <div class="textfield mb-3 mt-5">
                <label for="nameRelayPoint" class="mr-2">Nom du point relais</label>
                <input wire:model="nameRelayPoint" type="text" id="nameRelayPoint" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" required>
            </div>
        
            <div class="textfield mb-3">
                <label for="adressRelayPoint" class="mr-2">Adresse du point relais</label>
                <input wire:model="adressRelayPoint" type="text" id="adressRelayPoint" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" required>
            </div>
        
            <div class="textfield mb-3">
                <label for="openingHours">Heures d'ouverture</label>
                <textarea wire:model='openingHours' name="openingHours" id="openingHours" cols="30" rows="7" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg block p-2.5" required>
                    Lundi : 09h00 - 10h00
                    Mardi : 09h00 - 17h00
                    Mercredi : 09h00 - 17h00
                    Jeudi : 09h00 - 17h00
                    Vendredi : 09h00 - 17h00
                    Samedi : 09h00 - 12h00
                </textarea>
            </div>
        
            <div class="textfield mb-3">
                <label for="availableRelayPoint">Point relais disponible</label>
                <input wire:model='availableRelayPoint' type="checkbox" id="availableRelayPoint" class="w-6 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded mr-2">
            </div>
        
            <div class="textfield mb-3">
                <label for="conctactPhone" class="mr-2">Numéro de téléphone du Point relais</label>
                <input wire:model="conctactPhone" type="text" id="conctactPhone" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" required>
            </div>
        
            <div class="textfield mb-5">
                <label for="conctactEmail" class="mr-2">Email du Point relais</label>
                <input wire:model="conctactEmail" type="email" id="conctactEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
            </div>
        
            @if ($nameRelayPoint && $adressRelayPoint && $conctactPhone && $conctactEmail)
                <div class="flex flex-row justify-end w-full">
                    <button type="submit" class="bg-secondary text-white rounded px-4 py-2 mb-5 hover:bg-secondary hover:text-primary transition duration-300">Ajouter le Point Relais</button>
                </div>
            @endif()
        </div>
    </form>
</div>

@if (session()->has('message'))
    <div class="alert alert-success text-red-500" id="confirmation-message">
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
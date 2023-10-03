<div>
    <div class="flex flex-row items-center justify-between py-5 px-6 border-b-2 border-gray-200">
        <div class="flex flex-row text-xl font-bold">
            <h1 class="border-r-2 border-gray-200 pr-5">Commande : {{ $order['document_number'] }}</h1>
            <span class="border-r-2 border-gray-200 pr-5 pl-5">Status</span>
            <span class="pl-5">Prix: {{ $order['total_amount'] }} €</span>
        </div>
        <div class="hover:bg-gray-200 duration-500 cursor-pointer px-2.5 py-1 rounded-full" onclick="Livewire.emit('closeModal')">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    {{-- Pour afficher les message --}}
    <div class="h-[500px]">

    </div>

    <div class="flex flex-row items-center justify-center bg-gray-100 h-[120px] w-full border-t-2 border-gray-200">
        <div class="bg-white flex flex-row items-center justify-center w-3/5 rounded-xl">
            <div class="bg-secondary px-1.5 py-[2px] ml-6 flex justify-center items-center rounded-full cursor-pointer">
                <i class="fa-solid fa-plus text-sm"></i>
            </div>
            <input class="w-full pl-4 py-4 outline-none hover:tracking-wider duration-500" type="text" name="chat" id="chat" placeholder="Entrez votre message ou sélectionner une image">
            <div class="mr-6 text-2xl cursor-pointer" wire:click="btn">
                <i class="fa-solid fa-location-arrow"></i>
            </div>
        </div>
    </div>
</div>

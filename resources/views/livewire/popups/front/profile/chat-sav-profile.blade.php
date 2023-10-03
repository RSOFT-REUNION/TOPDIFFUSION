<div>
    <div class="flex flex-row items-center justify-between py-5 px-6 border-b-2 border-gray-200">
        <div class="flex flex-row items-center text-xl font-bold">
            <h1 class="border-r-2 border-gray-200 pr-5">Commande : {{ $order['document_number'] }}</h1>
            <span class="border-r-2 border-gray-200 pr-5 pl-5">{!! $newOrder->getStateBadge() !!}</span>
            <span class="pl-5">Prix : {{ $order['total_amount'] }} €</span>
        </div>
        <div class="hover:bg-gray-200 duration-500 cursor-pointer px-2.5 py-1 rounded-full" onclick="Livewire.emit('closeModal')">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    {{-- Pour afficher les message --}}
    <div class="h-[500px] p-4 flex flex-col gap-y-3 overflow-y-auto">
        <div class="flex flex-row justify-start">
            <div class="flex flex-col gap-y-2 w-1/2">
                <h2 class="font-bold ml-16">Bruno VERPET</h2>
                <div class="flex flex-row gap-x-3 items-start">
                    <div class="font-bold text-xl px-3.5 py-2 bg-secondary rounded-full">B</div>
                    <div class="bg-gray-100 rounded-lg p-5">
                        <p>Lorem ipsum dolor sit amet consectetur. At integer vitae mi ipsum eu fames netus sapien blandit. Ipsum aliquam nibh viverra sodales quis semper et ullamcorper. Egestas elit aliquet rhoncus elementum nisl at eu molestie sed. Massa consectetur amet posuere volutpat phasellus faucibus.</p>
                        <div class="flex flex-row justify-end items-center">
                            <h3 class=" text-xs">2j</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-end">
            <div class="flex flex-col items-end gap-y-2 w-1/2">
                <h2 class="font-bold mr-16">Alexandre MATILLA</h2>
                <div class="flex flex-row gap-x-3 items-start">
                    <div class="bg-primary text-white rounded-lg p-5">
                        <p>Lorem ipsum dolor sit amet consectetur. At integer vitae mi ipsum eu fames netus sapien blandit. Ipsum aliquam nibh viverra sodales quis semper et ullamcorper. Egestas elit aliquet rhoncus elementum nisl at eu molestie sed. Massa consectetur amet posuere volutpat phasellus faucibus.</p>
                        <div class="flex flex-row justify-end items-center">
                            <h3 class=" text-xs">1min</h3>
                        </div>
                    </div>
                    <div class="font-bold text-xl px-3.5 py-2 bg-secondary rounded-full">A</div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row items-center justify-center bg-primary h-[120px] w-full border-t-2 border-gray-200">
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

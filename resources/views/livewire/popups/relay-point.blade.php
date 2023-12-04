<div>
    {{-- Header --}}
    <div class="flex flex-row items-center justify-between bg-white border border-b border-gray-200 px-[30px] py-6">
        <div class="flex flex-row items-center gap-x-4">
            <i class="fa-solid fa-map-location-dot text-[20px]"></i>
            <h2 class="text-[20px]">Point relais</h2>
        </div>
        <button wire:click="$emit('closeModal')"><i class="fa-solid fa-xmark text-[20px]"></i></button>
    </div>

    {{-- Body --}}
    <div class="px-[20px]">
        {{-- Message de description --}}
        <div class="flex flex-row items-center justify-center bg-secondary bg-opacity-20 border border-secondary rounded-lg text-[16px] py-3 w-full my-9">
            <h3>Choisissez votre point de relais pour venir récupéré votre commande.</h3>
        </div>
        {{-- Choix Point relais --}}
        <div class="flex flex-col gap-y-3 transition-all duration-500">
            <div class="flex flex-col bg-secondary border-primary w-full rounded-[8px] p-4 duration-500">
                <div class="flex items-center">
                    <div class="border-r border-white flex flex-row items-center pr-4 my-3">
                        <input type="radio" wire:model="selectedRelay" value="relay1" class="text-[20px]" name="choix" id="choix">
                    </div>
                    <div class="flex flex-row items-center justify-between w-full ml-4">
                        <div class="flex gap-x-3 items-center">
                            <i class="fa-solid fa-location-dot text-[20px]"></i>
                            <label for="choix" class="select-none">Nom du point relais, Adresse du point relais</label>
                        </div>
                        <div class="text-green-700 flex flex-row items-center justify-center bg-white rounded-[5px] py-3 px-4">
                            <h4>Disponible</h4>
                        </div>
                    </div>
                </div>
                {{-- @if ($selectedRelay == 'relay1') --}}
                    <div class="flex flex-col ml-10 gap-y-3 duration-500 {{ $selectedRelay == 'relay1' ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0' }}" id="selected">
                        <div class="flex flex-row gap-x-3 items-center pt-4 mt-4 op border-t border-primary">
                            <i class="fa-solid fa-clock text-[20px]"></i>
                            <h5>Horaire d'ouverture</h5>
                        </div>
                        <div class="flex">
                            <div class="border-r w-1/2 border-primary">
                                <div class="flex flex-row gap-x-3 items-center">
                                    <span>Lundi</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Heure - Heure</span>
                                </div>
                                <div class="flex flex-row gap-x-3 items-center">
                                    <span>Mardi</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Heure - Heure</span>
                                </div>
                                <div class="flex flex-row gap-x-3 items-center">
                                    <span>Mercredi</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Heure - Heure</span>
                                </div>
                            </div>
                            <div class="pl-5">
                                <div class="flex flex-row gap-x-3 items-center">
                                    <span>Jeudi</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Heure - Heure</span>
                                </div>
                                <div class="flex flex-row gap-x-3 items-center">
                                    <span>Vendredi</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Heure - Heure</span>
                                </div>
                                <div class="flex flex-row gap-x-3 items-center">
                                    <span>Samedi</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Heure - Heure</span>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}
            </div>
            <div class="flex flex-row bg-primary w-full rounded-[8px] p-4">
                <div class="border-r border-white flex flex-row items-center pr-4 my-3">
                    <input type="radio" wire:model="selectedRelay" value="relay2" name="choix" id="choix2">
                </div>
                <div class="flex flex-row items-center justify-between w-full ml-4">
                    <div class="flex gap-x-3 items-center text-white">
                        <i class="fa-solid fa-location-dot text-[20px]"></i>
                        <label for="choix2" class="select-none">Nom du point relais, Adresse du point relais</label>
                    </div>
                    <div class="text-red-700 flex flex-row items-center justify-center bg-white rounded-[5px] py-3 px-2">
                        <h4 class="text-[14px]">Pas disponible</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-end w-full my-9">
            <button class="bg-secondary rounded-md py-3 px-9 hover:bg-primary duration-500 hover:text-white">Validé</button>
        </div>
    </div>
</div>

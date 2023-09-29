<div class="flex flex-col dark:bg-gradient-to-r dark:from-gray-900 dark:to-gray-800">
    <div class="bg-[#eaeff4] flex items-center justify-between px-7 py-4 dark:bg-gray-950 dark:border-gray-700 dark:border-b">
        <div class="flex text-xl gap-2">
            <div><i class="fa-solid fa-clipboard-list"></i></div>
            <h1 class="font-bold">Ouvrir demande SAV</h1>
        </div>
        <div class="items-center">
            <a wire:click="$emit('closeModal')"><i class="cursor-pointer fa-solid fa-xmark bg-[#ece1e4] text-secondary dark:text-red-300 dark:bg-red-800 p-2.5 h-5 w-5 rounded-full"></i></a>
        </div>
    </div>
    <div class="mx-14">
        <form wire:submit="create">
            @csrf
        <div class="flex flex-col justify-between gap-1 mt-8">
            <div class="whitespace-nowrap font-['K2D'] self-start ml-4">
                Sujet <div class="text-secondary contents">*</div>
            </div>
            <select wire:model="suject" class="duration-300 border-solid flex flex-col h-10 shrink-0 items-start pl-3 py-2 border-black/10 border rounded font-['K2D'] w-full appearance-none dark:bg-gray-700 dark:border-gray-800" name="" id="">
                <option value="">-- Sélectionner un sujet --</option>
                <option value="1">Cela concerne une commande</option>
                {{-- <option value="2">Autre</option> --}}
            </select>
        </div>
        @if ($suject == null)
            <div class="bg-[#e2e9ff] justify-center items-center flex flex-col py-2 mt-4 rounded border border-primary">
                <div class="whitespace-nowrap text-sm text-[#708ffd] w-3/5 ">
                    Veuillez choisir un sujet pour pouvoir continuer
                </div>
            </div>
        @endif
        @if ($suject == 1)
            <div class="flex flex-col justify-between gap-1 mt-2.5">
                <div class="whitespace-nowrap self-start ml-4">
                    Numéro de Commande : <div class="text-secondary contents">*</div>
                </div>
                <input value="{{ $command }}" disabled type="text" class="flex flex-col h-10 shrink-0 items-start w-full input" placeholder="Entrer un numéro de commande">
            </div>
        @elseif($suject == 2)
            <div class="flex flex-col justify-between gap-1 mt-2.5">
                <div class="whitespace-nowrap self-start ml-4">
                    Mon sujet : <div class="text-secondary contents">*</div>
                </div>
                <input wire:model="my_suject" type="text" class="flex flex-col h-10 shrink-0 items-start w-full input" placeholder="Entrez un sujet">
            </div>
        @endif

        @if ($suject != null)
            <div class="flex flex-col justify-between gap-1 mt-2.5">
                <div class="whitespace-nowrap font-['K2D'] self-start ml-4">
                    Message : <div class="text-secondary contents">*</div>
                </div>
                <textarea class="hover:tracking-wider duration-300 border-solid flex flex-col shrink-0 items-start pl-3 py-2 border-black/10 border rounded w-full dark:bg-gray-700 dark:border-gray-800" rows="4" wire:model="message" placeholder="Entrez votre message"></textarea>
            </div>
        @endif

        <div class="flex justify-end my-7">
            <button type="submit"><div class="flex flex-col justify-center shrink-0 btn-popup">Envoyer ma demande au SAV</div></button>
            </div>
        </form>
    </div>
</div>



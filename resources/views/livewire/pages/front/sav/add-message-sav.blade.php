<div class="flex flex-col dark:bg-gradient-to-r dark:from-gray-900 dark:to-gray-800">
    <div class="bg-[#eaeff4] flex items-center justify-between px-7 py-4 dark:bg-gray-950 dark:border-gray-700 dark:border-b">
        <div class="flex text-xl gap-2">
            <div><i class="fa-solid fa-clipboard-list"></i></div>
            <h1 class="font-bold">Ajouter un message</h1>
        </div>
        <div class="items-center">
            <a wire:click="$emit('closeModal')"><i class="cursor-pointer fa-solid fa-xmark bg-[#ece1e4] text-secondary dark:text-red-300 dark:bg-red-800 p-2.5 h-5 w-5 rounded-full"></i></a>
        </div>
    </div>
    <div class="mx-14">
        <form wire:submit.prevent="createSavMessage">
            @csrf
            <div class="flex flex-col justify-between gap-1 mt-5">
                <div class="whitespace-nowrap font-['K2D'] self-start ml-4">
                    Message : <div class="text-secondary contents">*</div>
                </div>
                <textarea wire:model="message" rows="6" class="hover:tracking-wider duration-300 border-solid flex flex-col shrink-0 outline-none items-start pl-3 py-2 border-black/10 border rounded w-full dark:bg-gray-700 dark:border-gray-800" wire:model="message" placeholder="Entrez votre message"></textarea>
            </div>

            <div class="flex justify-end my-7">
                <button type="submit"><div class="flex flex-col justify-center shrink-0 btn-popup">Envoyer mon ticket</div></button>
            </div>
        </form>
    </div>
</div>

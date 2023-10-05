<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Demande SAV</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit="create" class="px-3">
        @csrf
        <div class="textfield mt-2">
            <label for="suject">Sujet<span class="text-red-500">*</span></label>
            <select wire:model="suject" id="suject">
                <option value="">-- Sélectionner un sujet --</option>
                <option value="1">Cela concerne une commande</option>
            </select>
        </div>
        @if ($suject == null)
            <div class="bg-[#fffaec] justify-center items-center flex flex-col py-2 mt-4 rounded border border-secondary">
                <div class="whitespace-nowrap text-sm text-secondary">
                    Veuillez choisir un sujet pour pouvoir continuer
                </div>
            </div>
        @endif
        @if ($suject == 1)
            <div class="textfield mt-2">
                <label for="numCommand">Numéro de Commande :<span class="text-red-500">*</span></label>
                <input value="{{ $command }}" disabled type="text" id="numCommand" placeholder="Entrer un numéro de commande" class="cursor-not-allowed">
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
            <div class="textfield">
                <label for="massage">Message : </label>
                <textarea wire:model="massage" id="massage" placeholder="Entrez votre message" rows="4"></textarea>
            </div>
        @endif

        <div class="flex justify-end my-7">
            <button type="submit" class="bg-secondary py-2 px-3 hover:bg-primary hover:text-white rounded-lg border border-gray-200 font-medium duration-300 active:bg-secondary active:text-black active:duration-0"><div class="flex flex-col justify-center shrink-0 btn-popup">Envoyer ma demande au SAV</div></button>
            </div>
        </form>
    </div>
</div>



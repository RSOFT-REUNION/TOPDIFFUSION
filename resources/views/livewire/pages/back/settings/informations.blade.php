<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Informations</h1>
        </div>
    </div>
    <div>
        <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4">
            <div>
                <h2 class="font-medium mb-1">Adresse e-mail principale</h2>
                <p class="text-[13px] text-[#808080]">Cette adresse e-mail sera visible sur votre site pour tous les utilisateurs</p>
            </div>
            <form wire:submit.prevent="updateMainEmail" class="inline-flex items-center">
                @csrf
                <div class="">
                    <input type="text" wire:model="main_email" placeholder="Entrez votre adresse e-mail principal" class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                </div>
                @if($settingGlobal->main_email != $main_email)
                    <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                @endif
            </form>
        </div>
        <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
            <div>
                <h2 class="font-medium  mb-1">Numéro de téléphone principal</h2>
                <p class="text-[13px] text-[#808080]">Ce numéro sera visible sur votre site pour tous les utilisateurs</p>
            </div>
            <form wire:submit.prevent="updateMainPhone" class="inline-flex items-center">
                @csrf
                <div class="">
                    <input type="text" wire:model="main_phone" placeholder="Entrez votre numéro de téléphone principal.." class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                </div>
                @if($settingGlobal->main_phone != $main_phone)
                    <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                @endif
            </form>
        </div>
        <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
            <div>
                <h2 class="font-medium  mb-1">Votre Facebook</h2>
                <p class="text-[13px] text-[#808080]">Les utilisateurs pourront accèder à votre facebook directement depuis votre site.</p>
            </div>
            <form wire:submit.prevent="updateSocialFacebook" class="inline-flex items-center">
                @csrf
                <div class="">
                    <input type="text" wire:model="social_facebook" placeholder="Entrez votre compte Facebook.." class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                </div>
                @if($settingGlobal->social_facebook != $social_facebook)
                    <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                @endif
            </form>
        </div>
        <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
            <div>
                <h2 class="font-medium  mb-1">Votre Instagram</h2>
                <p class="text-[13px] text-[#808080]">Les utilisateurs pourront accèder à votre instagram directement depuis votre site.</p>
            </div>
            <form wire:submit.prevent="updateSocialInsta" class="inline-flex items-center">
                @csrf
                <div class="">
                    <input type="text" wire:model="social_insta" placeholder="Entrez votre compte Instagram.." class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                </div>
                @if($settingGlobal->social_insta != $social_insta)
                    <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                @endif
            </form>
        </div>
        <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
            <div>
                <h2 class="font-medium  mb-1">Votre Twitter</h2>
                <p class="text-[13px] text-[#808080]">Les utilisateurs pourront accèder à votre twitter directement depuis votre site.</p>
            </div>
            <form wire:submit.prevent="updateSocialTwitter" class="inline-flex items-center">
                @csrf
                <div class="">
                    <input type="text" wire:model="social_twitter" placeholder="Entrez votre compte Twitter.." class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                </div>
                @if($settingGlobal->social_twitter != $social_twitter)
                    <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                @endif
            </form>
        </div>
        <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
            <div>
                <h2 class="font-medium  mb-1">Votre LinkedIn</h2>
                <p class="text-[13px] text-[#808080]">Les utilisateurs pourront accèder à votre linkedIn directement depuis votre site.</p>
            </div>
            <form wire:submit.prevent="updateSocialLinkedin" class="inline-flex items-center">
                @csrf
                <div class="">
                    <input type="text" wire:model="social_linkedin" placeholder="Entrez votre compte Linkedin.." class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                </div>
                @if($settingGlobal->social_linkedin != $social_linkedin)
                    <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                @endif
            </form>
        </div>
        <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
            <div>
                <h2 class="font-medium  mb-1">Votre Youtube</h2>
                <p class="text-[13px] text-[#808080]">Les utilisateurs pourront accèder à votre youtube directement depuis votre site.</p>
            </div>
            <form wire:submit.prevent="updateSocialYoutube" class="inline-flex items-center">
                @csrf
                <div class="">
                    <input type="text" wire:model="social_youtube" placeholder="Entrez votre compte Youtube.." class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                </div>
                @if($settingGlobal->social_youtube != $social_youtube)
                    <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                @endif
            </form>
        </div>
    </div>
</div>

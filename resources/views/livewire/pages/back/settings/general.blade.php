<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Réglages généraux</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <p class="mr-2 {{$maintenanceState == 1 ? "text-green-700 bg-green-100" : "text-red-700 bg-red-100"}} px-2 py-1 rounded-lg">{{$maintenanceState == 1 ? "Site actif" : "Site inactif"}}</p>
            <a wire:click="$emit('openModal', 'pages.back.products.popup-add-product')" class="btn-secondary cursor-pointer">Envoyer des commentaires</a>
        </div>
    </div>
    <div id="entry-content">
        <div class="btn-check-line flex items-center">
            <div class="flex-1">
                <label for="maintenance_mode">Mettre le site mode de maintenance</label>
                <p>Cette fonction permet de bloquer l'accès au site pendant toute opération visant à modifier son contenu</p>
            </div>
            <div class="flex-none">
                <label for="maintenance_mode" class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:click="maintenance_mode" id="maintenance_mode" class="sr-only peer" {{ $maintenanceState ? "checked" : ""}}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
        <div class="btn-check-line flex items-center mt-2">
            <div class="flex-1">
                <label for="B2B_mode">Autoriser le commerce B2B</label>
                <p>Permettre au client de se définir en tant que professionnel, avoir des tarifs réservé au professionnel...</p>
            </div>
            <div class="flex-none">
                <label for="B2B_mode" class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:click="B2B_mode" id="B2B_mode" class="sr-only peer" @if($settings->professionnal_customers) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
        @if($professionnal)
        <form wire:submit.prevent="prices_type" class="mt-2 pb-2 border-b border-gray-200">
            @csrf
            <div class="flex items-center">
                <div class="flex-1">
                    <label for="prices_mode">Mode d'affichage des prix</label>
                    <p class="text-sm text-gray-500">Définir la façon dont les prix publics et les prix clients sont affichés</p>
                </div>
                <div class="flex-none inline-flex items-center">
                    <div class="textfield">
                        <select id="prices_mode" wire:model="prices_mode">
                            <option value="">-- Sélectionnez un type --</option>
                            <option value="1">Prix Professionnel + Public</option>
                            <option value="2">Prix Professionnel uniquement</option>
                        </select>
                    </div>
                    @if($settings->prices_type != $prices_mode)
                        <div class="ml-2">
                            <button type="submit" class="btn-secondary"><i class="fa-solid fa-floppy-disk"></i></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="force-center mt-3">
                <img src="{{ asset('img/settings/prices_type.svg') }}" width="50%">
            </div>
        </form>
        @endif
        <div class="btn-check-line flex items-center mt-2">
            <div class="flex-1">
                <label for="active_favorite">Autoriser les articles favoris</label>
                <p>Permettre au client d'ajouter des articles dans leurs favoris</p>
            </div>
            <div class="flex-none">
                <label for="active_favorite" class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:click="active_favorite" id="active_favorite" class="sr-only peer" @if($settings->favorite) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
        <div class="btn-check-line flex items-center mt-2">
            <div class="flex-1">
                <label for="bike_check">Vérifier la compatibilité des produits</label>
                <p>Si le client a enregistré une moto, il peut facilement vérifier la compatibilité des pièces avec celui-ci</p>
            </div>
            <div class="flex-none">
                <label for="bike_check" class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:click="bike_check" id="bike_check" class="sr-only peer" @if($settings->bikes_compatibility) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
        <div class="border-b border-gray-200">
            <div class=" flex items-center mt-2">
                <div class="flex-1">
                    <label for="prices_mode">Carrousel principal</label>
                    <p class="text-sm text-gray-500">
                        Changer ces images modifie le carrousel de la page d'accueil.</p>
                </div>
                <div class="flex-none">
                    <a wire:click="$emit('openModal', 'popups.back.setting.add-picture-carrousel')" class="bg-secondary duration-500 border border-gray-300 px-3 py-2 rounded-lg cursor-pointer">Ajouter une image</a>
                </div>

            </div>
            <div class="mt-7">
                @if($CarrouselHome->count() > 0)
                    @foreach($CarrouselHome as $home)
                        <div class="container-carousel_list" style="background-image: url('{{ asset('storage/medias/'. $home->getPicture()) }}')">
                            <div class="buttons">
                                <button wire:click="deleteCarousel({{ $home->id }})" class="btn-icon_secondary"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="empty-text">Vous n'avez pas encore configuré votre carrousel</p>
                @endif
            </div>
        </div>
    </div>
</div>

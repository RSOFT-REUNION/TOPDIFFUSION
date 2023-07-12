<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Réglages avancée</h1>
        </div>
    </div>
    <div id="entry-content">
        <div class="btn-check-line flex items-center">
            <div class="flex-1">
                <label for="maintenance_mode">Mettre le site mode de maintenance</label>
                <p>Cette fonction permet de bloquer l'accès au site pendant toutes opération visant à modifier son contenu</p>
            </div>
            <div class="flex-none">
                <label for="maintenance_mode" class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:click="maintenance_mode" id="maintenance_mode" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
    </div>
</div>

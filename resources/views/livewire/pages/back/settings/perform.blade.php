<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Réglages performances</h1>
        </div>
    </div>
    <div id="entry-content">
        @if($output)
            <div id="output_window">
                {{ $output }}
            </div>
        @endif
        <div class="btn-check-line flex items-center">
            <div class="flex-1">
                <label for="maintenance_mode">Vider les caches</label>
                <p>Supprimer les caches de votre site afin d'optimiser ses performances</p>
            </div>
            <div class="flex-none">
                <a wire:click="clearCaches" class="btn-secondary cursor-pointer">Vider les caches</a>
            </div>
        </div>
    </div>

    <script>
        // Hidden box by timeout
        var popupConsole = document.querySelector('#output_window');
        var delai = 10000;
        function masquerConsole() {
            popupConsole.style.display = 'none';
        }
        setTimeout(masquerConsole, delai);
    </script>
</div>

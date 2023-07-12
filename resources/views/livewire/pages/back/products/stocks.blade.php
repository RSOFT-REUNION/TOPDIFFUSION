<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Stocks</h1>
        </div>
        <div class="flex-none">
            <a class="btn-secondary cursor-pointer">Réaliser un inventaire</a>
        </div>
    </div>
    <div id="entry-content">
        <div class="grid grid-cols-4 gap-4">
            <div class="grid-item-button text-red-500">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-arrow-trend-down fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>32 articles</h3>
                        <p>En rupture de stock</p>
                    </div>
                </div>
            </div>
            <div class="grid-item-button text-amber-600">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-shapes fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>15 articles</h3>
                        <p>Avec un stock faible</p>
                    </div>
                </div>
            </div>
            <div class="grid-item-button">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-cart-shopping fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>3 articles</h3>
                        <p>Dans un panier</p>
                    </div>
                </div>
            </div>
            <div class="grid-item-button">
                <div class="flex items-center">
                    <div class="flex-none mr-4">
                        <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                    </div>
                    <div class="flex-1 ml-4">
                        <h3>{{ $stocks->count() }} articles</h3>
                        <p>En stock</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h2 class="subtitle">Articles actuellement dans un panier</h2>
            <div class="mt-3 table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>Article</th>
                        <th>Quantité</th>
                        <th>Client</th>
                        <th>Depuis le</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="mt-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2 class="subtitle">Articles en rupture de stock</h2>
                </div>
                <div class="flex-none">
                    <a class="btn-secondary cursor-pointer">Ajouter du stock sur ces articles</a>
                </div>
            </div>
            <div class="mt-3 table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>Article</th>
                        <th>En rupture depuis</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

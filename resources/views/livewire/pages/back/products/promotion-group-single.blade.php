<div>
    @foreach ($promoItems as $promoItem)
    <div>
        @if ($promoItem->active)
            <h2>PROMO Activé</h2>
        @endif
        @if ($promoItem->slug)
            <h3>Affichage dans l'url: <span class="font-bold">{{ $promoItem->slug }}</span></h3>
        @endif
        <h3>Créer le | <span class="italic">{{ date('d/m/Y', strtotime($promoItem->created_at)) }} à {{ date('H:i', strtotime($promoItem->created_at)) }}</span></h3>
    </div>
    <br>
    @endforeach
</div>

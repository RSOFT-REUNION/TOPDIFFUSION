@if (count($bikesInfos) === 0)
    <h1>Pas de donnés trouvé</h1>
@else
    @foreach ($bikesInfos as $bike)
        <div>
            <p>Marque : {{ $bike['title'] }}</p>
            <p>Image : {{ $bike['cover'] }}</p>
            <p>Description : {{ $bike['short_description'] }}</p>
            <p>Active : {{ $bike['active'] }}</p>
        </div>
    @endforeach
@endif

<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Ajout d'une promotion</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <button type="submit" class="btn-secondary">Publier ma promotions</button>
        </div>
    </div>
    <div id="entry-content">
        @if($products->count() > 0)
            <div class="table-box-outline">
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Nom</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><input id="checkbox" type="checkbox" value="" class="w-4 h-4 bg-yellow-900 border-[#FBBC34] rounded focus:ring-yellow-500"></td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="empty-text mt-2">Vous n'avez pas encore article</p>
        @endif
    </div>
</div>

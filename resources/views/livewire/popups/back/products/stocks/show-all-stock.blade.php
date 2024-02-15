<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Liste des articles en stocks</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>

    <div class="entry-content">
        <p class="text-slate-400">Vous retrouverez ici la liste des articles qui sont actuellement en stock.</p>
        <div class="table-box-outline mt-3">
            <table>
                <thead>
                <tr>
                    <th><i class="fa-solid fa-image"></i></th>
                    <th>UGS</th>
                    <th>Nom</th>
                    <th>Status</th>
                    <th>Quantité</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $pro)
                    <tr>
                        <td class="w-[70px]"><img src="{{ asset('storage/images/products/'. $pro->product()->cover) }}" width="50px"></td>
                        <td>{{ $pro->product()->getUgs() }}</td>
                        <td>{{ $pro->product()->title }}</td>
                        <td>{!! $pro->getBadge() !!}</td>
                        <td>{{ $pro->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

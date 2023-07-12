<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Clients</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <a href="" class="btn-icon mr-2"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
    </div>
    <div id="entry-content" class="mt-3">
        @if($users->count() > 0)
            <div class="table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Code client</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr role="button" data-href="{{ route('back.user.single', ['user' => $user->customer_code]) }}">
                            <td>{{ $user->id }}</td>
                            <td><b>{{ $user->customer_code }}</b></td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{!! $user->getCustomerType() !!} @if($user->professionnal == 1 && $user->verified == 1) <i title="Vérifié" class="fa-solid fa-circle-check text-green-400 ml-2"></i> @elseif($user->professionnal == 1 && $user->verified == 0) <i title="Pas vérifié" class="fa-solid fa-circle-xmark text-red-400 ml-2"></i> @endif</td>
                            <td><i class="fa-solid fa-eye"></i></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text">Vous n'avez pas encore de client inscrit</p>
        @endif
    </div>
</div>

@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        <div id="profile-page" class="mx-3">
            <div class="entry-header">
                <div class="flex items-center">
                    <div class="flex-1 inline-flex items-center">
                        <div class="my-2 mr-7">
                            <a onclick="window.history.back()"
                                class="bg-secondary px-5 py-2 rounded-lg dark:bg-gray-700 cursor-pointer">
                                <i class="fa-solid fa-arrow-left-long"></i>
                            </a>
                        </div>
                        {{-- <a href="{{ route('back.user.list') }}" class="btn-icon mr-3"><i class="fa-solid fa-arrow-left"></i></a> --}}
                        <h1><b>{{ $user->lastname }}</b> {{ $user->firstname }}</h1>
                    </div>
                    <div class="flex-none">
                        @if ($user->professionnal == 1 && $user->verified == 0)
                            <p class="text-amber-500 bg-amber-100 border border-amber-200 px-2 py-1 rounded-lg"><i
                                    class="fa-solid fa-hourglass-start mr-3"></i>En attente de validation</p>
                        @elseif($user->professionnal == 1 && $user->verified == 1)
                            <p class="px-2 py-1 bg-amber-100 text-amber-500 rounded-lg">Professionnel</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="entry-content">
                <div class="flex">
                    <div class="flex-1 mt-3 mr-2">
                        <div>
                            <h2 class="subtitle">Information sur le client</h2>
                            <div class="flex mt-3">
                                <div class="flex-1 mr-2">
                                    <div class="text-input">
                                        <label>Nom & prénom</label>
                                        <p>{{ $user->lastname }} {{ $user->firstname }}</p>
                                    </div>
                                    <div class="text-input mt-1">
                                        <label>Adresse e-mail</label>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    <div class="text-input mt-1">
                                        <label>Date d'inscription</label>
                                        <p>{{ $user->getCreatedAt() }}</p>
                                    </div>
                                </div>
                                <div class="flex-1 ml-2">
                                    <div class="text-input">
                                        <label>Code client</label>
                                        <p>{{ $user->customer_code }}</p>
                                    </div>
                                    <div class="text-input mt-1">
                                        <label>Numéro de téléphone</label>
                                        <p>
                                            @if ($user->phone)
                                                {{ $user->phone }}
                                            @else
                                                <span class="text-blue-500">Numéro non enregistré par le client</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-input mt-1">
                                        <label>Type de client</label>
                                        <p>{!! $user->getCustomerType() !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($user->professionnal)
                            <div class="mt-4 border-t border-gray-100 pt-2">
                                <h2 class="subtitle">Information sur l'entreprise</h2>
                                <div class="flex mt-3">
                                    <div class="flex-1 mr-2">
                                        <div class="text-input">
                                            <label>Nom</label>
                                            <p>{{ $userData->company_name }}</p>
                                        </div>
                                        <div class="text-input mt-1">
                                            <label>Code RCS</label>
                                            <p>{{ $userData->company_rcs }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-1 ml-2">
                                        <div class="text-input">
                                            <label>Nom commercial</label>
                                            <p>
                                                @if ($userData->company_com_name)
                                                    {{ $userData->company_com_name }}
                                                @else
                                                    <span class="text-blue-500">Pas de nom commercial renseigné</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="text-input mt-1">
                                            <label>Code TVA</label>
                                            <p>{{ $userData->company_tva }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="mt-4 border-t border-gray-100 pt-2">
                            <h2 class="subtitle">Adresses du client</h2>
                            @if ($userAddress->count() > 0)
                                <div class="table-box-outline mt-3">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Adresse</th>
                                                <th>Code postale</th>
                                                <th>Ville</th>
                                                <th>Pays</th>
                                                <th>Par défaut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userAddress as $address)
                                                <tr>
                                                    <td>{{ $address->title }}</td>
                                                    <td>
                                                        <div>
                                                            {{ $address->address }}
                                                            <span class="text-sm">{{ $address->address_bis }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $address->postal_code }}</td>
                                                    <td>{{ $address->city }}</td>
                                                    <td>{{ $address->country }}</td>
                                                    <td>
                                                        @if ($address->default == 1)
                                                            <i class="fa-solid fa-circle-check text-green-500"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="empty-text mt-2">Le client n'a pas encore renseigné d'adresse.</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex-none ml-2">
                        <div class="container-sidebar-options bg-gray-100">
                            @if ($user->professionnal == 1 && $user->verified == 0)
                                <a href="{{ route('back.user.verified', ['user' => $user->customer_code]) }}"
                                    class="text-amber-500 bg-amber-100 border border-amber-200 rounded-lg"><i
                                        class="fa-solid fa-circle-check mr-3"></i>Valider le profil</a>
                            @endif
                            <div class="flex-none">
                                <a onclick="Livewire.emit('openModal', 'popups.back.clients.edit-client-profil', {{ json_encode(['user_id' => $user->id]) }})"
                                    class="btn-secondary cursor-pointer"><i
                                        class="fa-solid fa-pen-to-square mr-3"></i>Modifier les informations</a>
                            </div>
                        </div>
                        <div class="bg-gray-100 mt-5 rounded-lg p-6 flex flex-col gap-y-5">
                            <h2 class="subtitle">Groupe du client</h2>
                            <span class="font-medium text-xl text-secondary">{{ $user->customerGroupId->name }}</span>
                            <div class="">
                                <form method="POST" action="{{ route('updateGroupUser', ['user' => $user->id]) }}">
                                    @csrf
                                    <div class="flex flex-col">
                                        <label for="newGroup">Sélectionnez le nouveau groupe :</label>
                                        <select name="newGroup" id="newGroup"
                                            class=" outline-none border-none rounded-md py-2 pl-4 mt-2">
                                            @foreach ($availableGroups as $groupe)
                                                <option value="{{ $groupe->id }}">{{ $groupe->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn-secondary mt-5">Déplacer dans ce groupe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

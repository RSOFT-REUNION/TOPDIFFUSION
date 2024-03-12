<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Clients</h1>
        </div>
        <label for="" class="px-3"><i class="fa-solid fa-magnifying-glass"></i></label>
        <input wire:model.debounce.100ms="search" type="text" placeholder="Rechercher un client.." class="bg-transparent px-2 py-3 focus:outline-none border-none focus:border-none duration-300 hover:tracking-wider dark:border-none">
        @if ($search)
            <button wire:click="clear" class="px-3">
                <i class="fa-solid fa-times"></i>
            </button>
        @endif
        <div class="flex items-center">
            <a wire:click="filtre" class="bg-primary cursor-pointer flex items-center rounded-lg mx-5 px-5 py-3 hover:bg-secondary hover:duration-500 dark:bg-blue-800 dark:hover:bg-red-800 dark:hover:duration-700 @if ($stateFiltre) bg-secondary hover:bg-primary dark:bg-red-800 dark:hover:bg-blue-800 @endif">
                <div class="mr-3">
                    <i class="fa-solid @if ($stateFiltre) fa-filter-circle-xmark @else fa-filter @endif  text-white"></i>
                </div>
                <button class="text-white">
                    @if ($stateFiltre)
                    <button wire:click="clear" class="px-3">Masquer</button>
                    @else
                        Filtrer
                    @endif
                </button>
            </a>
        </div>
        @if ($stateFiltre)
        <div class="mt-3 border border-[#eaeff4] bg-[#eaeff4] rounded-lg overflow-hidden dark:border-blue-900">
            <div class="bg-[#eaeff4] px-6 py-6 dark:bg-gray-900">
                <h2 class="text-xl text-secondary font-bold"><i class="fa-solid fa-filter mr-3"></i>Filtres</h2>
            </div>
            <div class="px-6 py-6 bg-[#eaeff4] dark:bg-gray-900 dark:text-white">
                <form wire:submit.prevent="filtre">
                    @csrf
                    <div class="flex">
                        <div>
                            <label for="form_startDate" class="pl-2 pb-2">Type de Client</label>
                            <select wire:model='type' class="focus:outline-none w-full bg-white px-3 py-2 rounded-lg appearance-none border-gray-300 dark:bg-gray-700 dark:border-gray-800" name="status_facture" id="form_status">
                                <option value="">-- Selectionner un type --</option>
                                <option value="0">Particulier</option>
                                <option value="1">Professionel</option>
                            </select>
                        </div>
                        <div class="flex-1 ml-1">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
        {{-- <div class="flex-none inline-flex items-center">
            <a href="" class="btn-icon mr-2"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div> --}}
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
            <p class="empty-text">Vous n'avez pas encore de clients inscrits</p>
        @endif
    </div>
</div>

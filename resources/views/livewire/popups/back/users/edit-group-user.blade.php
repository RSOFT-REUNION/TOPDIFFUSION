<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>{{ $group->title }}</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="editGroup">
            @csrf
            <div class="textfield">
                <label for="description">Description du groupe</label>
                <textarea id="description" wire:model="description" placeholder="Entrez une description du groupe" class="@if ($errors->has('name')) input-error @endif">{{ $group->description }}</textarea>
                @if($errors->has('description'))
                    <p class="text-red-500 text-sm ml-2 mt-1">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <p class="mt-2 font-bold">Pourcentage de remise (%)</p>
            <div class="flex items-center gap-3">
                <div class="flex-1">
                    <div class="textfield mt-2">
                        <input type="range" wire:model="discount" id="discount"
                               min="0"
                               max="100" required value="{{ $group->discount  }}" />
                        @error('discount_percentage')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex-none">
                    <p class="aspect-square p-2 text-sm font-bold bg-slate-100 rounded-md">{{ $discount }}</p>
                </div>
            </div>
            @if($discount != $group->discount || $description != $group->$description)
                <div class="mt-2">
                    <button class="btn-secondary block w-full">Enregistrer les modifications</button>
                </div>
            @endif
        </form>
        <div class="mt-5">
            @if($users->count() > 0)
                <div class="table-box-outline">
                    <table>
                        <thead>
                        <tr>
                            <th>Code client</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse e-mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr role="button" wire:click="Window.location.href='{{ route('back.user.single', ['user' => $user->customer_code]) }}'" class="group hover:text-blue-500 hover:cursor-pointer">
                                <td>{{ $user->customer_code }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="bg-slate-100 rounded-md py-2 px-3">Aucun utilisateur ne fait partie de ce groupe</p>
            @endif
        </div>
    </div>
</div>

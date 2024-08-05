<form wire:submit="createProduct" enctype="multipart/form-data">
    @csrf
    <div class="inline-flex items-center justify-between w-full">
        <a href="{{ route('bo.products.list') }}" class="btn-slate-icon"><i class="fa-solid fa-arrow-left mr-3"></i>Retour & annuler</a>
        <x-elements.buttons.btn-submit class="btn-primary" label="Enregistrer le produit" icon="save"/>
    </div>
    <div class="mt-5">
        <x-elements.inputs.textfield type="text" name="name" label="Nom du produit" livewire="yes" require="yes" class="" placeholder="Entrez un nom pour le produit"/>
        @if($name)
            <p class="bg-slate-100 text-sm mt-2 py-1 px-3 rounded-lg border">Url qui sera visible pour le produit: <span class="font-bold">{{ \Illuminate\Support\Str::slug($name) }}</span></p>
        @endif
        <div class="mt-3 border p-5 rounded-xl flex items-center items-center gap-5">
            <div class="flex-1">
                <h2 class="font-bold font-title mb-3">Information du produit</h2>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.product.add-product.add-category'})" class="btn-slate"><i class="fa-regular fa-layer-group mr-3"></i>{{ $category ? $category->name : 'Ajouter une catégorie' }}</button>
                    <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.product.add-product.add-brand'})" class="btn-slate"><i class="fa-regular fa-gem mr-3"></i>{{ $brand ? $brand->name : 'Sélectionner une marque' }}</button>
                </div>
                <x-elements.inputs.textfield type="textarea" label="Description de votre produit" name="description" class="mt-3" livewire="yes" require="yes" placeholder="Entrez une description pour votre produit" />
                <x-elements.inputs.textfield type="text" label="Mots clés" name="keywords" class="mt-3" livewire="yes" require="" placeholder="Entrez une liste de mots clés séparé par des virgules" />
                @if($type == 'simple')
                    <div class="mt-3 mx-3">
                        <input type="checkbox" wire:model.live="kit" id="kit" class="">
                        <label for="kit">Cette pièce est compatible avec kit chaines</label>
                    </div>
                    @if($kit)
                        <div class="textfield mt-3">
                            <label for="kit_element">Élément du kit</label>
                            <select id="kit_element" wire:model.live="kit_element">
                                <option value="">Sélectionner un élément</option>
                                <option value="pignon">Pignon</option>
                                <option value="chain">Chaine</option>
                                <option value="crown">Couronne</option>
                            </select>
                        </div>
                    @endif
                @endif
            </div>
            <div class="flex-1 h-full">
                @if($cover)
                    <div class="relative">
                        <div class="force-center">
                            <div class="aspect-square bg-slate-100 w-1/2 rounded-xl overflow-hidden">
                                <img src="{{ $cover->temporaryUrl() }}" alt="Photo du produit" class="object-cover w-full h-full">
                            </div>
                        </div>
                        <label for="cover" class="absolute bottom-10 right-10">
                            <input type="file" id="cover" wire:model.live="cover" hidden>
                            <p class="border  bg-slate-100 py-2 px-4 rounded-lg duration-300 hover:bg-slate-200 cursor-pointer">Modifier la photo</p>
                            @error('cover')
                            <p class="text-sm mt-1 text-red-500 text-center">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                @else
                    <div class="flex">
                        <div class="m-auto">
                            <label for="cover">
                                <input type="file" id="cover" wire:model.live="cover" hidden>
                                <p class="border bg-slate-100 py-2 px-4 rounded-lg duration-300 hover:bg-slate-200 cursor-pointer">Ajouter une photo produit</p>
                                @error('cover')
                                <p class="text-sm mt-1 text-red-500 text-center">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-start gap-3">
            <div class="flex-1">
                <div class="mt-3 border rounded-xl p-3">
                    <h2 class="font-bold font-title">Références & tarif du produit</h2>
                    <p class="text-slate-400 text-sm">Veuillez noter que tous les tarifs doivent être saisie en "euros"</p>
                    <x-elements.inputs.textfield type="text" name="ugs" label="Code UGS du produit" livewire="yes" require="yes" class="mt-3" placeholder="Entrez le code UGS du produit"/>
                    <x-elements.inputs.textfield type="number" name="price" label="Prix de vente (€)" livewire="yes" require="yes" class="mt-3" placeholder="Entrez le prix de vente du produit"/>
                </div>
            </div>
            <div class="flex-1">
                <div class="mt-3 border rounded-xl p-3">
                    <div class="">
                        <div>
                            <h2 class="font-bold font-title">Information supplémentaire sur le produit</h2>
                            <p class="text-slate-400 text-sm">Vous pouvez ajouter des informations personnalisé pour chaque produit</p>
                        </div>
                        <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.product.add-product.add-informations'})" class="btn-slate mt-5 w-full">Ajouter des informations supplémentaire</button>
                        @if($infos)
                            <ul class="mt-3 border-t p-3 divide-y *:py-2">
                                @foreach($infos as $index => $info)
                                    <li class="inline-flex items-center justify-between w-full group">{{ $info['key'] }}<div><span class="font-bold">{{ $info['value'] }}</span><a wire:click="removeInfo({{ $index }})" class="ml-3 group-hover:visible invisible cursor-pointer"><i class="fa-light fa-delete-left text-red-500"></i></a></div></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($type == 'variable')
            <div class="mt-3 border rounded-xl p-3">
                <div class="inline-flex items-center justify-between w-full">
                    <h2 class="font-bold font-title">Variante du produit</h2>
                    <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.product.add-product.add-variant'})" class="btn-slate">Ajouter une variante</button>
                </div>
                @if($variants)
                    <div class="table-box mt-3">
                        <table>
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Nom de la déclinaison</th>
                                <th>Déclinaison</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($variants as $index => $variant)
                                <tr>
                                    <td>{{ $variant['type'] == 'color' ? 'Couleur' : 'Texte' }}</td>
                                    <td class="border-r">{{ $variant['name'] }}</td>
                                    <td>
                                        @if($variant['type'] == 'color')
                                            <div class="w-5 h-5 rounded-full" style="background-color: {{ $variant['variable'] }}"></div>
                                        @else
                                            <span class="bg-white border rounded-full py-1 px-2 text-sm cursor-pointer hover:ring-1 hover:ring-offset-2">{{ $variant['variable'] }}</span>
                                        @endif
                                    </td>
                                    <td><a wire:click="removeVariant({{ $index }})" class="cursor-pointer"><i class="fa-light fa-delete-left text-red-500"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endif
        <div class="mt-3 border rounded-xl p-3">
            <div>
                <div>
                    <h2 class="font-bold font-title">Motos compatible</h2>
                    <p class="text-slate-400 text-sm">Déterminer une liste de motos qui sont compatible avec votre produit</p>
                </div>
                <button type="button" wire:click="$dispatch('openModal', {component: 'backend.popups.product.add-product.add-bikes'})" class="btn-slate mt-5 w-full">Ajouter des motos</button>
                @if($bikes)
                    <ul class="mt-3 border-t p-3 divide-y *:py-2">
                        @foreach($bikes as $index => $bike)
                            <li class="inline-flex items-center justify-between w-full group">{{ $bike['brand'] }} {{ $bike['model'] }} {{ $bike['cylinder'] }} {{ $bike['year'] }}<div><a wire:click="removeBike({{ $index }})" class="ml-3 group-hover:visible invisible cursor-pointer"><i class="fa-light fa-delete-left text-red-500"></i></a></div></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</form>

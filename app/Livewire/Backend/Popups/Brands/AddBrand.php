<?php

namespace App\Livewire\Backend\Popups\Brands;


use App\Models\ActivityLog;
use App\Models\ProductBrand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddBrand extends ModalComponent
{
    use WithFileUploads;

    public $name, $logo, $url;

    #[Rule([
        'name' => 'required|string',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'url' => 'nullable|string'
    ], message: [
        'name.required' => 'Le nom de la marque est obligatoire',
        'name.string' => 'Le nom de la marque doit être une chaîne de caractères',
        'logo.required' => 'Le logo de la marque est obligatoire',
        'logo.image' => 'Le logo de la marque doit être une image',
        'logo.mimes' => 'Le logo de la marque doit être une image de type jpeg, png, jpg, gif ou svg',
        'logo.max' => 'Le logo de la marque ne doit pas dépasser 2 Mo',
        'url.string' => 'L\'URL de la marque doit être une chaîne de caractères'
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addBrand()
    {
        $this->validate();

        $slug = Str::slug($this->name);
        $logo_name = $slug . '.' . $this->logo->getClientOriginalExtension();

        try {
            $brand = new ProductBrand;
            $brand->name = $this->name;
            $brand->slug = $slug;
            $brand->logo = $logo_name;
            $brand->url = $this->url;
            if($brand->save())
            {
                // Sauvegarde du logo
                Storage::disk('public')->putFileAs('products/brands', $this->logo, $logo_name);

                // Log
                $log = new ActivityLog;
                $log->type = 'success';
                $log->key = 'brand.create';
                $log->title = 'Ajout de marque de produit';
                $log->description = 'La marque de produit ' . $this->name . ' a été ajoutée avec succès.';
                $log->save();

                return to_route('bo.products.brands')->with('success', 'La marque de produit ' . $this->name . ' a été ajoutée avec succès.');
            }
        } catch (\Exception $e) {
            $this->addError('error', $e->getMessage());

            // Log
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'brand.create';
            $log->title = 'Erreur lors de l\'ajout de la marque de produit';
            $log->description = 'Une erreur est survenue lors de l\'ajout de la marque de produit ' . $this->name;
            $log->error = $e->getMessage();
            $log->support_notified = true;
            $log->save();

            return to_route('bo.products.brands')->with('error', 'Une erreur est survenue lors de l\'ajout de la marque de produit.');
        }

    }

    public function render()
    {
        return view('livewire.backend.popups.brands.add-brand');
    }
}

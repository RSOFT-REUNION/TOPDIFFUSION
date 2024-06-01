<?php

namespace App\Livewire\Backend\Popups\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditProduct extends ModalComponent
{
    use WithFileUploads;
    public $product;
    public $name, $slug, $description, $price, $keywords, $cover;

    public function mount($product_id)
    {
        $this->product = Product::where('id', $product_id)->first();
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->getUnitPrice();
        $this->keywords = $this->product->keywords;
        $this->cover = $this->product->cover;
    }

    public function editProduct()
    {
        $this->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'keywords' => 'required|string',
        ], [
            'name.required' => 'Le nom du produit est obligatoire.',
            'description.required' => 'La description du produit est obligatoire.',
            'price.required' => 'Le prix du produit est obligatoire.',
            'price.numeric' => 'Le prix du produit doit être un nombre.',
            'keywords.required' => 'Les mots-clés du produit sont obligatoires.',
        ]);
        if($this->cover != $this->product->cover) {
            $this->validate([
                'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'cover.image' => 'Le fichier doit être une image.',
                'cover.mimes' => 'Le fichier doit être une image de type jpeg, png, jpg, gif ou svg.',
                'cover.max' => 'Le fichier ne doit pas dépasser 2 Mo.'
            ]);
        }

        $this->product->name = $this->name;
        $this->product->slug = Str::slug($this->name);
        $this->product->description = $this->description;
        $this->product->keywords = $this->keywords;
        if($this->cover != $this->product->cover) {
            $this->product->cover = Str::slug($this->name) . '.' . $this->cover->getClientOriginalExtension();
        }
        if($this->product->save()) {
            // TODO: Ajouter des logs
            if($this->price != $this->product->getUnitPrice()) {
                $this->product->setUnitPrice($this->product, $this->price);
            }

            if($this->cover != $this->product->cover) {
                // Supprimer l'ancienne image
                Storage::disk('public')->delete($this->product->cover);
                // Enregistrer la nouvelle image
                Storage::disk('public')->putFileAs('products/covers/', $this->cover, $this->product->cover);
            }

            return redirect()->route('bo.products.single', ['product_id' => $this->product->id])->with('success', 'Le produit a bien été modifié.');
        }

    }

    public function render()
    {
        return view('livewire.backend.popups.product.edit-product');
    }
}

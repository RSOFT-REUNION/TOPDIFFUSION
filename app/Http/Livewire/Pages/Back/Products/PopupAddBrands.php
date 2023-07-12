<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\ProductBrand;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class PopupAddBrands extends ModalComponent
{
    use WithFileUploads;

    public $title, $image, $url;

    protected $rules = [
        'title' => 'required|unique:product_brands,title',
        'image' => 'nullable|image|mimes:png'
    ];

    protected $messages = [
        'title.required' => "Le nom de la marque est obligatoire.",
        'title.unique' => "Cette marque existe a déjà été ajouté.",
        'image.image' => "Il ne s'agit pas d'une image.",
        'image.mimes' => "Il ne s'agit pas d'une image au format PNG.",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $this->validate();
        $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï"];
        $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i"];
        $correct_name = str_replace($characters, $correct_characters, $this->title);
        if($this->image) {
            $image_name = strtolower($correct_name). '.' . $this->image->extension();
        }

        $brand = new ProductBrand;
        $brand->title = strtoupper($this->title);
        if($this->image){
            $brand->picture = $image_name;
        }
        $brand->url = $this->url;
        if($brand->save()){
            if($this->image) {
                $this->image->storeAs('public/images/brands', $image_name);
            }
            return redirect()->route('back.product.brands');
        }
    }

    public function render()
    {
        return view('livewire.pages.back.products.popup-add-brands');
    }
}

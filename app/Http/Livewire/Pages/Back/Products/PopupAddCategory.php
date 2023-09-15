<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class PopupAddCategory extends ModalComponent
{
    use WithFileUploads;

    public $title, $description, $image, $emplacement, $slug, $professionnal, $delivery;

    protected $rules = [
        'title' => 'required|unique:product_categories,title',
        'description' => 'nullable|min:5',
        'emplacement' => 'required',
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:8096'
    ];

    protected $messages = [
        'title.required' => "Le titre est obligatoire.",
        'title.unique' => "Une catégorie existe déjà avec ce nom.",
        'description.min' => "Votre description doit comporter au moins :min caractères.",
        'emplacement.required' => "Vous devez définir un emplacement pour votre catégorie.",
        'image.image' => "Votre fichier doit être une image.",
        'image.mimes' => "Votre fichier doit être de type :mimes.",
        'image.max' => "Votre fichier ne doit pas excéder 2G"
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï"];
        $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i"];
        if ($this->slug != null) {
            $correct_slug = str_replace($characters, $correct_characters, $this->slug);
        } else {
            $correct_slug = str_replace($characters, $correct_characters, $this->title);
        }
        if ($this->image) {
            $image_name = strtolower($correct_slug) . '.' . $this->image->extension();
        }

        $cat = new ProductCategory;
        $cat->title = $this->title;
        $cat->description = $this->description;
        if ($this->image) {
            $cat->cover = $image_name;
        }
        $cat->slug = strtolower($correct_slug);
        if ($this->emplacement == '0') {
            $cat->level = $this->level = 1;
        } else {
            $cat->parent_id = $this->emplacement;
            $categories = ProductCategory::where('id', $this->emplacement)->first();
            if ($categories->level == '1') {
                $cat->level = $this->level = '2';
            } elseif ($categories->level == '2') {
                $cat->level = $this->level = '3';
            }
        }
        if ($this->delivery) {
            $cat->delivery = $this->delivery;
        } else {

            $cat->delivery = $categories->delivery;
        }
        if ($this->professionnal) {
            $cat->professionnal = 1;
        }
        if ($cat->save()) {
            // Store Image in Storage Folder
            if ($this->image) {
                $this->image->storeAs('public/images/categories', $image_name);
            }
            // Store Image in Public Folder
            // $this->image->move(public_path('images/categories'), $image_name);
            return redirect()->route('back.product.categories');
        }
    }

    public function render()
    {
        $data = [];
        $data['categories'] = ProductCategory::orderBy('id', 'asc')->where('level', '<>', 3)->get();
        return view('livewire.pages.back.products.popup-add-category', $data);
    }
}

<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;

use App\Models\ProductTemp;
use App\Models\ProductTempPictures;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddPictures extends ModalComponent
{
    use WithFileUploads;

    public $product;
    public $picture;

    protected $rules = [
        'picture' => 'required|image',
    ];

    protected $messages = [
        'picture.required' => 'Veuillez ajouter une image',
        'picture.image' => 'Le fichier doit être une image',
    ];

    public function mount($product_temp_id)
    {
        $this->product = ProductTemp::where('id', $product_temp_id)->first();
    }

    public function updated($picture)
    {
        $this->validateOnly($picture);
    }

    // Ajout de la photo en base
    public function addPicture()
    {
        $this->validate();

        $random_string = Str::random(8);
        $string = $random_string;

        $picture = new ProductTempPictures;
        $picture->product_id = $this->product->id;
        $picture->picture_url = strtolower($string) . '.' . $this->picture->extension();
        if ($picture->save()) {
            $this->picture->storeAs('public/images/products_attachment', strtolower($string) . '.' . $this->picture->extension());
        }
        $this->emit('refreshLines');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.popups.back.products.product-add.add-pictures');
    }
}

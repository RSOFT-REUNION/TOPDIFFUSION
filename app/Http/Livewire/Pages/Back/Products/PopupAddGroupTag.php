<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\ProductGroupTag;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PopupAddGroupTag extends ModalComponent
{
    public $title, $type, $description;

    protected $rules = [
        'title' => 'required|unique:product_group_tags,title',
    ];

    protected $messages = [
        'title.required' => "Le titre du group est obligatoire.",
        'title.unique' => "Ce groupe existe déjà.",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $this->validate();

        $characters = ["é", "è", "ê", "ë", "à", "&", "ç", "ù", "\"", "î", "ï"];
        $correct_characters = ["e", "e", "e", "e", "a", "", "c", "u", "", "i", "i"];
        $correct_name = str_replace($characters, $correct_characters, $this->title);

        $tag = new ProductGroupTag;
        $tag->title = strtoupper($correct_name);
        $tag->type = $this->type;
        $tag->description = $this->description;
        if($tag->save()) {
            return redirect()->route('back.product.options');
        }
    }

    public function render()
    {
        return view('livewire.pages.back.products.popup-add-group-tag');
    }
}

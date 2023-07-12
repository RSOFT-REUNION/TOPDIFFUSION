<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\ProductGroupTag;
use App\Models\ProductTag;
use Livewire\Component;

class ProductViewGroupTag extends Component
{
    public $groupTag;
    public $title, $key;

    protected $rules = [
        'title' => 'required|unique:product_tags,title',
        'key' => 'required|unique:product_tags,key',
    ];

    protected $messages = [
        'title.required' => 'Le titre est obligatoire.',
        'title.unique' => 'Ce titre existe déjà.',
        'key.required' => 'La clé est obligatoire.',
        'key.unique' => 'Cette clé existe déjà.',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount($groupTag)
    {
        $this->groupTag = ProductGroupTag::where('id', $groupTag)->first();
    }

    public function add()
    {
        $this->validate();

        $tag = new ProductTag;
        $tag->group_id = $this->groupTag->id;
        $tag->title = $this->title;
        $tag->key = $this->key;
        if($tag->save()) {
            return redirect()->route('back.product.options-tag', ['id' => $this->groupTag->id]);
        }
    }

    public function render()
    {
        $data = [];
        $data['grouptag'] = $this->groupTag;
        $data['tags'] = ProductTag::where('group_id', $this->groupTag->id)->get();
        return view('livewire.pages.back.products.product-view-group-tag',$data);
    }
}

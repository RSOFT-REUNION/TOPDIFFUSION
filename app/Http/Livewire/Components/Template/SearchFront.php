<?php

namespace App\Http\Livewire\Components\Template;

use App\Models\MyProduct;
use App\Models\Product;
use Livewire\Component;

class SearchFront extends Component
{
    public $search = '';
    public $jobs = [];

    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        if(strlen($this->search) > 1) {
            return MyProduct::where('title', 'like', $query);
        }
    }

    public function render()
    {
        $data = [];
        if($this->updatedSearch() != null){
            $data['items_result'] = $this->updatedSearch()->get()->take(5);
            dd($data['items_result']);
        } else {
            $data['items_result'] = '';
        }
        return view('livewire.components.template.search-front', $data);
    }
}

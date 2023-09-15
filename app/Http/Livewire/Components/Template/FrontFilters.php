<?php

namespace App\Http\Livewire\Components\Template;

use App\Models\bike;
use Livewire\Component;

class FrontFilters extends Component
{
    public $page;

    protected $rules = [
        'motor_brand' => 'required|string',
        'motor_cylindree' => 'required|string',
        'motor_modele' => 'required|string',
        'motor_year' => 'required|string',
    ];

    public $motor_brand, $motor_cylindree, $motor_modele, $motor_year;
    public $all_bikes_infos = [];


    public function mount()
    {
        // * Touts les cylindrés
        $this->all_bikes_infos = bike::all();
        $this->motor_cylindree = $this->all_bikes_infos;
    }

    public function render()
    {
        $searchBikeInfo = bike::all();

        if ($this->motor_brand === 'SUZUKI') {
            $searchBikeInfo->where('marque', $this->motor_brand);
            // $this->filters_count++;
        } 
        elseif ($this->motor_cylindree) {
            $searchBikeInfo->where('status', $this->motor_cylindree);
            // $this->filters_count++;
        }
        // if ($this->code && auth()->user()->isAdmin()) {
        //     $searchBikeInfo->where('code_client', 'LIKE', '%' . $this->code . '%');
        //     // $this->filters_count++;
        // }
        if ($this->motor_modele) {
            $searchBikeInfo->where('num_facture', 'LIKE', '%' . $this->motor_modele . '%');
            // $this->filters_count++;
        }
        // if ($this->start_date) {
        //     $searchBikeInfo->whereBetween('document_date', [$this->start_date, $this->end_date]);
        //     $this->filters_count++;
        // }

        $data = [];
        $data['bikesInfos'] = $searchBikeInfo;
        return view('livewire.components.template.front-filters', $data);
    }
}

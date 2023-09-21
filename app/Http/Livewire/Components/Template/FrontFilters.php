<?php

namespace App\Http\Livewire\Components\Template;

use App\Models\bike;
use App\Models\MyProduct;
use Livewire\Component;

class FrontFilters extends Component
{
    public $page;

    public $motor_brands = [];
    public $motor_cylindree = [];
    public $motor_modele = [];
    public $motor_year = [];
    public $all_bikes_infos = [];

    public $selectedBrand = null;
    public $selectedCylindree = null;
    public $selectedModele = null;
    public $selectedYear = null;

    public $selectedFilters = [
        'motor_brands' => '',
        'motor_cylindree' => '',
        'motor_modele' => '',
        'motor_year' => '',
    ];


    public function mount()
    {
        // * Touts les cylindrés
        $this->motor_brands = Bike::get(['id', 'marque'])->pluck('marque', 'id')->toArray();
        $this->motor_cylindree = Bike::get(['id', 'cylindree'])->pluck('cylindree', 'id')->toArray();
        $this->motor_modele = Bike::get(['id', 'modele'])->pluck('modele', 'id')->toArray();
        $this->motor_year = Bike::get(['id', 'annee'])->pluck('annee', 'id')->toArray();
    }

    public function search()
    {
        $query = MyProduct::query();

        // Rejoindre la table "compatible_bikes" pour obtenir les produits compatibles
        $query->join('compatible_bikes', 'my_products.id', '=', 'compatible_bikes.product_id');
        if ($this->selectedBrand) {
            // Effectuez une jointure entre la table "bikes" et "product_brands" pour obtenir l'ID de la marque
            $query->join('bikes', 'compatible_bikes.bike_id', '=', 'bikes.id')
                ->join('product_brands', 'bikes.marque', '=', 'product_brands.title')
                ->where('product_brands.id', $this->selectedBrand);
        }

        // if ($this->selectedCylindree) {
        //     // Filtrer les motos par cylindrée
        //     $query->join('bikes as selected_bike_cylindree', 'compatible_bikes.bike_id', '=', 'selected_bike_cylindree.id')
        //         ->where('selected_bike_cylindree.cylindree', $this->selectedCylindree);
        // }

        // if ($this->selectedModele) {
        //     // Filtrer les motos par modèle
        //     $query->join('bikes as selected_bike_modele', 'compatible_bikes.bike_id', '=', 'selected_bike_modele.id')
        //         ->where('selected_bike_modele.modele', $this->selectedModele);
        // }

        // if ($this->selectedYear) {
        //     // Filtrer les motos par année
        //     $query->join('bikes as selected_bike_year', 'compatible_bikes.bike_id', '=', 'selected_bike_year.id')
        //         ->where('selected_bike_year.annee', $this->selectedYear);
        // }

        // Sélectionnez les produits correspondants
        $query->select('my_products.*');

        $searchBikeInfo = $query->get();
        // dd($searchBikeInfo);

        session(['bikesInfos' => $searchBikeInfo->toArray()]);

        return redirect('/filtres');
    }




    // public function updatedSelectedFilters($filterName)
    // {
    //     // Réinitialisez les autres filtres si nécessaire
    //     // Par exemple, si vous voulez réinitialiser motor_cylindree lors de la sélection de motor_brands
    //     if ($filterName === 'motor_brands') {
    //         $this->selectedFilters['motor_cylindree'] = '';
    //     }

    //     // Appelez la méthode render pour mettre à jour les résultats
    //     $this->render();
    // }


    public function render()
    {
        // $searchBikeInfo = bike::all();
        $data = [];
        // $data['bikesInfos'] = $searchBikeInfo;

        // $query = Bike::query();


        // if ($this->selectedFilters['motor_brands']) {
        //     $query->whereIn('marque', $this->selectedFilters['motor_brands']);
        // }

        // if ($this->selectedFilters['motor_cylindree']) {
        //     $query->whereIn('cylindree', $this->selectedFilters['motor_cylindree']);
        // }

        // if ($this->selectedFilters['motor_modele']) {
        //     $query->whereIn('modele', $this->selectedFilters['motor_modele']);
        // }

        // if ($this->selectedFilters['motor_year']) {
        //     $query->whereIn('annee', $this->selectedFilters['motor_year']);
        // }

        // $searchBikeInfo = $query->get();

        // $data = [
        //     'bikesInfos' => $searchBikeInfo,
        // ];


        return view('livewire.components.template.front-filters', $data);
    }
}

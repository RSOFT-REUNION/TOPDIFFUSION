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
        // * Toutes les marques
        $this->motor_brands = Bike::get(['id', 'marque'])->pluck('marque', 'id')->toArray();

        // Chargez les cylindrées compatibles pour la marque sélectionnée
        if ($this->selectedBrand) {
            $compatibleCylindrees = Bike::where('marque', $this->selectedBrand)->get(['id', 'cylindree'])->pluck('cylindree', 'id')->toArray();
            $this->motor_cylindree = $compatibleCylindrees;
        }

        // Chargez les modèles compatibles pour la marque et la cylindrée sélectionnées
        if ($this->selectedBrand && $this->selectedCylindree) {
            $compatibleModeles = Bike::where('marque', $this->selectedBrand)
                ->where('cylindree', $this->selectedCylindree)
                ->get(['id', 'modele'])
                ->pluck('modele', 'id')
                ->toArray();
            $this->motor_modele = $compatibleModeles;
        }

        // Chargez les années compatibles pour la marque, la cylindrée et le modèle sélectionné
        if ($this->selectedBrand && $this->selectedCylindree && $this->selectedModele) {
            $compatibleYears = Bike::where('marque', $this->selectedBrand)
                ->where('cylindree', $this->selectedCylindree)
                ->where('modele', $this->selectedModele)
                ->get(['id', 'annee'])
                ->pluck('annee', 'id')
                ->toArray();
            $this->motor_year = $compatibleYears;
        }
    }



    public function search()
    {
        $query = MyProduct::query();

        // Rejoindre la table "compatible_bikes" pour obtenir les produits compatibles
        $query->join('compatible_bikes as cb1', 'my_products.id', '=', 'cb1.product_id');

        if ($this->selectedBrand) {
            $query->join('compatible_bikes as cb2', 'my_products.id', '=', 'cb2.product_id')
                ->join('bikes', 'cb2.bike_id', '=', 'bikes.id')
                ->where('bikes.marque', '=', $this->selectedBrand);
        }

        if ($this->selectedCylindree) {
            // Filtrer les motos par cylindrée
            $query->join('bikes as selected_bike_cylindree', 'cb2.bike_id', '=', 'selected_bike_cylindree.id')
                ->where('selected_bike_cylindree.cylindree', $this->selectedCylindree);
        }

        if ($this->selectedModele) {
            // Filtrer les motos par modèle
            $query->join('bikes as selected_bike_modele', 'cb2.bike_id', '=', 'selected_bike_modele.id')
                ->where('selected_bike_modele.modele', $this->selectedModele);
        }

        if ($this->selectedYear) {
            // Filtrer les motos par année
            $query->join('bikes as selected_bike_year', 'cb2.bike_id', '=', 'selected_bike_year.id')
                ->where('selected_bike_year.annee', $this->selectedYear);
        }

        // Sélectionnez les produits correspondants
        $query->select('my_products.*')->distinct();

        $searchBikeInfo = $query->get();

        // Stockez les résultats dans la session
        session(['bikesInfos' => $searchBikeInfo->toArray()]);

        // return redirect('/filtres');

        // Récupérer l'ID de la moto par rapport aux filtres séléctionnés
        $bike = bike::where('marque', $this->selectedBrand)
            ->where('cylindree', $this->selectedCylindree)
            ->where('modele', $this->selectedModele)
            ->where('annee', $this->selectedYear)
            ->first();

        // Redirigez l'utilisateur vers la page de résultats avec la moto dans les paramètres d'URL
        return redirect()->route('front.product.filtres', ['id' => $bike->id]);
    }

    public function updatedSelectedBrand($value)
    {
        if ($value) {
            $compatibleCylindrees = Bike::where('marque', $value)->get(['id', 'cylindree'])->pluck('cylindree', 'id')->toArray();
            $this->motor_cylindree = $compatibleCylindrees;
        } else {
            // Réinitialisez les cylindrées si aucune marque n'est sélectionnée
            $this->motor_cylindree = [];
        }

        // Réinitialisez les autres filtres
        $this->selectedCylindree = null;
        $this->selectedModele = null;
        $this->selectedYear = null;
    }

    public function updatedSelectedCylindree($value)
    {
        if ($this->selectedBrand && $value) {
            $compatibleModeles = Bike::where('marque', $this->selectedBrand)
                ->where('cylindree', $value)
                ->get(['id', 'modele'])
                ->pluck('modele', 'id')
                ->toArray();
            $this->motor_modele = $compatibleModeles;
        } else {
            // Réinitialisez les modèles si aucune marque ou cylindrée n'est sélectionnée
            $this->motor_modele = [];
        }

        // Réinitialisez les autres filtres
        $this->selectedModele = null;
        $this->selectedYear = null;
    }


    public function updatedSelectedModele($value)
    {
        if ($this->selectedBrand && $this->selectedCylindree && $value) {
            $compatibleYears = Bike::where('marque', $this->selectedBrand)
                ->where('cylindree', $this->selectedCylindree)
                ->where('modele', $value)
                ->get(['id', 'annee'])
                ->pluck('annee', 'id')
                ->toArray();
            $this->motor_year = $compatibleYears;
        } else {
            // Réinitialisez les années si aucune marque, cylindrée ou modèle n'est sélectionné
            $this->motor_year = [];
        }

        // Réinitialisez les autres filtres
        $this->selectedYear = null;
    }

    public function render()
    {
        $data = [];
        $data['page'] = 'filters';

        return view('livewire.components.template.front-filters', $data);
    }
}

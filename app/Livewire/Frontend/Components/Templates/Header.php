<?php

namespace App\Livewire\Frontend\Components\Templates;

use App\Models\ProductCategory;
use App\Models\UserCart;
use Livewire\Component;

class Header extends Component
{
    public $email, $password;
    public $prices;
    public $child_categories;

    protected $listeners = ['cartUpdated'];

    public function mount()
    {
        if(auth()->check())
            $this->prices = auth()->user()->settings()->public_price;
    }
    public function categorySelected($id)
    {
        // Recherche les catégories enfant lié et les affiches dans une variable
        $this->child_categories = ProductCategory::where('parent_id', $id)->where('parent_id_2', null)->orderBy('name')->get();
    }

    // Espace de connexion
    public function login()
    {
        $result = auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if($result) {
            return to_route('fo.home')->with('success', 'Vous êtes connecté');
        } else {
            return to_route('fo.home')->with('error', 'Email ou mot de passe incorrect');
        }
    }

    // Fonction de déconnexion
    public function logout()
    {
        auth()->logout();
        return to_route('fo.home')->with('success', 'Vous êtes déconnecté');
    }

    // Fonction permettant de mettre à jour les tarifs affichés
    public function selectPrices()
    {
        $this->prices = auth()->user()->settings()->public_price;
        if($this->prices == 1) {
            auth()->user()->settings()->update(['public_price' => 0]);
        } else {
            auth()->user()->settings()->update(['public_price' => 1]);
        }

        $this->dispatch('cartUpdated');
    }

    public function render()
    {

        $data = [];
        $data['parent_categories'] = ProductCategory::where('parent_id', null)->orderBy('name')->get();
        $data['child_categories'] = $this->child_categories;
        $data['child_categories_2'] = ProductCategory::where('parent_id', '<>', null)->where('parent_id_2', '<>', null)->orderBy('name', 'asc')->get();
        if(auth()->check()) {
            $data['cart_count'] = UserCart::where('user_id', auth()->user()->id)->first();
        } else {
            $data['cart_count'] = null;
        }
        return view('livewire.frontend.components.templates.header', $data);
    }
}

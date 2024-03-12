<?php

namespace App\Http\Livewire\Pages\Back\Settings;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Models\ProductTaxes;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Payment extends Component
{
    public $merchantId, $accessKey;
    public $config_path;

    public function mount()
    {
        $this->merchantId = Config::get('payment.merchant_id');
        $this->accessKey = Config::get('payment.access_key');
        $this->config_path = config_path('payment.php');
    }

    // FIXME: Il faut cliquer deux fois sur envoyer pour que les fonctions s'executes

    // Mettre à jour le numéro de commerçant dans les variables config
    public function updateMerchandID()
    {
        // Lire le contenu du fichier
        $config = File::get($this->config_path);

        // Remplacement de l'ancienne valeur par la nouvelle valeur
        $config = preg_replace(
            "/'merchant_id' => '(.*?)'/",
            "'merchant_id' => '{$this->merchantId}'",
            $config
        );

        // Écrivez le contenu mis à jour dans le fichier de configuration
        File::put($this->config_path, $config);

        if(Artisan::call('optimize')) {
            Session::flash('success', "Votre numéro de commerçant s'est bien mis à jour");
            return redirect()->route('back.setting.payment');
        }


    }

    // Mettre à jour la clé d'accès dans les variables config
    public function updateAccessKey()
    {
        // Lire le contenu du fichier
        $config = File::get($this->config_path);

        // Remplacement de l'ancienne valeur par la nouvelle valeur
        $config = preg_replace(
            "/'access_key' => '(.*?)'/",
            "'access_key' => '{$this->accessKey}'",
            $config
        );

        // Écrivez le contenu mis à jour dans le fichier de configuration
        File::put($this->config_path, $config);

        Artisan::call('optimize');
        sleep(5);
        Session::flash('success', "Votre clé d'accès s'est bien mise à jour");
        return redirect()->route('back.setting.payment');
    }

    public function render()
    {
        $data = [];
        $data['taxes'] = ProductTaxes::orderBy('rate', 'asc')->get();
        return view('livewire.pages.back.settings.payment', $data);
    }
}

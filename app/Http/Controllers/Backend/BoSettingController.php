<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoSettingController extends Controller
{
    // Affichage de la page des réglèments
    public function showPaymentSetting()
    {
        $data = [
            'group_page' => 'backend',
            'page' => 'payment',
        ];
        return view('pages.backend.settings.setting_payment', $data);
    }

    // Affichage de la page de livraison
    public function showShippingSetting()
    {
        $data = [
            'group_page' => 'backend',
            'page' => 'shipping',
        ];
        return view('pages.backend.settings.setting_shipping', $data);
    }

    // Affichage de la page de livraison
    public function showSetting()
    {
        $data = [
            'group_page' => 'backend',
            'page' => 'settings',
        ];
        return view('pages.backend.settings.setting', $data);
    }

    // Affichage de la page de livraison
    public function showTeamSetting()
    {
        $data = [
            'group_page' => 'backend',
            'page' => 'teams',
        ];
        return view('pages.backend.settings.setting_teams', $data);
    }
}

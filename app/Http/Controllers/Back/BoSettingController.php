<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoSettingController extends Controller
{
    /*
     * Show General settings
     */
    public function showSettingGeneral()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['page'] = 'general';
        return view('pages.backend.settings.setting-general', $data);
    }

    /*
     * Show Payment and Tax settings
     */
    public function showSettingPayment()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['page'] = 'payment';
        return view('pages.backend.settings.setting-payment', $data);
    }

    /*
     * Show avanced settings
     */
    public function showSettingAvanced()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['page'] = 'avanced';
        return view('pages.backend.settings.setting-avancee', $data);
    }

    /*
     * Show perform settings
     */
    public function showSettingPerform()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['page'] = 'perform';
        return view('pages.backend.settings.setting-perform', $data);
    }
}

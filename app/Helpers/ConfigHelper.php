<?php

namespace App\Helpers;

use App\Models\Setting;

Class ConfigHelper {

    public static function getSettings() {
        $setting = Setting::all();
        if($setting) {
            return Setting::pluck('value', 'key')->all();
        }
    }
}

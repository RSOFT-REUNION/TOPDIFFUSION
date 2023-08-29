<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SettingGeneral;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class RedirectIfMaintenanceModeActive
{
    public function hanlde (Request $request, Closure $next)
    {
        $maintenanceMode = SettingGeneral::where('maintenance_mode', 1)->first();
        
        if(!$maintenanceMode && !auth()->user()->admin == 1) {
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
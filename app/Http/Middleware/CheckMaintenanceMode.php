<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SettingGeneral;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        $maintenanceMode = SettingGeneral::where('maintenance_mode', 1)->first();
        if ($maintenanceMode) {
            if (!auth()->guest()) {
                if (auth()->user()->admin == 1) {
                    return $next($request);
                } else {
                    return redirect()->view('errors.503');
                }
            } else {
                return redirect()->route('maintenance');
            }
        }
        return $next($request);
    }
}

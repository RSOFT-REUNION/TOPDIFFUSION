<?php

namespace App\Http\Middleware;

use App\Models\MyProductPromotion;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckExpiredPromotions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $today = now();

        $allPromotions = MyProductPromotion::all();

        foreach ($allPromotions as $promotion) {
            if (!$promotion->is_manually_activated) {
                if (!is_null($promotion->start_date) && !is_null($promotion->end_date)) {
                    if ($promotion->start_date <= $today && $promotion->end_date >= $today && !$promotion->active) {
                        $promotion->active = 1;
                        $promotion->save();
                    } elseif ($promotion->end_date < $today && $promotion->active) {
                        $promotion->active = 0;
                        $promotion->save();
                    }
                }
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackController extends Controller
{
    public function showDashboard()
    {
        $data = [];
        $data['group'] = 'home';
        $data['page'] = 'dashboard';
        return view('pages.backend.dashboard', $data);
    }

    public function showTeam()
    {
        $data= [];
        $data['group'] = 'home';
        $data['page'] = 'team';
        return view('pages.backend.team.team', $data);
    }
}

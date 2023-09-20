<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $data['userAdmin'] = User::where('team', 1)->get();
        return view('pages.backend.team.team', $data);
    }
}

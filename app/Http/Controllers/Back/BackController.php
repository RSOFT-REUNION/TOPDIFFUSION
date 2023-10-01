<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\MessagesGroups;
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

    public function showSav()
    {
        $data= [];
        $data['group'] = 'home';
        $data['page'] = 'sav';
        $data['userAdmin'] = User::where('team', 1)->get();
        return view('pages.backend.sav.sav', $data);
    }

    public function showSingleSav($id)
    {
        $ticket_user = MessagesGroups::where('id', $id)->first();
        $data = [];
        $data['ticket'] = MessagesGroups::where('id', $id)->first();
        $data['nav_page'] = 'customers';
        $data['user'] = User::where('id', $ticket_user->user_id)->first();
        $data['messages'] = Messages::where('ticket_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.frontend.sav.sav-single', $data);
    }

    public function showAbout()
    {
        $data= [];
        $data['group'] = 'home';
        $data['page'] = 'about';
        $data['userAdmin'] = User::where('team', 1)->get();
        return view('pages.backend.about.about', $data);
    }
}

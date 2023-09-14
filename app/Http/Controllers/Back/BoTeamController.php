<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use App\Models\UserBike;
use App\Models\UserData;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoTeamController extends Controller
{
    public function showListTeam()
    {
        $data = [];
        $data['group'] = 'teams';
        $data['page'] = 'list';
        return view('pages.backend.users.team-list', $data);
    }

    public function showSingleMember($user)
    {
        $selectedUser = User::where('customer_code', $user)->first();
        
        $data = [];
        $data['group'] = 'teams';
        $data['page'] = 'list';
        $data['user'] = $selectedUser;
        $data['userData'] = UserData::where('user_id', $selectedUser->id)->first();
        $data['userAddress'] = UserAddress::where('user_id', $selectedUser->id)->get();
        $data['userBikes'] = UserBike::where('user_id', $selectedUser->id)->get();
        return view('pages.backend.users.team-single', $data);
    }
    
}

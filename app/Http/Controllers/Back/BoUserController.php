<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserBike;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use view;

class BoUserController extends Controller
{
    public function showUserList()
    {
        $data = [];
        $data['group'] = 'users';
        $data['page'] = 'list';
        return view('pages.backend.users.users-list', $data);
    }

    public function showUserSingle($user)
    {
        $selectedUser = User::where('customer_code', $user)->first();

        $data = [];
        $data['group'] = 'users';
        $data['page'] = 'list';
        $data['user'] = $selectedUser;
        $data['userData'] = UserData::where('user_id', $selectedUser->id)->first();
        $data['userAddress'] = UserAddress::where('user_id', $selectedUser->id)->get();
        $data['userBikes'] = UserBike::where('user_id', $selectedUser->id)->get();
        return view('pages.backend.users.users-single', $data);
    }

    public function showUserGroup()
    {
        $data = [];
        $data['group'] = 'users';
        $data['page'] = 'group_user';
        return view('pages.backend.users.group-users', $data);
    }

    /*
     * Validate professionnal account
     */
    public function validateProfessionnal($user)
    {
        $selectedUser = User::where('customer_code', $user)->first();
        $selectedUser->verified = 1;
        $selectedUser->verified_at = Carbon::now();
        if ($selectedUser->update()) {
            return redirect()->route('back.user.single', ['user' => $selectedUser->customer_code]);
        }
    }
}

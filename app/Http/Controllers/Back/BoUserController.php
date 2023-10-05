<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\CustomerGroup;
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
//        $data['user'] = $selectedUser;
        $data['groupUser'] = CustomerGroup::all();
        $data['user'] = User::with('customerGroupId')->find($selectedUser->id);
        $data['availableGroups'] = CustomerGroup::where('id', '!=', $data['user']->customerGroupId->id)->get();
        $data['userData'] = UserData::where('user_id', $selectedUser->id)->first();
        $data['userAddress'] = UserAddress::where('user_id', $selectedUser->id)->get();
        $data['userBikes'] = UserBike::where('user_id', $selectedUser->id)->get();
        return view('pages.backend.users.users-single', $data);
    }

    public function moveUserToAnotherGroup(Request $request, $user)
    {
        // Récupérez le nouvel ID de groupe à partir de la requête
        $newGroupId = $request->input('newGroup');

        // Assurez-vous que l'utilisateur existe et que le nouveau groupe existe
        $foundUser = User::find($user);
        $newGroup = CustomerGroup::find($newGroupId);

        if (!$foundUser || !$newGroup) {
            // Gérez les erreurs si l'utilisateur ou le groupe n'existe pas
            return false;
        }

        // Obtenez l'ancien groupe de l'utilisateur
        $oldGroupId = $foundUser->customer_group_id;

        // Détachez l'utilisateur de l'ancien groupe s'il était déjà associé
        if ($oldGroupId) {
            $oldGroup = CustomerGroup::find($oldGroupId);
            if ($oldGroup) {
                $oldGroup->users()->detach($foundUser->id);
            }
        }

        // Associez l'utilisateur au nouveau groupe
        $newGroup->users()->attach($foundUser->id);

        // Mettez à jour l'ID du groupe pour l'utilisateur
        $foundUser->customer_group_id = $newGroupId;

        if ($foundUser->save()) {
            return back()->with('success', $foundUser->firstname . ' ' . $foundUser->lastname . ' a bien été changé de groupe.');
        } else {
            return back()->with('success', 'Changement non effectué.');
        }
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
    public function validateProfessional($user)
    {
        $selectedUser = User::where('customer_code', $user)->first();
        $selectedUser->verified = 1;
        $selectedUser->verified_at = Carbon::now();
        if ($selectedUser->update()) {
            return redirect()->route('back.user.single', ['user' => $selectedUser->customer_code]);
        }
    }
}

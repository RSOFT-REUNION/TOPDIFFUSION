<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MyProduct;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\SettingGeneral;
use App\Models\UserAddress;
use App\Models\UserBike;
use App\Models\UserData;
use App\Models\UserSetting;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function showMaintenance()
    {
        $data = [];
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.maintenance-page', $data);
    }

    public function showHome()
    {
        $data = [];
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        if(auth()->user()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get()->take(6);
        $data['brands'] = ProductBrand::all()->take(4);
        return view('pages.frontend.home', $data);
    }

    /*----------- SIGN ------------*/
    public function showLogin()
    {
        return view('pages.frontend.sign.sign-in');
    }

    public function testFlash()
    {
        return redirect()->route('front.home');
    }

    public function postLogin()
    {
        $result = auth()->attempt([
           'email' => request('email'),
           'password' => request('password'),
        ]);

        if($result) {
            return redirect()->route('front.home');
        } else {
            return back()->withInput()->withErrors([
                'error_input' => 'Votre adresse e-mail ou votre mot de passe est incorrect.'
            ]);
        }
    }

    public function showRegister()
    {
        return view('pages.frontend.sign.sign-up');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('front.home');
    }

    /*----------- PROFILE ------------*/
    public function showProfile()
    {
        $data = [];
        $data['me'] = auth()->user();
        $data['meData'] = UserData::where('user_id', auth()->user()->id)->first();
        $data['addresses'] = UserAddress::where('user_id', auth()->user()->id)->get();
        $data['account_page'] = 'informations';
        return view('pages.frontend.profile.my-account', $data);
    }

    /*
     * Delete address selected
     */
    public function deletedAddress($id)
    {
        $address = UserAddress::where('id', $id)->first();
        $address->delete();
        return redirect()->route('front.profile');
    }

    public function showProfileBikes()
    {
        $data = [];
        $data['me'] = auth()->user();
        $data['nav-sidebar'] = auth()->user();
        $data['bikes'] = UserBike::where('user_id', auth()->user()->id)->get();
        $data['account_page'] = 'bikes';
        return view('pages.frontend.profile.my-bikes', $data);
    }

    /*
     * Delete bike selected
     */
    public function deletedBike($id)
    {
        $bike = UserBike::where('id', $id)->first();
        $bike->delete();
        return redirect()->route('front.profile.bikes');
    }

}

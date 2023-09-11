<?php

namespace App\Http\Controllers\Front;

use App\Models\Pages;
use App\Models\Product;
use App\Models\UserBike;
use App\Models\UserData;
use App\Models\MyProduct;
use App\Models\UserAddress;
use App\Models\UserSetting;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Models\SettingGeneral;
use App\Http\Controllers\Controller;
use App\Models\CarrouselHome;
use App\Models\MyFavorite;
use Illuminate\Support\Carbon;


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
        if (auth()->user()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        $data['page'] = 'home';
        $data['carrousel'] = CarrouselHome::get()->first();
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get()->take(6);
        $data['brands'] = ProductBrand::all()->take(4);
        return view('pages.frontend.home', $data);
    }

    /*----------- SIGN ------------*/
    public function showLogin()
    {
        $data = [];
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['page'] = 'login';
        return view('pages.frontend.sign.sign-in', $data);
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

        if ($result) {
            return redirect()->route('front.home');
        } else {
            return back()->withInput()->withErrors([
                'error_input' => 'Votre adresse e-mail ou votre mot de passe est incorrect.'
            ]);
        }
    }

    public function showRegister()
    {
        $data = [];
        $data['page'] = 'register';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.sign.sign-up', $data);
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
        $data['page'] = 'profil';
        $data['account_page'] = 'informations';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
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
        $data['page'] = 'bikes';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
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

    /**
     *  Legal information
     */

    //! a verifier
    // public function showTest()
    // {)
    //     $data = [];
    //     $data['group'] = 'legal';
    //     $data['page'] = 'test';
    //     $data['setting'] = SettingGeneral::where('id', 1)->first();
    //     return view('pages.frontend.legal.about', $data);
    // }



    public function showFavorite(Request $request)
    {
        $data = [];
        $data['me'] = auth()->user();
        $data['page'] = 'favorite';
        $data['account_page'] = 'favoris';
        $data['setting'] = SettingGeneral::where('id', 1)->first();

        $favoriteRecords = MyFavorite::where('user_id', auth()->user()->id)->get();

        $favoriteProducts = [];

        foreach ($favoriteRecords as $favoriteRecord) {

            $product = MyProduct::find($favoriteRecord->product_id);

            if ($product) {
                $favoriteProducts[] = $product;
            }
        }

        $data['favoriteUser'] = $favoriteProducts;

        if ($request->route()->getName() === 'front.myFavorite') {
            return view('pages.frontend.profile.my-favorite', $data);
        } else {
            return view('pages.frontend.favorites.favorites', $data);
        }
    }

    public function showAbout()
    {
        $page_date = Pages::where('key', 'about')->first();
        Carbon::setLocale('fr');
        $date = Carbon::parse($page_date->created_at);
        $month = ucfirst($date->isoFormat('MMMM'));
        $year = $date->isoFormat('YYYY');
        $formattedDate = "$month $year";
        $data = [];
        $data['formattedDate'] = $formattedDate;
        $data['group'] = 'legal';
        $data['page'] = 'about';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['pageContent'] = Pages::where('key', 'about')->first();
        return view('pages.frontend.legal.about', $data);
    }

    public function showLegal()
    {
        $page_date = Pages::where('key', 'legal')->first();
        Carbon::setLocale('fr');
        $date = Carbon::parse($page_date->created_at);
        $month = ucfirst($date->isoFormat('MMMM'));
        $year = $date->isoFormat('YYYY');
        $formattedDate = "$month $year";
        $data = [];
        $data['formattedDate'] = $formattedDate;
        $data['group'] = 'legal';
        $data['page'] = 'legal';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['pageContent'] = Pages::where('key', 'legal')->first();
        return view('pages.frontend.legal.legal-mentions', $data);
    }

    public function showConfidential()
    {
        $page_date = Pages::where('key', 'confidential')->first();
        Carbon::setLocale('fr');
        $date = Carbon::parse($page_date->created_at);
        $month = ucfirst($date->isoFormat('MMMM'));
        $year = $date->isoFormat('YYYY');
        $formattedDate = "$month $year";
        $data = [];
        $data['formattedDate'] = $formattedDate;
        $data['group'] = 'legal';
        $data['page'] = 'confidential';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['pageContent'] = Pages::where('key', 'confidential')->first();
        return view('pages.frontend.legal.confidential', $data);
    }

    public function showFaq()
    {
        $page_date = Pages::where('key', 'faq')->first();
        Carbon::setLocale('fr');
        $date = Carbon::parse($page_date->created_at);
        $month = ucfirst($date->isoFormat('MMMM'));
        $year = $date->isoFormat('YYYY');
        $formattedDate = "$month $year";
        $data = [];
        $data['formattedDate'] = $formattedDate;
        $data['group'] = 'legal';
        $data['page'] = 'faq';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['pageContent'] = Pages::where('key', 'faq')->first();
        return view('pages.frontend.legal.faq', $data);
    }
}

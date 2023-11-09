<?php

namespace App\Http\Controllers\Front;

use App\Models\Faq;
use App\Models\Pages;
use App\Models\UserBike;
use App\Models\UserData;
use App\Models\MyProduct;
use App\Models\UserOrder;
use App\Models\MyFavorite;
use App\Models\UserAddress;
use App\Models\UserSetting;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Models\CarrouselHome;
use App\Models\UserOrderItem;
use App\Models\SettingGeneral;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\MessagesGroups;
use Illuminate\Support\Facades\Auth;


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
        $data['savGroup'] = MessagesGroups::where('user_id', Auth::id())->first();
        return view('pages.frontend.profile.my-account', $data);
    }

    public function showCommandsInvoices()
    {
        $data = [];
        $data['me'] = auth()->user();
        $data['meData'] = UserData::where('user_id', auth()->user()->id)->first();
        $data['addresses'] = UserAddress::where('user_id', auth()->user()->id)->get();
        $data['page'] = 'commands';
        $data['account_page'] = 'commands';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['orders'] = UserOrder::where('user_id', $data['me']->id)->get();
        return view('pages.frontend.profile.my-command-invoice', $data);
    }

    // Affichage d'une commande seule
    public function showSingleOrder($order)
    {
        $my_order = UserOrder::where('document_number', $order)->first();

        $data = [];
        $data['me'] = auth()->user();
        $data['group'] = 'orders';
        $data['page'] = 'orders';
        $data['account_page'] = 'commands';
        $data['order'] = $my_order;
        $data['order_items'] = UserOrderItem::where('order_id', $my_order->id)->get();
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.orders.order-single', $data);
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

    public function showProfileSav()
    {
        $data = [];
        $data['me'] = auth()->user();
        $data['nav-sidebar'] = auth()->user();
        $data['account_page'] = 'sav';
        $data['page'] = 'sav';
        // $data['order'] = UserOrder::where('document_number', $command_number)->first();
        // print_r($data['order']);
        $data['savGroup'] = MessagesGroups::where('user_id', Auth::id())->get();
        $data['sav'] = MessagesGroups::where('user_id', Auth::id())->first();
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.profile.my-sav', $data);
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
    public function showFavorite(Request $request, $sort = 'desc')
    {
        $data = [];
        $data['me'] = auth()->user();
        $data['page'] = 'favorite';
        $data['account_page'] = 'favoris';
        $data['setting'] = SettingGeneral::where('id', 1)->first();

        // $favoriteRecords = MyFavorite::where('user_id', auth()->user()->id)->get();
        if ($sort === 'asc') {
            $favoriteRecords = MyFavorite::where('user_id', auth()->user()->id)->orderBy('created_at', 'asc')->get();
        } else {
            $favoriteRecords = MyFavorite::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        }

        $favoriteProducts = [];

        foreach ($favoriteRecords as $favoriteRecord) {

            $product = MyProduct::find($favoriteRecord->product_id);

            if ($product) {
                $favoriteProducts[] = $product;
            }
        }

        $data['product'] = $favoriteProducts;
        $data['totalFavorites'] = $favoriteRecords->count();

        if ($request->route()->getName() === 'front.myFavorite') {
            return view('pages.frontend.profile.my-favorite', $data);
        } else {
            return view('pages.frontend.favorites.favorites', $data);
        }
    }

    public function showAbout()
    {
        $page_date = Pages::where('key', 'about')->first();
        $data = [];
        if ($page_date) {
            Carbon::setLocale('fr');
            $date = Carbon::parse($page_date->created_at);
            $month = ucfirst($date->isoFormat('MMMM'));
            $year = $date->isoFormat('YYYY');
            $formattedDate = "$month $year";
            $data['formattedDate'] = $formattedDate;
        }
        $data['group'] = 'legal';
        $data['page'] = 'about';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['pageContent'] = Pages::where('key', 'about')->first();
        return view('pages.frontend.legal.about', $data);
    }

    public function showLegal()
    {
        $page_date = Pages::where('key', 'legal')->first();
        $data = [];
        if ($page_date) {
            Carbon::setLocale('fr');
            $date = Carbon::parse($page_date->created_at);
            $month = ucfirst($date->isoFormat('MMMM'));
            $year = $date->isoFormat('YYYY');
            $formattedDate = "$month $year";
            $data['formattedDate'] = $formattedDate;
        }
        $data['group'] = 'legal';
        $data['page'] = 'legal';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['pageContent'] = Pages::where('key', 'legal')->first();
        return view('pages.frontend.legal.legal-mentions', $data);
    }

    public function showConfidential()
    {
        $page_date = Pages::where('key', 'confidential')->first();
        $data = [];
        if ($page_date) {
            Carbon::setLocale('fr');
            $date = Carbon::parse($page_date->created_at);
            $month = ucfirst($date->isoFormat('MMMM'));
            $year = $date->isoFormat('YYYY');
            $formattedDate = "$month $year";
            $data['formattedDate'] = $formattedDate;
        }
        $data['group'] = 'legal';
        $data['page'] = 'confidential';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['pageContent'] = Pages::where('key', 'confidential')->first();
        return view('pages.frontend.legal.confidential', $data);
    }

    public function showFaq()
    {
        $data = [];

        // Récupérez la FAQ la plus récente en fonction de la date de création ou de modification
        $latestFaq = Faq::orderBy('updated_at', 'desc')->first();

        if ($latestFaq) {
            Carbon::setLocale('fr');
            $date = Carbon::parse($latestFaq->updated_at); // Utilisez la date de mise à jour de la FAQ la plus récente
            $month = ucfirst($date->isoFormat('MMMM'));
            $year = $date->isoFormat('YYYY');
            $formattedDate = "$month $year";
            $data['formattedDate'] = $formattedDate;
        }

        $data['group'] = 'legal';
        $data['page'] = 'faq';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['Faq'] = Faq::first();

        return view('pages.frontend.legal.faq', $data);
    }


    public function filtres()
    {
        $data = [];
        $data['page'] = 'filters';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        $data['bikesInfos'] = session('bikesInfos', []);
        return view('filtres', $data);
    }
}

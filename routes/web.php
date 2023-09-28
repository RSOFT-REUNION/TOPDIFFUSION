<?php

use App\Http\Controllers\Back\BoOrderController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\PagesLegal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Back\BackController;
use App\Http\Controllers\Back\LegalController;
use App\Http\Controllers\Back\BoTeamController;
use App\Http\Controllers\Back\BoUserController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Back\BoProductController;
use App\Http\Controllers\Back\BoSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', [FrontController::class, 'testFlash'])->name('test-flash');

Route::get('/', [FrontController::class, 'showHome'])->name('front.home');
Route::get('/connexion', [FrontController::class, 'showLogin'])->name('front.login');
Route::post('/connexion', [FrontController::class, 'postLogin']);
Route::get('/inscription', [FrontController::class, 'showRegister'])->name('front.register');
Route::get('/deconnexion', [FrontController::class, 'logout'])->name('logout');

Route::get('/produit-{slug}', [ProductController::class, 'showProduct'])->name('front.product');
Route::get('/produit', [ProductController::class, 'showProductListAll'])->name('front.product-all');
Route::get('/liste-produit/categorie-{slug}', [ProductController::class, 'showProductList'])->name('front.product.list');

Route::middleware(['App\Http\Middleware\RedirectIfMaintenanceModeActive'])->group(function () {
    Route::get('/maintenance', [ErrorController::class, 'showErrorMaintenance'])->name('maintenance');
    Route::post('/maintenance', [FrontController::class, 'postLogin']);
});

// It's a user
Route::group([
    'middleware' => ['App\Http\Middleware\Customer', 'App\Http\Middleware\CheckMaintenanceMode']
], function () {
    Route::get('/profil', [FrontController::class, 'showProfile'])->name('front.profile');
    Route::get('/profil/suppression/adresse-{id}', [FrontController::class, 'deletedAddress'])->name('front.profile.delete.address');
    Route::get('/profil/mes-motos', [FrontController::class, 'showProfileBikes'])->name('front.profile.bikes');
    Route::get('/profil/mes-motos/suppression-{id}', [FrontController::class, 'deletedBike'])->name('front.profile.delete.bikes');
    Route::get('/profil/mes-favoris', [FrontController::class, 'showFavorite'])->name('front.myFavorite');
    Route::get('/favoris/{sort?}', [FrontController::class, 'showFavorite'])->name('front.favorite');
    Route::get('/a-propos', [FrontController::class, 'showAbout'])->name('front.about');
    Route::get('/politique-de-confidentialite', [FrontController::class, 'showConfidential'])->name('front.confidential');
    Route::get('/informations-legales', [FrontController::class, 'showlegal'])->name('front.legal');
    Route::get('/faq-1', [FrontController::class, 'showFaq'])->name('front.faq');
    Route::get('/mon-panier', [CartController::class, 'showCart'])->name('front.cart');
    // Ne pas oulbier de changer
});

// It's a team member
Route::group([
    'middleware' => 'App\Http\Middleware\Team'
], function () {
    Route::prefix('/espace-personnel')->group(function () {
        Route::get('/', [BackController::class, 'showDashboard'])->name('back.dashboard');

        Route::prefix('/produits')->group(function () {
            Route::get('/liste', [BoProductController::class, 'showProductList'])->name('back.product.list');
            Route::get('/creation', [BoProductController::class, 'createProduct'])->name('back.product.create');
            Route::get('/creer-un-produit-{id}', [BoProductController::class, 'showCreateProduct'])->name('back.product.show.create');
            Route::get('/ajout-{id}-{product}', [BoProductController::class, 'showAddProduct'])->name('back.product.add');
            Route::get('/categories', [BoProductController::class, 'showProductCategories'])->name('back.product.categories');
            Route::get('/categories-{id}', [BoProductController::class, 'showSingleProductCategories'])->name('back.product.single.categories');
            Route::get('/motos', [BoProductController::class, 'showProductBikes'])->name('back.product.bikes');
            Route::get('/marques', [BoProductController::class, 'showProductBrands'])->name('back.product.brands');
            Route::get('/options', [BoProductController::class, 'showProductOptions'])->name('back.product.options');
            Route::get('/options/{id}', [BoProductController::class, 'showProductViewGroupTag'])->name('back.product.options-tag');
            Route::get('/stocks', [BoProductController::class, 'showProductStocks'])->name('back.product.stocks');
            Route::get('/promotions', [BoProductController::class, 'showPromotions'])->name('back.product.promotions');
            Route::get('/promotions-create', [BoProductController::class, 'showCreatePromotions'])->name('back.product.promotions-create');
            Route::get('/promotions-groupe/{id}', [BoProductController::class, 'showGroupPromotions'])->name('back.product.promotions-group');
            Route::get('/team', [BackController::class, 'showTeam'])->name('back.team');
            Route::get('/sav', [BackController::class, 'showSav'])->name('back.sav');
            Route::get('/a-propos', [BackController::class, 'showAbout'])->name('back.about');
        });

        Route::prefix('/mes-pages')->group(function () {
            // Route::get('/', [LegalController::class, 'showTest'])->name('bouton.test');
            Route::get('/a-propos', [LegalController::class, 'showAbout'])->name('about');
            Route::post('/a-propos', [LegalController::class, 'postAbout'])->name('post.about');
            Route::get('/informations-legales', [LegalController::class, 'showLegal'])->name('legal');
            Route::post('/informations-legales', [LegalController::class, 'postLegal'])->name('post.legal');
            Route::get('/politique-de-confidentialite', [LegalController::class, 'showConfidential'])->name('confidential');
            Route::post('/politique-de-confidentialite', [LegalController::class, 'postConfidential'])->name('post.confidential');
            Route::get('/faq', [LegalController::class, 'showFaq'])->name('faq');
            Route::post('/faq', [LegalController::class, 'postFaq']);
        });

        Route::prefix('/clients')->group(function () {
            Route::get('/liste', [BoUserController::class, 'showUserList'])->name('back.user.list');
            Route::get('/groupes-clients', [BoUserController::class, 'showUserGroup'])->name('back.user.userGroup');
            Route::get('/{user}', [BoUserController::class, 'showUserSingle'])->name('back.user.single');
            Route::get('/{user}/verified', [BoUserController::class, 'validateProfessionnal'])->name('back.user.verified');
        });

        Route::prefix('/reglages')->group(function () {
            Route::get('/', [BoSettingController::class, 'showSettingGeneral'])->name('back.setting');
            Route::get('/paiement-et-taxes', [BoSettingController::class, 'showSettingPayment'])->name('back.setting.payment');
            Route::get('/avance', [BoSettingController::class, 'showSettingAvanced'])->name('back.setting.avanced');
            Route::get('/performance', [BoSettingController::class, 'showSettingPerform'])->name('back.setting.perform');
            Route::get('/information', [BoSettingController::class, 'showSettingInfo'])->name('back.setting.info');
        });

        Route::prefix('/commandes-factures')->group(function () {
            Route::get('/commandes', [BoOrderController::class, 'showOrders'])->name('back.orders.orders');
            Route::get('/commandes/{order}', [BoOrderController::class, 'showSingleOrder'])->name('back.orders.single');
            Route::get('show-invoice', [BoOrderController::class, 'showInvoiceFile'])->name('back.orders.showInvoice');
        });

        Route::get('/a-propos', [BackController::class, 'showAboutSite'])->name('back.aboutSite');
    });
});

// Routes pour le paiement
Route::get('/returnURL', [CartController::class, 'showPaymentReturn']);
Route::get('/filtres', [FrontController::class, 'filtres']);

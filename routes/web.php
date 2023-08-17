<?php

use App\Http\Controllers\Back\BackController;
use App\Http\Controllers\Back\BoProductController;
use App\Http\Controllers\Back\BoSettingController;
use App\Http\Controllers\Back\BoUserController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::get('/liste-produit/categorie-{slug}', [ProductController::class, 'showProductList'])->name('front.product.list');

// It's a user
Route::group([
    'middleware' => 'App\Http\Middleware\Customer'
], function () {
    Route::get('/profil', [FrontController::class, 'showProfile'])->name('front.profile');
    Route::get('/profil/suppression/adresse-{id}', [FrontController::class, 'deletedAddress'])->name('front.profile.delete.address');
    Route::get('/profil/mes-motos', [FrontController::class, 'showProfileBikes'])->name('front.profile.bikes');
    Route::get('/profil/mes-motos/suppression-{id}', [FrontController::class, 'deletedBike'])->name('front.profile.delete.bikes');
});

// It's a team member
Route::group([
    'middleware' => 'App\Http\Middleware\Team'
], function () {
    Route::prefix('/espace-personnel')->group(function (){
        Route::get('/', [BackController::class, 'showDashboard'])->name('back.dashboard');

        Route::prefix('/produits')->group(function (){
            Route::get('/liste', [BoProductController::class, 'showProductList'])->name('back.product.list');
            Route::get('/creation', [BoProductController::class, 'createProduct'])->name('back.product.create');
            Route::get('/creer-un-produit-{id}', [BoProductController::class, 'showCreateProduct'])->name('back.product.show.create');
            Route::get('/ajout-{id}-{product}', [BoProductController::class, 'showAddProduct'])->name('back.product.add');
            Route::get('/categories', [BoProductController::class, 'showProductCategories'])->name('back.product.categories');
            Route::get('/motos', [BoProductController::class, 'showProductBikes'])->name('back.product.bikes');
            Route::get('/marques', [BoProductController::class, 'showProductBrands'])->name('back.product.brands');
            Route::get('/options', [BoProductController::class, 'showProductOptions'])->name('back.product.options');
            Route::get('/options/{id}', [BoProductController::class, 'showProductViewGroupTag'])->name('back.product.options-tag');
            Route::get('/stocks', [BoProductController::class, 'showProductStocks'])->name('back.product.stocks');
            Route::get('/promotions', [BoProductController::class, 'showPromotions'])->name('back.product.promotions');
            Route::get('/promotions-create', [BoProductController::class, 'showCreatePromotions'])->name('back.product.promotions-create');
            Route::get('/promotions-groupe/{id}', [BoProductController::class, 'showGroupPromotions'])->name('back.product.promotions-group');
        });

        Route::prefix('/clients')->group(function (){
            Route::get('/liste', [BoUserController::class, 'showUserList'])->name('back.user.list');
            Route::get('/{user}', [BoUserController::class, 'showUserSingle'])->name('back.user.single');
            Route::get('/{user}/verified', [BoUserController::class, 'validateProfessionnal'])->name('back.user.verified');
        });

        Route::prefix('/reglages')->group(function () {
            Route::get('/', [BoSettingController::class, 'showSettingGeneral'])->name('back.setting');
            Route::get('/paiement-et-taxes', [BoSettingController::class, 'showSettingPayment'])->name('back.setting.payment');
            Route::get('/avance', [BoSettingController::class, 'showSettingAvanced'])->name('back.setting.avanced');
            Route::get('/performance', [BoSettingController::class, 'showSettingPerform'])->name('back.setting.perform');
        });
    });
});


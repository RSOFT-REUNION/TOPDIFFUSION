<?php

use App\Http\Controllers\PagesLegal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LegalController;
use App\Http\Controllers\Back\BackController;
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
Route::get('/liste-produit/categorie-{slug}', [ProductController::class, 'showProductList'])->name('front.product.list');

// It's a user
Route::group([
    'middleware' => 'App\Http\Middleware\Customer'
], function () {
    Route::get('/profil', [FrontController::class, 'showProfile'])->name('front.profile');
    Route::get('/profil/suppression/adresse-{id}', [FrontController::class, 'deletedAddress'])->name('front.profile.delete.address');
    Route::get('/profil/mes-motos', [FrontController::class, 'showProfileBikes'])->name('front.profile.bikes');
    Route::get('/profil/mes-motos/suppression-{id}', [FrontController::class, 'deletedBike'])->name('front.profile.delete.bikes');
    Route::get('/a-propos', [FrontController::class, 'showAbout'])->name('front.about');
    Route::get('/politique-de-confidentialite', [FrontController::class, 'showConfidential'])->name('front.confidential');
    Route::get('/informations-legales', [FrontController::class, 'showlegal'])->name('front.legal');
    Route::get('/faq', [FrontController::class, 'showFaq'])->name('front.faq');
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
            Route::get('/motos', [BoProductController::class, 'showProductBikes'])->name('back.product.bikes');
            Route::get('/marques', [BoProductController::class, 'showProductBrands'])->name('back.product.brands');
            Route::get('/options', [BoProductController::class, 'showProductOptions'])->name('back.product.options');
            Route::get('/options/{id}', [BoProductController::class, 'showProductViewGroupTag'])->name('back.product.options-tag');
            Route::get('/stocks', [BoProductController::class, 'showProductStocks'])->name('back.product.stocks');
        });

        Route::prefix('/mes-pages')->group(function () {
            Route::get('/', [LegalController::class, 'showTest'])->name('bouton.test');
            Route::get('/a-propos', [LegalController::class, 'showAbout'])->name('about');
            Route::post('/a-propos', [LegalController::class, 'postAbout'])->name('post.about');
            Route::get('/informations-legales', [LegalController::class, 'showLegal'])->name('legal');
            Route::post('/informations-legales', [LegalController::class, 'postLegal'])->name('post.legal');
            Route::get('/politique-de-confidentialite', [LegalController::class, 'showConfidential'])->name('confidential');
            Route::post('/politique-de-confidentialite', [LegalController::class, 'postConfidential'])->name('post.confidential');
            Route::get('/faq', [LegalController::class, 'showFaq'])->name('faq');
            Route::post('/faq', [LegalController::class, 'postFaq'])->name('faq');
        });

        Route::prefix('/clients')->group(function () {
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
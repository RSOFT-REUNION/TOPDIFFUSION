<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BoCustomersController;
use App\Http\Controllers\Backend\BoOrdersController;
use App\Http\Controllers\Backend\BoProductController;
use App\Http\Controllers\Backend\BoSettingController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/paiement', [FrontendController::class, 'paymentRedirectPage'])->name('fo.payment.redirect');

Route::get('/mentions-legales', [FrontendController::class, 'showMentionsPage'])->name('fo.legal');
Route::get('/cgv', [FrontendController::class, 'showCGVPage'])->name('fo.legal.cgv');
Route::get('/cgu', [FrontendController::class, 'showCGUPage'])->name('fo.legal.cgu');
Route::get('/a-propos-de-nous', [FrontendController::class, 'showAboutPage'])->name('fo.legal.about');

Route::get('/',[FrontendController::class, 'showHomePage'])->name('fo.home');
Route::get('/inscription', [FrontendController::class, 'showRegisterPage'])->name('fo.register');

Route::get('/produit-{slug}', [FrontendController::class, 'showSingleProduct'])->name('fo.product.single');
Route::get('/produits/moto-{id}', [FrontendController::class, 'showBikesByFilters'])->name('fo.product.list.bikes');
Route::get('/produits/categorie-{slug}', [FrontendController::class, 'showProductByCategory'])->name('fo.product.list.category');

Route::prefix('profil')->middleware('user')->group(function () {
    Route::get('/', [FrontendController::class, 'showProfile'])->name('fo.profile');
    Route::get('/favoris', [FrontendController::class, 'showProfileFavorite'])->name('fo.profile.favorite');
    Route::get('/panier', [FrontendController::class, 'showCart'])->name('fo.cart');
    Route::get('/commandes', [FrontendController::class, 'showProfileOrders'])->name('fo.profile.orders');
    Route::get('/commandes/{id}', [FrontendController::class, 'showProfileOrderSingle'])->name('fo.profile.orders.single');
    Route::get('/mes-informations', [FrontendController::class, 'showProfileEdit'])->name('fo.profile.edit');
});

Route::get('/back-login', [BackendController::class, 'showLoginBackend'])->name('bo.login');
Route::post('/back-login', [BackendController::class, 'postLoginBackend']);

// Routes pour le backend avec middleware (CMS Hivedrops)
Route::prefix('admin')->middleware('team')->group(function () {
    Route::get('/', [BackendController::class, 'showDashboard'])->name('bo.dashboard');
    Route::get('/messages', [BackendController::class, 'showMessages'])->name('bo.messages');

    Route::prefix('/clients')->group(function () {
        Route::get('/', [BoCustomersController::class, 'showCustomerList'])->name('bo.customers');
        Route::get('/groupes', [BoCustomersController::class, 'showCustomerGroup'])->name('bo.customers.group');
    });

    Route::prefix('/commandes')->group(function () {
        Route::get('/', [BoOrdersController::class, 'showOrders'])->name('bo.orders');
        Route::get('/commande-{id}', [BoOrdersController::class, 'showOrder'])->name('bo.orders.single');
    });

    Route::prefix('/produits')->group(function () {
        Route::get('/', [BoProductController::class, 'showProductList'])->name('bo.products.list');
        Route::get('/produit-{product_id}', [BoProductController::class, 'showSingleProduct'])->name('bo.products.single');
        Route::get('/ajout-un-produit/{type}', [BoProductController::class, 'showProductAdd'])->name('bo.products.add');
        Route::get('/categories', [BoProductController::class, 'showCategoriesList'])->name('bo.products.categories');
        Route::get('/marques', [BoProductController::class, 'showBrandsList'])->name('bo.products.brands');
        Route::get('/motos', [BoProductController::class, 'showBikesList'])->name('bo.products.bikes');
        Route::get('/attributs', [BoProductController::class, 'showAttributeList'])->name('bo.products.attributes');
        Route::get('/stock', [BoProductController::class, 'showStockList'])->name('bo.products.stock');
    });

    Route::prefix('/reglages')->group(function () {
        Route::get('/', [BoSettingController::class, 'showSetting'])->name('bo.setting');
        Route::get('/paiement', [BoSettingController::class, 'showPaymentSetting'])->name('bo.setting.payment');
        Route::get('/livraison', [BoSettingController::class, 'showShippingSetting'])->name('bo.setting.shipping');
        Route::get('/equipe', [BoSettingController::class, 'showTeamSetting'])->name('bo.setting.team');
        Route::get('/equipe/delete-{id}', [BoSettingController::class, 'deleteTeamUser'])->name('bo.setting.team.delete');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminNotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/detail/{item_id}', [HomeController::class, 'itemDetail'])->name('item_detail');
Route::get('/comment/{id}', [HomeController::class, 'comment'])->name('comment');
Route::post('/comment/{id}', [HomeController::class, 'comment'])->name('comment');

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/sell', [SellController::class, 'sell'])->name('sell');
    Route::post('/sell', [SellController::class, 'store']);

    Route::match(['post', 'delete'], '/favorites/{item}', [FavoriteController::class, 'toggleFavorite'])->name('favorites');

    Route::post('/comment', [HomeController::class, 'store']);
    Route::get('/my_list', [HomeController::class, 'myList'])->name('my_list');

    Route::get('/mypage/purchase', [MypageController::class, 'myPagePurchase'])->name('my_page_purchase');
    Route::get('/mypage/sell', [MypageController::class, 'myPageSell'])->name('my_page_sell');
    Route::get('/mypage/profile', [MypageController::class, 'profile'])->name('profile');
    Route::post('/mypage/profile', [MypageController::class, 'store'])->name('profile_store');
    Route::patch('/mypage/update', [MypageController::class, 'update'])->name('profile_update');

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase');
    Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase_store');
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'addressShow'])->name('purchase_address');
    Route::patch('/purchase/address/update', [PurchaseController::class, 'addressUpdate'])->name('address_update');
    Route::get('/purchase/payment/{item_id}', [PurchaseController::class, 'paymentMethodShow'])->name('purchase_payment_method');
    Route::post('/purchase/payment/update', [PurchaseController::class, 'paymentMethodUpdate'])->name('payment_method_update');

    // stripe決済
    Route::get('/payment/{id}', [PurchaseController::class, 'showPayment'])->name('stripe.payment_form');
    Route::post('/checkout', [PurchaseController::class, 'checkout'])->name('checkout');
    Route::get('/payment/success/{id}', function ($id) {
        return view('stripe.success');
    })->name('stripe.success');
    Route::get('/payment/cancel/{id}', function ($id) {
        return view('stripe.cancel');
    })->name('stripe.cancel');
});


//管理者
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/users', [AdminController::class, 'adminIndex'])->name('admin.admin_index');
    Route::delete('/users/delete/{user}', [AdminController::class, 'userDestroy'])->name('admin.users_destroy');
    Route::delete('/comments/delete/{comment}', [AdminController::class, 'commentDestroy'])->name('admin.comments_destroy');

    // お知らせメール
    Route::get('/notify', [AdminNotificationController::class, 'showNotificationForm'])->name('admin.notify');
    Route::post('/confirm', [AdminNotificationController::class, 'confirmNotification'])->name('admin.notify.confirm');
    Route::post('/notify', [AdminNotificationController::class, 'sendNotification'])->name('admin.notify.send');
    Route::get('/shops/import', [AdminController::class, 'showImport'])->name('admin.shops_import');
    Route::post('/shops/import', [AdminController::class, 'import'])->name('admin.shops_import');
});

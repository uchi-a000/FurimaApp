<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\FavoriteController;

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
Route::get('/search', [HomeController::class, 'search'])->name('shop.search');
Route::get('/detail/{item_id}', [HomeController::class, 'itemDetail'])->name('item_detail');

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/sell', [SellController::class, 'sell'])->name('sell');
    Route::post('/sell', [SellController::class, 'store']);

    Route::match(['post', 'delete'], '/favorites/{item}', [FavoriteController::class, 'toggleFavorite'])->name('favorites');

    Route::get('/comment/{id}', [HomeController::class, 'comment'])->name('comment');
    Route::post('/comment/{id}', [HomeController::class, 'comment'])->name('comment');
    Route::post('/comment', [HomeController::class, 'store']);
});

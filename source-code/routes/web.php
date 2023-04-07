<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// use production controller
use App\Http\Controllers\user\GuitarController as UserGuitar;
use App\Http\Controllers\shop\GuitarController as ShopGuitar;
use App\Http\Controllers\admin\GuitarController as AdminGuitar;
use App\Http\Controllers\NoRole\GuitarController as NoGuitar;
use App\Http\Controllers\Search;



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

// controller for users with no role (ie...account)
Route::resource("/norole/guitar", NoGuitar::class)->names("norole-guitar");

// checks if the user is authenticated then sends them to correct route
// if no role send to norole route
Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/../home');
    };
    return redirect('/norole/guitar');
});

// route for search page
Route::get('/search', [Search::class, 'getSearch'])->name('search');

// routes for viewing accounts
Route::get('/shop/guitar/account/{user_id}', [ShopGuitar::class, 'account'])->name('shop.account');
Route::get('/user/guitar/account/{user_id}', [UserGuitar::class, 'account'])->name('user.account');
Route::get('/admin/guitar/account/{user_id}', [AdminGuitar::class, 'account'])->name('admin.account');

// routes for user / admins buying and bidding
Route::get('/user/guitar/bid', [UserGuitar::class, 'bid'])->middleware(["auth"])->name('user-guitar.bid');
Route::get('/user/guitar/buy', [UserGuitar::class, 'buy'])->middleware(["auth"])->name('user-guitar.buy');

Route::get('/admin/guitar/bid', [AdminGuitar::class, 'bid'])->middleware(["auth"])->name('admin-guitar.bid');
Route::get('/admin/guitar/buy', [AdminGuitar::class, 'buy'])->middleware(["auth"])->name('admin-guitar.buy');


// crud routes
Route::resource("/user/guitar", UserGuitar::class)->middleware(["auth"])->names("user-guitar");
Route::resource("/admin/guitar", AdminGuitar::class)->middleware(["auth"])->names("admin-guitar");
Route::resource("/shop/guitar", ShopGuitar::class)->middleware(["auth"])->names("shop-guitar");


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// home route
Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name("home.index");

require __DIR__.'/auth.php';

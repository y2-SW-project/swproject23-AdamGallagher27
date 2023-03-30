<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// use production controller
use App\Http\Controllers\user\GuitarController as UserGuitar;
use App\Http\Controllers\shop\GuitarController as ShopGuitar;
use App\Http\Controllers\admin\GuitarController as AdminGuitar;
use App\Http\Controllers\NoRole\GuitarController as NoGuitar;


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

Route::resource("/norole/guitar", NoGuitar::class)->names("norole-guitar");

// standard routes for users not logged in
Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/../home');
    };
    return redirect('/norole/guitar');
});

// Route::get('/search', function () {
//     return view('search');
// });

Route::get('/account', function () {
    return view('account');
});

// Route::get('/product', function () {
//     return view('product');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');




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

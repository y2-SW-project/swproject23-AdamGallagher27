<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// use production controller
use App\Http\Controllers\user\GuitarController;

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

// standard routes for users not logged in=
Route::get('/', function () {
    return view('user/guitar/welcome');
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
Route::resource("/user/guitar", GuitarController::class)->middleware(["auth"])->names("guitar");


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

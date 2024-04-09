<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductWareHouseController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StockInProductController;
use App\Http\Controllers\StockOutProductController;
use App\Http\Controllers\StokProdukController;
use App\Http\Controllers\VendorController;

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

# ------ Unauthenticated routes ------ #
Route::get('/', [AuthenticatedSessionController::class, 'create']);
require __DIR__.'/auth.php';


# ------ Authenticated routes ------ #
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('home'); # dashboard

    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'myProfile'])->name('profile');
        Route::put('/change-ava', [ProfileController::class, 'changeFotoProfile'])->name('change-ava');
        Route::put('/change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');
    }); # profile group

    // admin, ceo, gudang
    Route::middleware('roles:admin,ceo,gudang')->group(function(){
        Route::resource('stocks-in', StockInProductController::class);
        Route::resource('stocks-out', StockOutProductController::class);
        Route::resource('products', ProdukController::class);
        Route::resource('colors', ProductColorController::class);
        Route::resource('vendors', VendorController::class);
    });
    Route::resource('users', UserController::class);
    Route::resource('stocks', StokProdukController::class);
});

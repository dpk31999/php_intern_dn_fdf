<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SuggestController;

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

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/get-product-by-cate-id/{id}', [MenuController::class, 'getProductById']);

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product}/rating', [ProductController::class, 'createRating']);

Route::post('/cart/{product}/add', [CartController::class, 'store']);
Route::put('/cart/{product}/update', [CartController::class, 'update']);
Route::delete('/cart/{product}/delete', [CartController::class, 'destroy']);

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::put('/profile', [ProfileController::class, 'updateInfomation'])->name('profile.info');
    Route::put('/profile/password/change', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/suggest', [SuggestController::class, 'index'])->name('suggest.index');
    Route::post('/suggest', [SuggestController::class, 'store']);
});

Route::get('/category/{category}/child', [CategoryController::class, 'getChildCate']);

Route::get('/search/{word}', [SearchController::class, 'searchProductByName']);

Auth::routes();

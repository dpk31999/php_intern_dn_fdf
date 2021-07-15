<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;

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

Auth::routes();

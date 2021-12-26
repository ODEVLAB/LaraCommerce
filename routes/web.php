<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin/', 'middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

    //Banner Management
    Route::resource('/banner', \App\Http\Controllers\BannerController::class);
    Route::post('banner_status', [\App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

    //Category Management
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    Route::post('category_status', [\App\Http\Controllers\CategoryController::class, 'categoryStatus'])->name('category.status');

    //Brand Management
    Route::resource('/brand', \App\Http\Controllers\BrandController::class);
    Route::post('brand_status', [\App\Http\Controllers\BrandController::class, 'brandStatus'])->name('brand.status');

    Route::post('category/{id}/child', [\App\Http\Controllers\CategoryController::class, 'getChildByParentID']);
   
    //Product Management
    Route::resource('/product', \App\Http\Controllers\ProductController::class);
    Route::post('product_status', [\App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');

    //User Management
    Route::resource('/user', \App\Http\Controllers\UserController::class);
    Route::post('user_status', [\App\Http\Controllers\UserController::class, 'userStatus'])->name('user.status');
});

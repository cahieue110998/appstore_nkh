<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CategoryClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

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
// Admin
Route::post('admin/login',[UserController::class,'loginAdmin'])->name('admin.login');
Route::view('admin/login','admin.pages.login')->name('login.admin');

Route::get('getproducttype', [AjaxController::class,'getProductType']);


Route::group(['prefix' => 'admin', 'middleware' => 'adminMiddleware'], function() {

    Route::get('/',[DashboardController::class,'index']);

    //Category
    Route::resource('category', CategoryController::class);
    // Product Types
    Route::resource('producttype', ProductTypeController::class);
    //Product
    Route::resource('product', ProductController::class);
    Route::post('updatePro/{id}',[ProductController::class,'update']);

    Route::resource('order', OrderController::class);

    Route::get('logoutAdmin',[UserController::class,'logoutAdmin'])->name('logoutAdmin');
});


// Client
Route::get('callback/{social}',[UserController::class,'handleProviderCallback']);
Route::get('login/{social}',[UserController::class,'redirectProvider'])->name('login.social');
Route::get('logout',[UserController::class,'logout']);
Route::post('updatePass',[UserController::class,'updatePassClient'])->name('updatepassword');
Route::post('login',[UserController::class,'loginClient'])->name('login');
Route::post('register',[UserController::class,'registerClient'])->name('register');

Route::get('/',[HomeController::class,'index']);
Route::post('/tim-kiem',[HomeController::class,'search'])->name('search');

Route::get('/danh-muc-san-pham/{category_id}',[CategoryController::class,'get_category']);
Route::get('/loai-san-pham/{producttype_id}',[ProductTypeController::class,'get_producttype']);
Route::get('/chi-tiet-san-pham/{product_id}',[ProductController::class,'details_product']);


//Cart
Route::resource('cart', CartController::class);
Route::post('addcart/{id}',[CartController::class,'addCart'])->name('addCart');
Route::get('checkout',[CartController::class,'checkout']);

//Customer
Route::resource('customer', CustomerController::class);


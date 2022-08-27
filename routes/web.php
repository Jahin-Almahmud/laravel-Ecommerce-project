<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteProductControllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Crypt;

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
Route::middleware(['PreventBackHistory'])->group(function () {
    Route::get('/',[HomeController::class, 'index'])->name('frontend');
    Route::Post('search',[SearchController::class, 'search'])->name('search');
    Route::get('download/invoice',[HomeController::class, 'download'])->name('download.invoice');
    Route::get('order/detail/{id}',[HomeController::class, 'orderdetail'])->name('order.detail');
    Route::get('customer/Dashboard',[ShopController::class, 'dashboard'])->name('frontend.dashboard');
    Route::get('shop',[ShopController::class, 'index'])->name('shop');
    Route::get('product/details/{slug}',[ControllersProductController::class, 'productdetails'])->name('product.details');
    Route::get('category/Product/{slug}',[ControllersProductController::class, 'categorywiseProduct'])->name('categorywiseProduct');
    Route::get('wishlist/index',[ControllersProductController::class, 'wishlistindex'])->name('wishlist.index');
    Route::post('/get/city/{id}',[CheckoutController::class, 'getcity']);
    Route::post('/Subscriber',[SubscriberController::class, 'Subscriber'])->name('Subscriber');
    Route::get('/contact',[ContactController::class, 'contact'])->name('contact.index');
    Route::Post('/message',[ContactController::class, 'message'])->name('message');

});
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
  Route::get('product/favorite/{id}', [FavoriteProductControllers::class, 'add_remove'])->name('wishlist.add.remove');
  Route::post('cart/add/{id}', [CartController::class, 'cartadd'])->name('cart.add');
  Route::PATCH('cart/update', [CartController::class, 'cartupdate'])->name('cart.update');
  Route::get('cart.remove/{id}', [CartController::class, 'cartremove'])->name('cart.remove');
  Route::get('cart/index', [CartController::class, 'index'])->name('cart.index');
  Route::get('cheakout', [CheckoutController::class, 'cheakout'])->name('cheakout');
  Route::post('cheakout/post', [CheckoutController::class, 'cheakoutpost'])->name('cheakout.post');
});

Auth::routes();


Route::prefix('admin')->as('admin')->middleware('auth','admin','PreventBackHistory')->namespace('App\Http\Controllers\admin')->group(function () {
    Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber');
    Route::delete('/subscriber/delete/{id}', [SubscriberController::class, 'delete'])->name('subscriber.delete');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('/profile/password/', [AdminController::class, 'password'])->name('password');
    Route::post('/change/profile/photo', [AdminController::class, 'changephoto'])->name('change.profle.photo');
    Route::post('/change/password', [AdminController::class, 'changepassword'])->name('change.password');
    Route::get('/home', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('/edit/{id}', [ProductController::class, 'thumnailedit'])->name('product.thumnail.edit');
    Route::post('/update/{id}', [ProductController::class, 'thumnailupdate'])->name('product.thumnail.update');
    Route::get('/delete/{id}', [ProductController::class, 'thumnaildelete'])->name('product.thumnail.delete');
    Route::resource('coupon', CouponController::class);

});




// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



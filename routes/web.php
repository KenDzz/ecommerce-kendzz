<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CrawlProductController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserVerifyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->middleware('is_verify_email')->name('index');
Route::get('/media/{path1}/{path2}/{filename}', [MediaController::class, 'show'])->name('media');
Route::get('/category/{id}', [ProductController::class, 'categoryProduct'])->middleware('is_verify_email')->name('category-product');
Route::get('/product-{id}/{slug}', [ProductController::class, 'detailProduct'])->middleware('is_verify_email')->name('detail-product');
Route::post('/getsize', [ProductController::class, 'getSize'])->middleware('is_verify_email')->name('get-size');
Route::post('add-to-cart', [ProductController::class, 'addToCart'])->name('add-to-cart');
Route::patch('update-cart', [ProductController::class, 'updateToCart'])->name('update-cart');
Route::delete('remove-from-cart', [ProductController::class, 'removeToCart'])->name('remove-from-cart');
Route::get('reload-cart', [ProductController::class, 'reloadCart'])->name('reload-cart');
Route::get('getIDSubLocation/{id}/{name}', [UserController::class, 'getIDSubLocation'])->name('getIDSubLocation');
Route::get('getListMenuTiki', [CrawlProductController::class, 'getListMenuTiki'])->name('getListMenuTiki');
Route::get('getListProductTiki/{category}/{urlKey}/{page}/{limit}', [CrawlProductController::class, 'getListProductTiki'])->name('getListProductTiki');
Route::get('getDetailProductTiki/{id}', [CrawlProductController::class,'getDetailProductTiki'])->name('getDetailProductTiki');
Route::get('crawlProductTiki/{category}/{urlKey}/{totalPage}/{categoryReal}', [CrawlProductController::class,'crawlProductTiki'])->name('crawlProductTiki');

Route::prefix('user')->middleware('auth')->name('user')->group(function () {
    Route::get('/', [UserController::class, 'infoUser'])->name('-info');
    //Start Router QR PAY
    Route::get('recharge', [UserController::class, 'recharge'])->name('-recharge');
    Route::post('info/recharge', [UserController::class, 'getInfoQRPay'])->name('-info-recharge');
    Route::post('qrpay/check', [UserController::class, 'checkqrpay'])->name('-qrpay-check');
    //End Router QR PAY
    // Start Router Shipping Address
    Route::get('shipping/addresses', [UserController::class, 'shippingaddresses'])->name('-shipping-addresses');
    Route::get('shipping/addresses/{search}/{state}/{city}/{district}', [UserController::class, 'getApiAddress'])->name('-api-addresses');
    Route::post('shipping/add/addresses', [UserController::class, 'addAddress'])->name('-add-addresses');
    Route::post('shipping/add/addresses', [UserController::class, 'addAddress'])->name('-add-addresses');
    Route::post('shipping/add/addresses/default', [UserController::class, 'defaultAddress'])->name('-add-addresses');
    //Start Checkout
    Route::get('checkout', [CheckoutController::class, 'index'])->middleware('is_checkout')->name('-checkout');
    Route::post('checkout/cost/shipping', [CheckoutController::class, 'getPriceShippingSPXJson'])->middleware('is_checkout')->name('-cost-shipping');
    Route::post('pay', [CheckoutController::class, 'pay'])->middleware('is_checkout')->name('-pay');
    //Order Summary
    Route::get('order/summary', [UserController::class, 'orderSummary'])->name('-order-summary');
    Route::post('order/uploads/process', [FileUploadController::class, 'process'])->name('-uploads-process');
    Route::post('order/review', [ProductReviewsController::class, 'addReview'])->name('-review-import');

});

Route::prefix('auth')->name('auth')->group(function () {
    Route::get('/', [AuthenticationController::class, 'index'])->name('-login');
    Route::get('/register', [AuthenticationController::class, 'register'])->name('-register');
    Route::post('/adduser', [UserController::class, 'adduser'])->name('-adduser');
    Route::get('/google', [AuthenticationController::class, 'google'])->name('-google');
    Route::get('/google/callback', [AuthenticationController::class, 'googlecallback'])->name('-google-callback');
    Route::get('/facebook', [AuthenticationController::class, 'facebook'])->name('-facebook');
    Route::get('/facebook/callback', [AuthenticationController::class, 'facebookCallback'])->name('-facebook-callback');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('-logout');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('-login-account');
    Route::get('/verify/{userid}/{token}', [UserVerifyController::class, 'emailVerify'])->name('-email-verify');
    Route::get('/forgotpassword', [AuthenticationController::class, 'forgotPassword'])->name('-forgot-password');
    Route::post('/forgotpassword/select/', [AuthenticationController::class, 'selectOptionsForgot'])->name('-select-options-forgot');
    Route::post('/forgotpassword/pass/', [AuthenticationController::class, 'forgot'])->name('-select-options-forgot');
    Route::get('/mail', [EmailController::class, 'testMail']);
});

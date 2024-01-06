<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\CrawlProductController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewsController;
use App\Http\Controllers\ProductSaleTimerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersChatController;
use App\Http\Controllers\UserVerifyController;
use App\Models\ProductSaleTimer;
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
Route::get('reload-favourite', [ProductController::class, 'reloadFavourite'])->name('reload-favourite');
Route::get('getIDSubLocation/{id}/{name}', [UserController::class, 'getIDSubLocation'])->name('getIDSubLocation');
Route::get('getListMenuTiki', [CrawlProductController::class, 'getListMenuTiki'])->name('getListMenuTiki');
Route::get('getListProductTiki/{category}/{urlKey}/{page}/{limit}', [CrawlProductController::class, 'getListProductTiki'])->name('getListProductTiki');
Route::get('getDetailProductTiki/{id}', [CrawlProductController::class,'getDetailProductTiki'])->name('getDetailProductTiki');
Route::get('crawlProductTiki/{category}/{urlKey}/{totalPage}/{categoryReal}', [CrawlProductController::class,'crawlProductTiki'])->name('crawlProductTiki');
Route::get('search', [ProductController::class, 'search'])->name('search');
Route::post('checkCoupons', [CouponsController::class, 'checkCouponsRequest'])->name('check-coupons');
Route::get('product/sale', [ProductSaleTimerController::class, 'getAllSale'])->name('product-sale-timer');
Route::get('provinces/depth/{id}', [CrawlProductController::class,'getProvinces'])->name('getProvinces');
Route::get('city/depth/{id}', [CrawlProductController::class,'getCity'])->name('getCity');
Route::get('district/depth/{id}', [CrawlProductController::class,'getDistrict'])->name('getDistrict');


Route::prefix('dashboard/seller')->middleware('is_seller')->name('dashboard')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('-index');
    Route::get('/chat', [DashBoardController::class, 'chat'])->name('-chat');
    Route::get('/chat/list', [UsersChatController::class, 'listChatSeller'])->name('-list-chat-user');
    Route::post('/chat/list/detail', [UsersChatController::class, 'listDetailChatUser'])->name('-list-chat-detail');
    Route::post('/chat/send', [UsersChatController::class, 'sendChatSeller'])->name('-send-chat');
    Route::get('/product', [DashBoardController::class, 'productView'])->name('-product');
    Route::get('/product/add', [DashBoardController::class, 'productAdd'])->name('-add-product');
    Route::post('/product/add/detail', [DashBoardController::class, 'productAddForm'])->name('-add-product-form');
    Route::get('/product/update/{id}', [DashBoardController::class, 'productUpadte'])->name('-product-update');
    Route::post('/upload', [FileUploadController::class, 'storeImage'])->name('-uploads-image');
    Route::post('/product/add/media', [DashBoardController::class, 'addMediaProduct'])->name('-add-media');
    Route::post('/product/delete/media', [DashBoardController::class, 'delMediaProduct'])->name('-delete-media');
});

Route::prefix('dashboard/admin')->middleware('is_admin')->name('dashboard-admin')->group(function () {
    Route::get('/product/{id}', [DashBoardController::class, 'productViewAdmin'])->name('-product-confirm');
    Route::get('/product/update/{id}', [DashBoardController::class, 'productUpadteAdmin'])->name('-product-update');
    Route::get('/product/update/confirm/{id}/{status}', [DashBoardController::class, 'productUpadteConfirmAdmin'])->name('-product-confirm-update');

});


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
    //Users Favourite
    Route::post('product/favourite', [ProductController::class, 'addFavourite'])->name('-product-favourite');
    //Users Chat
    Route::post('chat/default', [UsersChatController::class, 'addMsgDefault'])->name('-send-msg-default');
    Route::get('chat/list', [UsersChatController::class, 'listChatUser'])->name('-list-chat-user');
    Route::post('chat/detail', [UsersChatController::class, 'listChat'])->name('-chat-detail');
    Route::post('send/chat', [UsersChatController::class, 'sendChatUser'])->name('-send-chat');
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

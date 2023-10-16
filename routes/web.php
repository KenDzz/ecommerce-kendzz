<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::get('/category/{id}', [ProductController::class, 'categoryProduct'])->middleware('is_verify_email')->name('category-product');
Route::get('/product-{id}/{slug}', [ProductController::class, 'detailProduct'])->middleware('is_verify_email')->name('detail-product');

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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\AdminController;


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

// ーーーーーーーーーー会員登録、ログイン関連のルートーーーーーーーーーー
Route::get('/register',[RegisterController::class,'showRegister'])->name('registerView');

Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::get('/login',[AuthController::class,'showLogin'])->name('loginView');

Route::post('/login',[AuthController::class,'login'])->name('login');




// ーーーーーーーーーートップページの表示(ゲストユーザー可能)ーーーーーーーーーー
Route::get('/',[MarketController::class,'index'])->name('index');

Route::get('/detail/{id}',[MarketController::class,'showDetail'])->name('detail');




// ーーーーーーーーーー商品出品のルートーーーーーーーーーー
Route::middleware(['auth'])->group(function () {
    Route::get('/sell',[MarketController::class,'showSell'])->name('sell');

    Route::post('/sell/items',[MarketController::class,'store'])->name('item.sell');
});




// ーーーーーーーーーーProfile関連のルートーーーーーーーーーー
Route::middleware(['auth'])->group(function () {
    Route::get('/mypage',[MypageController::class,'showMypage'])->name('mypage');

    Route::get('/profile/{id}',[MypageController::class,'showProfile'])->name('profile');

    Route::patch('/profile/{id}',[MypageController::class,'updateProfile'])->name('updateProfile');
});




// ーーーーーーーーーーコメント関連のルートーーーーーーーーーー
Route::middleware(['auth'])->group(function () {
    Route::get('/comment/{id}',[CommentController::class,'showComment'])->name('comment');

    Route::post('/comment/{id}',[CommentController::class,'comment'])->name('store.comment');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');
});




// ーーーーーーーーーー商品購入処理のルートーーーーーーーーーー
Route::get('/purchase/{id}',[PurchaseController::class,'purchase'])->middleware(['auth','checkProfile'])->name('purchase');

Route::post('/purchase', [PurchaseController::class, 'processPurchase'])->name('purchase.done');

Route::get('/address/{itemId}',[PurchaseController::class,'showAddress'])->name('address');

Route::post('/update-address', [PurchaseController::class, 'updateAddress'])->name('updateAddress');




// ーーーーーーーーーーstripe決済ーーーーーーーーーー
Route::post('/checkout/session', [StripeController::class, 'createCheckoutSession'])->name('checkout.session');

Route::get('/checkout/success', function () {
    return view('checkout.success');
})->name('checkout.success');

Route::get('/checkout/cancel', function () {
    return view('checkout.cancel');
})->name('checkout.cancel');

Route::get('/checkout/success', [PurchaseController::class, 'completePurchase'])->name('checkout.success');

Route::get('/checkout/cancel', [PurchaseController::class, 'completePurchase'])->name('checkout.cancel');




// ーーーーーーーーーー管理者用のルートーーーーーーーーーー
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard',[AdminController::class,'showDashboard'])->name('dashboard');

    Route::get('/delete-user',[AdminController::class,'showDeleteUser'])->name('admin.user');

    Route::delete('/delete/user', [AdminController::class, 'deleteUser'])->name('users.destroy');

    Route::get('/delete-comment',[AdminController::class,'showDeleteComment'])->name('admin.comment');

    Route::delete('/delete/comment', [AdminController::class, 'deleteComment'])->name('comments.destroy');

    Route::get('/send-notification',[AdminController::class,'showMail'])->name('admin.mail');

    Route::post('/send/notification', [AdminController::class, 'sendNotifyEmail'])->name('admin.send');
});

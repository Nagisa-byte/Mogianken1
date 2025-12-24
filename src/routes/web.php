<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\LoginController;

// === 商品一覧 ===
Route::get('/', [ItemController::class, 'index']);
Route::get('/?tab=mylist', [ItemController::class, 'mylist'])->middleware('auth');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

// === 認証系 ===
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// メール認証誘導画面
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

// 認証メール再送
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// 認証リンクアクセス
Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// === 認証済みユーザー操作 ===
Route::middleware('auth')->group(function () {
    // お気に入り
    Route::post('/item/{item_id}/favorite', [FavoriteController::class, 'store']);
    Route::delete('/item/{item_id}/favorite', [FavoriteController::class, 'destroy']);

    // コメント
    Route::post('/item/{item}/comment', [CommentController::class, 'store']);

    // 購入
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'showPurchaseForm'])->name('purchase.form');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase.execute');
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'showAddressForm']);
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress']);

    // 出品
    Route::get('/sell', [SellController::class, 'create'])->name('sell.create');
    Route::post('/sell', [SellController::class, 'store']);

    // マイページ
    Route::middleware('auth')->group(function () {
        Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
        Route::get('/mypage?page=buy', [MypageController::class, 'purchasedList']);
        Route::get('/mypage?page=sell', [MypageController::class, 'soldList']);
    });

    // プロフィール
    Route::get('/mypage/profile/edit', [ProfileController::class, 'editProfile']);
    Route::post('/mypage/profile/edit', [ProfileController::class, 'updateProfile']);
});

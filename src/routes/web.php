<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;

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

// トップページ（商品一覧）
Route::get('/', [ItemController::class, 'index'])->name('item.index');

// ログインユーザーのお気に入り（?tab=mylist）
Route::get('/?tab=mylist', [ItemController::class, 'mylist'])
    ->middleware('auth')
    ->name('item.mylist');

// 商品詳細
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

Route::middleware(['auth'])->group(function () {

// お気に入り
    Route::post('/item/{item_id}/favorite', [FavoriteController::class, 'store']);
    Route::delete('/item/{item_id}/favorite', [FavoriteController::class, 'destroy']);

// コメント投稿
    Route::post('/item/{item_id}/comment', [CommentController::class, 'store']);
});

// 購入関連
Route::middleware(['auth'])->group(function () {
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'showPurchaseForm']);
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'purchase']);
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'showAddressForm']);
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress']);
});

// 出品
Route::middleware(['auth'])->group(function () {
    Route::get('/sell', [SellController::class, 'create']);
    Route::post('/sell', [SellController::class, 'store']);
});

// マイページ
Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index']);
    Route::get('/mypage?page=buy', [MypageController::class, 'purchasedList']);
    Route::get('/mypage?page=sell', [MypageController::class, 'soldList']);
});

// プロフィール
Route::middleware(['auth'])->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'showProfile']);
    Route::get('/mypage/profile/edit', [ProfileController::class, 'editProfile']);
    Route::post('/mypage/profile/edit', [ProfileController::class, 'updateProfile']);
});


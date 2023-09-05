<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;
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

Route::get('/', [IndexController::class, 'index']);
Route::get('/item/{id}', [ItemController::class, 'showDetailItem'])->name('item');
Route::get('/item/{id}/contacts', [ContactController::class, 'showItemContact'])->name('item__contact');

//Route::middleware('verified')->group(function () {
Route::middleware('auth')->group(function () {
  Route::get('/mypage', [MyPageController::class, 'showMypage']);
  Route::get('/mylist', [ItemController::class, 'showLikedItem']);
  Route::get('/mypage/profile', [ProfileController::class, 'showProfile']);
  Route::post('/mypage/profile/upload', [ProfileController::class, 'uploadProfileImage']);
  Route::PATCH('/mypage/profile/update', [ProfileController::class, 'updateProfile']);
  Route::get('/mypage/purchased', [MyPageController::class, 'showPurchasedItems']);
  Route::get('/mypage/selled', [MyPageController::class, 'showSelledItems']);
  Route::get('/sell', [ItemController::class, 'showSell']);
  Route::post('/sell/store', [ItemController::class, 'storeItem']);
  //子カテゴリー取得用ルート
  Route::get('/get-child-categories/{categoryId}', [ItemController::class, 'getChildCategories']);
  Route::post('/like/{itemId}', [LikeController::class, 'toggleLike']);
  Route::delete('/like/{itemId}', [LikeController::class, 'toggleLike']);
  // アイテムの「いいね」情報を取得するルート
  Route::get('/getLikedData/{itemId}', [LikeController::class, 'getLikedData']);
  // カウント取得用のルート
  Route::get('/getLikeCount/{itemId}', [LikeController::class, 'getLikeCount']);
  Route::get('/getLikeCount/{itemId}', [LikeController::class, 'getLikeCount']);

  Route::post('/contact/store', [ContactController::class, 'storeContact']);
  Route::delete('/contact/delete', [ContactController::class, 'destroyContact']);
});
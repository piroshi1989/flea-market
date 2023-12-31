<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\RecommendController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SearchController;
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

//ログインしなくてもみれる
Route::get('/', [IndexController::class, 'index']);
Route::post('/search', [SearchController::class, 'searchItems']);
Route::get('/item/{id}', [ItemController::class, 'showDetailItem'])->name('item');
Route::get('/item/{id}/contacts', [ContactController::class, 'showContact'])->name('item__contact');

Route::middleware('verified')->group(function () {
//Route::middleware('auth')->group(function () {
  Route::get('/user', [IndexController::class, 'index']);
  Route::get('/mylist', [MyListController::class, 'showMyList']);
  Route::get('/recommend', [RecommendController::class, 'showRecommend']);

  //mypageでまとめる
  Route::prefix('mypage')->group(function () {
    Route::get('/', [MyPageController::class, 'showMyPage']);
    Route::get('/profile', [ProfileController::class, 'showProfile']);
    Route::post('/profile/upload', [ProfileController::class, 'uploadProfileImage']);
    Route::patch('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::get('/purchased', [MyPageController::class, 'showPurchasedItems']);
    Route::get('/exhibited', [MyPageController::class, 'showExhibitedItems']);
    Route::get('/following', [MyPageController::class, 'showFollowing']);
  });

  Route::get('/sell', [SellController::class, 'showSell']);
  Route::post('/sell/store', [SellController::class, 'storeSell']);
  //子カテゴリー取得用ルート
  Route::get('/get-child-categories/{categoryId}', [SellController::class, 'getChildCategories']);

  Route::post('/like/{itemId}', [LikeController::class, 'toggleLike']);
  Route::delete('/like/{itemId}', [LikeController::class, 'toggleLike']);
  // アイテムの「いいね」情報を取得するルート
  Route::get('/getLikedData/{itemId}', [LikeController::class, 'getLikedData']);
  // カウント取得用のルート
  Route::get('/getLikeCount/{itemId}', [LikeController::class, 'getLikeCount']);
  //問い合わせ機能
  Route::post('/contact/store', [ContactController::class, 'storeContact']);
  Route::delete('/contact/delete', [ContactController::class, 'destroyContact']);
  //商品購入機能
  Route::get('/purchase/{itemId}', [PurchaseController::class, 'showPurchase']);
  Route::get('/paymentmethod/{itemId}', [PaymentMethodController::class, 'showPaymentMethod']);
  Route::post('/paymentmethod/select', [PaymentMethodController::class, 'selectPaymentMethod']);
  Route::get('/address/{itemId}', [AddressController::class, 'showAddress']);
  Route::post('/address/change', [AddressController::class, 'changeAddress']);
  Route::post('/purchase/confirm', [PurchaseController::class, 'confirm']);
  Route::post('/purchase/thanks', [PurchaseController::class, 'storePurchase']);
  //stripe決済機能
  Route::get('/payment/{itemId}', [StripePaymentController::class, 'create']);
  Route::post('/payment/store', [StripePaymentController::class, 'store']);
  //user follow機能
  Route::post('/following/store',[FollowingController::class,'storeFollowing']);
  Route::delete('/following/delete',[FollowingController::class,'destroyFollowing']);

  //管理者
  Route::group(['middleware' => ['can:admin']], function () {
    Route::get('/management', [ManagementController::class, 'showManagement']);
    Route::post('/management/store', [AdminController::class, 'storeAdmin']);
    //メール送信用
    Route::post('/mail/confirm',[SendMailController::class,'confirmNoticeMail']);
    Route::post('/mail/send',[SendMailController::class,'sendNoticeMail']);
  });
});
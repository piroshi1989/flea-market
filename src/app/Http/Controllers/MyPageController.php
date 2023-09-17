<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sale;
use App\Models\Item;
use App\Models\Following;


class MyPageController extends Controller
{

    public function showMyPage(){
        $userId = Auth::id();
        $user = Auth::user();

        $purchasedItemIds = Sale::where('user_id', $userId)->pluck('item_id');

        $purchasedItems = Item::whereIn('id', $purchasedItemIds)->get();

        return view('mypage', compact('user', 'purchasedItems'));
    }

    public function showPurchasedItems(){
        $userId = Auth::id();
        $user = Auth::user();

        $purchasedItemIds = Sale::where('user_id', $user->id)->pluck('item_id');

        $purchasedItems = Item::whereIn('id', $purchasedItemIds)->get();

        return view('mypage_purchased', compact('user', 'purchasedItems'));
    }

    public function showSelledItems(){
        $userId = Auth::id();
        $user = Auth::user();

        $selledItems = Item::where('user_id', $user->id)->get();

        return view('mypage_selled', compact('user', 'selledItems'));
    }

    public function showFollowing(){
        $userId = Auth::id();
        $user = Auth::user();
        $followingUserIds = Following::where('user_id', $userId)->pluck('following_user_id');

        // フォローしているユーザーの情報を取得
        $followingUsers = User::whereIn('id', $followingUserIds)->get();
        //dd($followingUsers);

        return view('mypage_following', compact('user', 'followingUsers'));
    }
}
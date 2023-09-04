<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sale;
use App\Models\Item;


class MypageController extends Controller
{

    public function showMyPage(){
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        $purchasedItemIds = Sale::where('user_id', $user_id)->pluck('item_id');
        
        $purchasedItems = Item::whereIn('id', $purchasedItemIds)->get();

        return view('mypage', compact('user', 'purchasedItems'));
    }

    public function showPurchasedItems(){
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        $purchasedItemIds = Sale::where('user_id', $user->id)->pluck('item_id');
        
        $purchasedItems = Item::whereIn('id', $purchasedItemIds)->get();

        return view('mypage_purchased', compact('user', 'purchasedItems'));
    }

    public function showSelledItems(){
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        $selledItems = Item::where('user_id', $user->id)->get();

        return view('mypage_selled', compact('user', 'selledItems'));
    }
}
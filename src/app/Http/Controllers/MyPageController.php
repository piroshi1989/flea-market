<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sale;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Following;


class MyPageController extends Controller
{
    public function showMyPage(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();

        $purchasedItemIds = Sale::where('user_id', $userId)->pluck('item_id');

        $purchasedItems = Item::whereIn('id', $purchasedItemIds)->get();

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('mypage', compact('user', 'purchasedItems', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }

    public function showPurchasedItems(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();

        $purchasedItems = Sale::where('user_id', $userId)->get();

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('mypage__purchased', compact('user', 'purchasedItems', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }

    public function showExhibitedItems(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();

        $exhibitedItems = Item::where('user_id', $user->id)->get();

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('mypage__exhibited', compact('user', 'exhibitedItems','categories',  'brands', 'selectedCategory', 'selectedBrand'));
    }

    public function showFollowing(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();
        $followingUserIds = Following::where('user_id', $userId)->pluck('following_user_id');

        // フォローしているユーザーの情報を取得
        $followingUsers = User::whereIn('id', $followingUserIds)->get();

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('mypage__following', compact('user', 'followingUsers', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }
}
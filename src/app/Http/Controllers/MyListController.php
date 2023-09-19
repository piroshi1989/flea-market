<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Following;
use Illuminate\Support\Facades\Auth;

class MyListController extends Controller
{
    public function showMyList(Request $request)
    {
        $userId = Auth::id();

        //ユーザーがいいねしたitemを取得
        $likedItems = Like::where('user_id', $userId)->get();

        $followingUserIds = Following::where('user_id', $userId)->pluck('following_user_id')->toArray();

        $followingUsersItems = Item::WhereIn('user_id', $followingUserIds)->get();

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('mylist', compact('likedItems', 'followingUsersItems', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }
}
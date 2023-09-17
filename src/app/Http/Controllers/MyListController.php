<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use App\Models\Following;
use Illuminate\Support\Facades\Auth;

class MyListController extends Controller
{
    public function showMyList()
    {
        $userId = Auth::id();

        $likedItemIds = Like::where('user_id', $userId)->pluck('item_id')->toArray();
        $likedItems = Item::whereIn('id', $likedItemIds)->get();

        $followingUserIds = Following::where('user_id', $userId)->pluck('following_user_id')->toArray();

        $followingUsersItems = Item::WhereIn('user_id', $followingUserIds)->get();

        return view('mylist', compact('likedItems', 'followingUsersItems'));
    }
}
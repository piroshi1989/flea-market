<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Following;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class FollowingController extends Controller
{
    public function storeFollowing(Request $request)
    {
        $store = new Following;
        $store->user_id = $request->user_id;
        $store->following_user_id = $request->following_user_id;

        $store->save();

        return redirect('/item/' . $request->item_id )->with('message', '出品者をフォローしました');
    }

    public function destroyFollowing(Request $request)
    {
        $userId = Auth::id();

        Following::where('user_id', $userId)->where('following_user_id', $request->id)->delete();

        return back()->with('message', 'フォローを削除しました');
    }
}
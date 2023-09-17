<?php

namespace App\Http\Controllers;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $itemId)
    {
        $userId = Auth::id();

        // 既にお気に入りに登録されているかチェック
        $likeData = Like::where('user_id', $userId)->where('item_id', $itemId)->first();

        if (!$likeData) {
            // お気に入り登録がされていない場合は新しくレコードを作成
            $like = new Like;
            $like->user_id = $userId;
            $like->item_id = $itemId;
            $like->save();

            $isLiked = true; // お気に入り登録がされた場合はtrueを設定
        } else {
            // お気に入り登録がされている場合はレコードを削除
            Like::where('user_id', $userId)->where('item_id', $itemId)->delete();

            $isLiked = false; // お気に入り登録が解除された場合はfalseを設定
        }

        // お気に入り登録の状態をビューに返す
        return response()->json(['liked' => $isLiked]);
    }

    public function getLikedData(Request $request)
    {
        $userId = Auth::id();
        $itemId = $request->item_id;

        // 既にお気に入りに登録されているかチェック
        $likeData = Like::where('user_id', $userId)->where('item_id', $itemId)->first();

        return response()->json($likeData);
    }

    public function getLikeCount($itemId)
    {
        $likeCount = Like::where('item_id', $itemId)->count();

        return response()->json(['likeCount' => $likeCount]);
    }

}
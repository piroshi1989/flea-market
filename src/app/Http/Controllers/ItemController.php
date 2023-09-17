<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use App\Models\Contact;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Condition;
use App\Models\Brand;
use App\Models\Sale;
use App\Models\Following;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function showDetailItem($id){
        $item = Item::findOrFail($id);
         // 閲覧履歴をセッションに保存
        $viewedItemCategories = session('viewed_item_categories', []);
        array_unshift($viewedItemCategories, $item->category_id);

        session(['viewed_item_categories' => array_slice($viewedItemCategories, 0, 3)]); // 例: 直近3アイテムのみ保存

        $likeData = Like::where('user_id', $item->user_id)->where('item_id', $item->id)->first();

        // お気に入りのカウントを取得
        $likeCount = Like::where('item_id', $item->id)->count();

        // 問い合わせのカウントを取得
        $contactCount = Contact::where('item_id', $item->id)->count();

        //売却済かを取得
        $soldOutInfo = Sale::where('item_id', $item->id)->first();

        $userId = Auth::id();
        $followingUsers = Following::where('user_id', $userId)->where('following_user_id', $item->user_id)->get();

        return view('item', compact('item', 'likeData', 'likeCount', 'contactCount', 'soldOutInfo','userId','followingUsers'));
    }

    public function getChildCategories($categoryId)
    {
        // $categoryIdに基づいて関連する子カテゴリーを取得
        $childCategories = ChildCategory::where('category_id', $categoryId)->get();
    
        return response()->json($childCategories);
    }
}
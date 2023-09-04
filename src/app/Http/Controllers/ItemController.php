<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use App\Models\Contact;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Condition;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function showDetailItem($id){
        $item = Item::findOrFail($id);
        $likeData = Like::where('user_id', $item->user_id)->where('item_id', $item->id)->first();

        // お気に入りのカウントを取得
    $likeCount = Like::where('item_id', $item->id)->count();

        // 問い合わせのカウントを取得
    $contactCount = Contact::where('item_id', $item->id)->count();

        return view('item', compact('item', 'likeData', 'likeCount', 'contactCount'));
    }

    public function showSellItem(){
        return view();
    }

    public function showLikedItem()
    {
        $user_id = Auth::id();

        $likedItemIds = Like::where('user_id', $user_id)->pluck('item_id')->toArray();

        $likedItems = Item::whereIn('id', $likedItemIds)->get();

        return view('mylist', compact('likedItems'));
    }

    public function showSell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        $child_categories = ChildCategory::all();
        return view('sell', compact('categories','child_categories', 'conditions'));
    }

    public function storeItem(ItemRequest $request)
    {
        $store = new Item;
        $store->user_id = Auth::id();
        $store->category_id = $request->category_id;
        $store->child_category_id = $request->child_category_id;
        $store->condition_id = $request->condition_id;
        $store->name = $request->name;
        $store->detail = $request->detail;
        $store->price = $request->price;

        $dir = 'images';
        $uploadedFile = $request->file('image');
        if ($uploadedFile) {
            $file_name = $uploadedFile->getClientOriginalName();

            $uploadedFile->storeAs('public/' . $dir, $file_name);

            $store->image_url = 'storage/' . $dir . '/' . $file_name;
        }

        $store->save();

        return redirect('/sell')->with('message', '商品を出品しました');
        }

    public function getChildCategories($categoryId)
    {
        // $categoryIdに基づいて関連する子カテゴリーを取得
        $childCategories = ChildCategory::where('category_id', $categoryId)->get();
    
        return response()->json($childCategories);
    }
}
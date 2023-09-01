<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function showDetailItem($id){
        $item = Item::findOrFail($id);
        return view('item', compact('item'));
    }

    public function store(Request $request)
    {
        // アイテムを作成
        $item = Item::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            // その他の属性...
        ]);

        // 選択されたカテゴリIDを取得
        $categoryIds = $request->input('category_ids');

        // アイテムとカテゴリを関連付ける
        $item->categories()->attach($categoryIds);

        // その他の処理やリダイレクトなどを行う
    }
}
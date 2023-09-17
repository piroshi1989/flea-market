<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Sale;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // クエリを作成
        $query = Item::query();

        // 売却済みアイテムを非表示にするかどうかをチェック
        if ($request->has('hideSold')) {
            $query->whereDoesntHave('sale');
        }

        // ソートのパラメータを取得
        $sort = $request->input('sort', 'default');

        // ソートに応じてクエリを変更
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'most_famous':
                //いいねが多い順に並び替え
                $query->withCount('likes')->orderBy('likes_count', 'desc');
                break;
            default:
                // デフォルトの並び替え方法を指定
                $query->latest();
                break;
        }

        // クエリを実行してアイテムを取得
        $items = $query->get();

        //売却済ならSoldOutを表示される
        $items->map(function ($item) {
            $sale = Sale::where('item_id', $item->id)->first();
            $item->sale = !empty($sale) ? 'SoldOut' : '';

            return $item;
        });

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('index', compact('items', 'categories', 'brands','selectedCategory', 'selectedBrand'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Sale;

class RecommendController extends Controller
{
    public function showRecommend(Request $request)
    {
        //sessionに保存された、閲覧した商品のカテゴリー直近3つ
        $viewedCategories = session('viewed_item_categories', []);

        $recommendedItems = Item::whereIn('category_id', $viewedCategories)->get();

        //売却済ならSoldOutを表示される
        $recommendedItems->map(function ($recommendedItem) {
            $sale = Sale::where('item_id', $recommendedItem->id)->first();
            $recommendedItem->sale = !empty($sale) ? 'SoldOut' : '';

            return $recommendedItem;
        });

        //検索用
        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('recommend', compact('recommendedItems', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }
}
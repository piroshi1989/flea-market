<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class RecommendController extends Controller
{
    public function showRecommend()
    {
        $viewedCategories = session('viewed_item_categories', []);

        $recommendedItems = Item::whereIn('category_id', $viewedCategories)->get();

        //売却済ならSoldOutを表示される
        $recommendedItems->map(function ($recommendedItem) {
            $sale = Sale::where('item_id', $recommendedItem->id)->first();
            $recommendedItem->sale = !empty($sale) ? 'SoldOut' : '';

            return $recommendedItem;
        });

        return view('recommend', compact('recommendedItems'));
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchItems(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category');
        $brandId = $request->input('brand');

        $searchedItems = Item::with('category', 'brand')->ItemsSearch($categoryId, $brandId, $keyword)->get();

        // 売却済ならSoldOutを表示される
        $searchedItems = $searchedItems->map(function ($searchedItem) {
            $sale = Sale::where('item_id', $searchedItem->id)->first();
            $searchedItem->sale = !empty($sale) ? 'SoldOut' : '';

            return $searchedItem;
        });

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('index__search', compact('searchedItems', 'categories', 'brands','selectedCategory', 'selectedBrand'));
    }
}
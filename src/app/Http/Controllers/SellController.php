<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\ChildCategory;
use App\Models\Condition;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function showSell(Request $request)
    {
        $categories = Category::all();
        $conditions = Condition::all();
        $brands = Brand::all();
        $childCategories = ChildCategory::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('sell', compact('categories','childCategories', 'conditions','brands', 'selectedCategory', 'selectedBrand'));
    }

    public function getChildCategories($categoryId)
    {
        // $categoryIdに基づいて関連する子カテゴリーを取得
        $childCategories = ChildCategory::where('category_id', $categoryId)->get();

        return response()->json($childCategories);
    }

    public function storeSell(ItemRequest $request)
    {
        $store = new Item;
        $store->user_id = Auth::id();
        $store->category_id = $request->category_id;
        $store->child_category_id = $request->child_category_id;
        $store->brand_id = $request->brand_id;
        $store->condition_id = $request->condition_id;
        $store->name = $request->name;
        $store->detail = $request->detail;
        $store->price = $request->price;

        $uploadedFile = $request->file('image');
        if ($uploadedFile) {
            $fileName = $uploadedFile->getClientOriginalName();
            $path = 'https://flea-market-s3.s3.ap-northeast-1.amazonaws.com/' . $fileName;
            // S3へファイルをアップロード
            $result = Storage::disk('s3')->put($fileName, file_get_contents($uploadedFile));

            $store->image_url =  $path;
        }

        $store->save();

        return redirect('/sell')->with('message', '商品を出品しました');
    }
}
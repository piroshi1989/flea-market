<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Condition;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ItemRequest;

class SellController extends Controller
{
    public function showSell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        $brands = Brand::all();
        $child_categories = ChildCategory::all();

        return view('sell', compact('categories','child_categories', 'conditions','brands'));
    }

    public function storeSell(ItemRequest $request)
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
}
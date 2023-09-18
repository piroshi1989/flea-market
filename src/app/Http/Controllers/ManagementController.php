<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;

class ManagementController extends Controller
{
    public function showManagement(Request $request)
    {
        $items = Item::paginate(10, ['*'], 'itemPage')->appends(['salePage' => \Request::get('salePage')]);

        // コレクションをマップして新しいフィールドを追加
        $items->map(function ($item) {
            $sale = Sale::where('item_id', $item['id'])->first();
            if(!empty($sale)){
                $result = '○';
            }else{
                $result = '×';
            }
                $item->sell = $result;

                return $item;
        });

        $sales = Sale::paginate(10, ['*'], 'salePage')->appends(['itemPage' => \Request::get('itemPage')]);

        //graph作成用
        $salesTimes = Sale::get('created_at');

        $formattedSalesTimes = $salesTimes->map(function ($salesTime) {
            return [
                //created_atを時間で取得する
                'formatted_created_at' => Carbon::parse($salesTime->created_at)->format('H'),
            ];
        });
        $timeCounts = $formattedSalesTimes->groupBy('formatted_created_at')->map->count();

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

    return view('management', compact('items', 'sales', 'timeCounts', 'categories', 'brands','selectedCategory', 'selectedBrand'));
    }
}
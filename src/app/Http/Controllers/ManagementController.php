<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Pagination\Paginator;

class ManagementController extends Controller
{
    public function showManagement()
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

        return view('management', compact('items', 'sales'));
    }
}
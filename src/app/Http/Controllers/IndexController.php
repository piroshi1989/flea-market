<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Like;

class IndexController extends Controller
{
    public function index()
    {
        $items = Item::with('category', 'condition')->get()->sortBy('id');

        $items = $items->map(function ($item){
            $likeData = Like::where('user_id', $item->user_id)->where('item_id', $item->id)->exists();
            $item->likeData = $likeData;

            return $item;
        });

        return view('index', compact('items'));
    }
}
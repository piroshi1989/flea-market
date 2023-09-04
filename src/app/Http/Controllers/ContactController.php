<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Contact;
use App\Models\Like;

class ContactController extends Controller
{
    public function showItemContact($id){
        $item = Item::findOrFail($id);
        $likeData = Like::where('user_id', $item->user_id)->where('item_id', $item->id)->first();

        // お気に入りのカウントを取得
        $likeCount = Like::where('item_id', $item->id)->count();

        // 問い合わせのカウントを取得
        $contactCount = Contact::where('item_id', $item->id)->count();

        $contacts = Contact::where('item_id', $item->id)->get();

        return view('item', compact('item', 'likeData', 'likeCount', 'contactCount','contacts'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Contact;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function showContact($id)
    {
        $item = Item::findOrFail($id);
        $likeData = Like::where('user_id', $item->user_id)->where('item_id', $item->id)->first();

        // お気に入りのカウントを取得
        $likeCount = Like::where('item_id', $item->id)->count();
        // 問い合わせのカウントを取得
        $contactCount = Contact::where('item_id', $item->id)->count();

        $contacts = Contact::where('item_id', $item->id)->get();

        return view('item__contact', compact('item', 'likeData', 'likeCount', 'contactCount','contacts'));
    }

    public function storeContact(ContactRequest $request)
    {
        $store = new Contact;
        $store->user_id = Auth::id();
        $store->item_id = $request->item_id;
        $store->comment = $request->comment;
        $store->save();

        return redirect('/item/' . $request->item_id . '/contacts')->with('message', 'コメントを送信しました');
    }

    public function destroyContact(Request $request)
    {
    Contact::find($request->id)->delete();
    return redirect('/item/' . $request->item_id . '/contacts')->with('message', 'コメントを削除しました');
    }
}
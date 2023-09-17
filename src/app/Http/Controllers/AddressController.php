<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function showAddress($id)
    {
        $item = Item::findOrFail($id);
        $user = User::findOrFail(Auth::id());

        return view('address',compact('item','user'));
    }

    public function changeAddress(AddressRequest $request)
    {
        $shippingInfo = [
            'name' => $request->name,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building_name' => $request->building_name,
        ];

        //配送先の変更はsessionで取得
        session(['previous_shipping_info' => $shippingInfo]);
        //配送先の変更はsessionで取得

        return redirect('/purchase/' . $request->item_id)->with('message', '配送先を変更しました');
    }
}
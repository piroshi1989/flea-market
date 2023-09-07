<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        
        $item = Item::findOrFail($request->item_id);

        session(['previous_shipping_info' => $shippingInfo]);

        return redirect('/purchase/' . $item['id'])->with('message', '配送先を変更しました');
    }
}
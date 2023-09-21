<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function showAddress($id, Request $request)
    {
        $item = Item::findOrFail($id);
        $user = User::findOrFail(Auth::id());

        //検索用
        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('address',compact('item','user', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
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

        return redirect('/purchase/' . $request->item_id)->with('message', '配送先を変更しました');
    }
}
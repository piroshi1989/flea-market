<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    public function showPurchase($id){
        $item = Item::findOrFail($id);
        $paymentMethod = PaymentMethod::get()->first();
        
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $shippingInfo = [
            'name' => $user->name,
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building_name' => $user->building_name,
        ];
        
        return view('purchase', compact('item','paymentMethod','shippingInfo', 'userId'));
    }

    public function confirm(PurchaseRequest $request)
    {
        $purchaseInfo = $request->all();
        $paymentMethod_name = PaymentMethod::findOrFail($purchaseInfo['payment_method_id'])->name;
        

        return view('purchase__confirm',compact('purchaseInfo', 'paymentMethod_name'));
    }

    public function storePurchase(Request $request)
    {
        $store = new Sale;
        $store->user_id = $request->user_id;
        $store->item_id = $request->item_id;
        $store->payment_amount = $request->payment_amount;
        $store->payment_method_id = $request->payment_method_id;
        $store->shipping_name = $request->shipping_name;
        $store->postcode = $request->postcode;
        $store->address = $request->address;
        $store->building_name = $request->building_name;

        if($request->payment_method_id == 1){
            $paymentCode = mt_rand(100000000, 999999999);
            $paymentMethodId = $request->payment_method_id;
            $store->payment_code = $paymentCode;
        }

        $store->save();

        $saleInfo = Sale::where('item_id', $request->item_id)->first();
        $salePaymentMethodId = $saleInfo['payment_method_id'];

        return view('purchase__thanks', compact('saleInfo',));
    }

}
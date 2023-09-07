<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Item;

class PaymentMethodController extends Controller
{
    public function showPaymentMethod($id){

        $item = Item::findOrFail($id);

        $paymentMethods = PaymentMethod::all();

        return view('paymentMethod',compact('paymentMethods','item'));
    }

    public function selectPaymentMethod(Request $request){

        $item = Item::findOrFail($request->item_id);

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);
        
        session(['previous_payment_method' => $paymentMethod]);

        return redirect('/purchase/' .$item['id'])->with('message', '支払方法を変更しました');
    }
}
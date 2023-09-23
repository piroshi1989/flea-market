<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;

class PaymentMethodController extends Controller
{
    public function showPaymentMethod($itemId, Request $request)
    {
        $item = Item::findOrFail($itemId);
        $paymentMethods = PaymentMethod::all();

        //検索用
        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('payment__method',compact('paymentMethods','item', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }

    public function selectPaymentMethod(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);

        session(['previous_payment_method' => $paymentMethod]);

        return redirect('/purchase/' .$item['id'])->with('message', '支払方法を変更しました');
    }
}
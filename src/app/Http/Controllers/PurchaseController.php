<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\PaymentMethod;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    public function showPurchase($itemId, Request $request)
    {
        $item = Item::findOrFail($itemId);
        //デフォルトはコンビニ払いにする
        $paymentMethod = PaymentMethod::get()->first();

        $userId = Auth::id();
        $user = Auth::user();

        $shippingInfo = [
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building_name' => $user->building_name,
        ];

        //検索用
        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('purchase', compact('item','paymentMethod','shippingInfo', 'userId', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }

    public function confirm(PurchaseRequest $request)
    {
        $purchaseInfo = $request->all();
        $paymentMethodName = PaymentMethod::findOrFail($purchaseInfo['payment_method_id'])->name;

        $shippingName = Auth::user()->name;

        //検索用
        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('purchase__confirm',compact('purchaseInfo','shippingName', 'paymentMethodName', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }

    public function storePurchase(PurchaseRequest $request)
    {
        $store = new Sale;
        $store->user_id = $request->user_id;
        $store->item_id = $request->item_id;
        $store->payment_amount = $request->payment_amount;
        $store->payment_method_id = $request->payment_method_id;
        $store->postcode = $request->postcode;
        $store->address = $request->address;
        $store->building_name = $request->building_name;

        //コンビニ払いなら、ランダムで支払番号を出力し保存する
        $existingPaymentCodes = Sale::pluck('payment_code')->toArray();

        // 重複しないランダムなコードを生成する
        do {
            $paymentCode = mt_rand(100000000, 999999999);
        } while (in_array($paymentCode, $existingPaymentCodes));

        // 生成されたコードを使用する
        $paymentMethodId = $request->payment_method_id;
        $store->payment_code = $paymentCode;

        $store->save();

        $saleInfo = Sale::where('item_id', $request->item_id)->first();
        $salePaymentMethodId = $saleInfo['payment_method_id'];
        

        //検索用
        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('purchase__thanks', compact('saleInfo','categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }

}
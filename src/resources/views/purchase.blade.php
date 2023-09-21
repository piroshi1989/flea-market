@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert">
    {{session('message')}}
</div>
@endif
<div class="purchase">
    <div class="item__wrap">
        <div class= "item__content">
            <div class="item__image">
                <img src="{{asset($item->image_url)}}">
            </div>
            <div class="item__detail">
                <p class="item__name">{{ $item->name }}</p>
            </div>
        </div>
        <div class="payment__wrap">
            <div class="payment__method">
                <h3 class="purchase__title">支払方法</h3>
                <div class="change__link">
                    <a href="{{ asset('/paymentmethod/' . $item->id) }}">変更する</a>
                </div>
            </div>
            <div class="shipping__address">
                <h3 class="purchase__title">配送先</h3>
                <div class="change__link">
                <a href="{{ asset('/address/' . $item->id) }}">変更する</a>
                </div>
            </div>
            {{-- ユーザーの郵便番号もしくは住所どちらかが登録されていない、かつ、配送先の変更でsessionにも住所が登録されていない場合 --}}
            @if((empty($shippingInfo['postcode']) || empty($shippingInfo['address'])) && empty(session('previous_shipping_info')))
            <div class = "shipping__arart">
                <p>配送先の情報が不足しています。<br>
                配送先を変更するか、<a href="/mypage/profile">プロフィール</a>から住所を更新してください</p>
            </div>
            @endif
        </div>
    </div>
    <div class="purchase__wrap">
        <div class="purchase-table">
            <table class="purchase-table__inner">
                <tr class="purchase-table__row">
                    <th class="purchase-table__header-first">
                        <span class="purchase-table__header-span">商品代金</span>
                    </th>
                    <td class="purchase-table__item-first">
                        ¥{{ $item->price }}
                    </td>
                </tr>
                <tr class="purchase-table__row">
                    <th class="purchase-table__header">
                        <span class="purchase-table__header-span">支払金額</span>
                    </th>
                    <td class="purchase-table__item">
                        ¥{{ $item->price }}
                    </td>
                </tr>
                <tr class="purchase-table__row">
                    <th class="purchase-table__header">
                        <span class="purchase-table__header-span">支払方法</span>
                    </th>
                    <td class="purchase-table__item">
                        {{ session('previous_payment_method')['name'] ?? $paymentMethod->name }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__content">
            <form action="/purchase/confirm" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userId}}">
                <input type="hidden" name="item_id" value="{{ $item->id}}">
                <input type="hidden" name="payment_amount" value="{{ $item->price}}">
                @if(empty(session('previous_payment_method')))
                <input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id }}">
                @else
                <input type="hidden" name="payment_method_id" value="{{ session('previous_payment_method')['id'] }}">
                @endif
                <input type="hidden" name="shipping_name" value="{{ $shippingInfo['name'] }}">

                @if( empty(session('previous_shipping_info')))
                <input type="hidden" name="postcode" value="{{ $shippingInfo['postcode'] }}">
                <input type="hidden" name="address" value="{{ $shippingInfo['address'] }}">
                <input type="hidden" name="building_name" value="{{ $shippingInfo['building_name'] }}">
                @else
                <input type="hidden" name="postcode" value="{{ session('previous_shipping_info')['postcode'] }}">
                <input type="hidden" name="address" value="{{ session('previous_shipping_info')['address'] }}">
                <input type="hidden" name="building_name" value="{{ session('previous_shipping_info')['building_name'] }}">
                @endif
                <button class="form__button-submit" type="submit">購入確認
                </button>
            </form>
            <div class="form__error">
                @error('postcode')
                {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                @error('building_name')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var form = document.querySelector(".form");
  var keywordInput = document.querySelector(".keyword");

  // キーワード入力欄でEnterキーが押されたときにフォームを送信
  keywordInput.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
      event.preventDefault(); // デフォルトの送信動作をキャンセル
      form.submit(); // フォームを送信
    }
  });
});
</script>
@endsection
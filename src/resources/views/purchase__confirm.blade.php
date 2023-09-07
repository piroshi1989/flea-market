@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form__confirm.css') }}">
@endsection

@section('content')
<div class="form__content">
    <h2 class="form__heading">購入内容確認</h2>
    <form class="form" action="/purchase/thanks" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ $purchaseInfo['user_id'] }}">
        <input type="hidden" name="item_id" value="{{ $purchaseInfo['item_id']}}">
        <input type="hidden" name="payment_method_id" value="{{ $purchaseInfo['payment_method_id'] }}">
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">支払金額</p>
                <input class="confirm__item" type="text" name="payment_amount" value="{{  $purchaseInfo['payment_amount'] }}" readonly>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">支払方法</p>
                <div class="confirm__item">
                    <p>{{ $paymentMethod_name }}</p>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">送り先宛名</p>
                <input type="text" class="confirm__item" name="shipping_name" value="{{ $purchaseInfo['shipping_name'] }}" readonly>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">postcode</p>
                <input type="text" class="confirm__item" name="postcode" value="{{ $purchaseInfo['postcode'] }}" readonly>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">address</p>
                <input type="text" class="confirm__item" name="address" value="{{ $purchaseInfo['address'] }}" readonly>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">building_name</p>
                <input type="text" name="building_name" class="confirm__item" value="{{ $purchaseInfo['building_name'] }}" readonly>
            </div>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">購入する</button>
        </div>
    </form>
</div>
@endsection
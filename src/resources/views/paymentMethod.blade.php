@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="form__content">
    <h2 class="form__heading">支払方法の変更</h2>
    <form class="form" action="{{ asset('/paymentmethod/select')}}" method="post">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">
            <div class="form__group-content">
                <p class="input__title">支払方法</p>
                <select name="payment_method_id" class="payment_method_id">
                    <option>選択してください</option>
                    @foreach($paymentMethods as $paymentMethod)
                    <option class="paymentMethods__option" value="{{ $paymentMethod->id}}">
                        {{ $paymentMethod->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">変更する</button>
        </div>
    </form>
</div>
@endsection
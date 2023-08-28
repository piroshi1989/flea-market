@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="form__content">
    <h2 class="form__heading">商品の出品</h2>
    <div class="upload__photo-content">
        <div class="upload__photo-button">
            <a href="">画像を選択する</a>
        </div>
    </div>
    <form class="form" action="/address" method="post">
        @csrf
        <div class="form__group">
            <h3 class="form__title">商品の詳細</h3>
            <div class="line"></div>
            <div class="form__group-content">
                <p class="input__title">カテゴリー</p>
                <input type="text" name="category" value="{{ old('category') }}">
            </div>
            <div class="form__error">
            @error('category')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">商品の状態</p>
                <input type="text" name="condition" value="{{ old('condition') }}">
            </div>
            <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
            </div>
        </div>
        <h3 class="form__title">商品名と説明</h3>
        <div class="line"></div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">商品名</p>
                <input type="text" name="item_name" value="{{ old('item_name') }}">
            </div>
            <div class="form__error">
            @error('item_name')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">商品の説明</p>
                <input type="text" name="item_detail" value="{{ old('item_detail') }}">
            </div>
            <div class="form__error">
            @error('item_name')
            {{ $message }}
            @enderror
            </div>
        </div>
        <h3 class="form__title">販売価格</h3>
        <div class="line"></div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">販売価格</p>
                <input type="text" name="item_price" value="{{ old('item_price') }}">
            </div>
            <div class="form__error">
            @error('item_price')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
</div>
@endsection
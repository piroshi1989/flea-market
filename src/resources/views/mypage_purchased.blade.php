@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile__content">
    <div class="profile__inner">
        <div class="profile__image">
            <img src="{{asset($user['image_url'])}}">
        </div>
        <p class="user__name">{{ $user->name }}</p>
    </div>
    <div class="profile__image-button">
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>
<div class= index__select>
    <a href="/mypage/selled" class="non-color__select">出品した商品</a>
    <a href="/mypage/purchased" class= "color__select">購入した商品</a>
</div>
<div class="line"></div>
<div class="item__wrap">
    @foreach($purchasedItems as $purchasedItem)
    <div class="item__content">
    <div class="item__image">
        <a href="{{ asset('/item/' . $purchasedItem['id']) }}">
            <img src="{{asset($purchasedItem['image_url'])}}">
        </a>
    </div>
    <div class="item__info">
        <p class="item__price">\ {{ $purchasedItem['price'] }}</p>
    </div>
    </div>
    @endforeach
</div>
@endsection
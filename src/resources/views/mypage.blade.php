@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile__content">
    <div class="profile__inner">
        <div class="profile__image">
        </div>
        <p class="user__name">ユーザー名</p>
    </div>
    <div class="profile__image-button">
        <a href="/profile">プロフィールを編集</a>
    </div>
</div>
<div class= index__select>
    <p class="color__select">出品した商品</p>
    <p class= "non-color__select">購入した商品</p>
</div>
<div class="line"></div>
<div class="item__content">
    <div class="item">
    </div>
</div>
@endsection
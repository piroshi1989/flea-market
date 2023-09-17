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
    <a href="/mypage/purchased" class= "non-color__select">購入した商品</a>
    <a href="/mypage/following" class= "non-color__select">フォローしたユーザー</a>
</div>
<div class="line"></div>
@endsection
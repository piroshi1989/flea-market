@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile__content">
    <div class="profile__inner">
        <div class="profile__image">
            @empty($user->image_url)
            <i class="bi bi-person-circle"></i>
            @else
            <img src="{{asset($user->image_url)}}">
            @endempty
        </div>
        <p class="user__name">{{ $user->name }}</p>
    </div>
    <div class="profile__image-button">
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>
<div class= index__select>
    <a href="/mypage/exhibited" class="non-color__select">出品した商品</a>
    <a href="/mypage/purchased" class= "non-color__select">購入した商品</a>
    <a href="/mypage/following" class= "non-color__select">フォローしたユーザー</a>
</div>
<hr class="centered-hr">
@endsection
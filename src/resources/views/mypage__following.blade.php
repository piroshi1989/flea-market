@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert">
    {{session('message')}}
</div>
@endif
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
    <a href="/mypage/following" class= "color__select">フォローしたユーザー</a>
</div>
<hr class="centered-hr">
<div class="following__wrap">
    @foreach($followingUsers as $followingUser)
    <div class= "following__content">
        <div class="following__image">
            @empty($followingUser['image_url'])
            <i class="bi bi-person-circle"></i>
            @else
            <img src="{{asset($followingUser['image_url'])}}">
            @endempty
        </div>
        <p class="following__name">{{ $followingUser['name'] }}</p>
        <form class="delete-form" action="/following/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
                <input type="hidden" name="id" value="{{ $followingUser['id'] }}">
                <button class="delete-form__button-submit" type="submit">フォローをやめる</button>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection
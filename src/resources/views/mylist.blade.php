@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class= index__select>
    <a href="/recommend" class= "non-color__select">おすすめ</a>
    <a href="/mylist" class= "color__select">マイリスト</a>
</div>
<hr class="centered-hr">
@if($likedItems->isNotEmpty())
<h3 class="item__title">お気に入り</h3>
<div class="item__wrap">
  @foreach($likedItems as $likedItem)
  <div class="item__content">
    <div class="item__image">
      <a href="{{ asset('/item/' . $likedItem->item['id'] )}}">
        <img src="{{asset($likedItem->item['image_url'])}}">
      </a>
    </div>
    <div class="item__info">
      <p class="item__price">\ {{ $likedItem->item['price']}}</p>
    </div>
  </div>
  @endforeach
</div>
@endif
<hr class="centered-hr">
@if( $followingUsersItems->isNotEmpty())
<h3 class="item__title">
フォロー中のユーザーの商品
</h3>
<div class="item__wrap">
  @foreach( $followingUsersItems as  $followingUsersItem)
  <div class="item__content">
    <div class="item__image">
      <a href="{{ asset('/item/' .  $followingUsersItem['id'] ) }}">
        <img src="{{asset($followingUsersItem['image_url'])}}">
      </a>
    </div>
    <div class="item__info">
      <p class="item__price">\ {{ $followingUsersItem['price'] }}</p>
    </div>
  </div>
  @endforeach
</div>
@endif


@endsection
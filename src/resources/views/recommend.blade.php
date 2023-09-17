@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class= index__select>
    <a href="/recommend" class= "color__select">おすすめ</a>
    <a href="/mylist" class= "non-color__select">マイリスト</a>
</div>
<hr>
{{-- 閲覧した商品のカテゴリーをsessionで取得し、そのカテゴリーに属する商品を表示 --}}
<h3 class="item__title">
    閲覧した商品のカテゴリーと関連した商品
</h3>
<div class="item__wrap">
  @foreach($recommendedItems as $recommendedItem)
  <div class="item__content">
    <div class="item__image">
      <a href="{{ asset('/item/' . $recommendedItem['id']) }}">
        <img src="{{asset($recommendedItem['image_url'])}}">
      </a>
      @if($recommendedItem['sale'] === 'SoldOut')
      <div class="soldout-label">SoldOut</div>
      @endif
    </div>
    <div class="item__info">
      <p class="item__price">\ {{ $recommendedItem['price'] }}</p>
    </div>
  </div>
  @endforeach
</div>



@endsection
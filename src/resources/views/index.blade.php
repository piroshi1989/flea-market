@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class= index__select>
    <p class="color__select">おすすめ</p>
    <p class= "non-color__select">マイリスト</p>
</div>
<div class="line"></div>

<div class="item__wrap">
  @foreach($items as $item)
  <div class="item__content">
    <a href="{{ asset('/item/' . $item['id']) }}">
      <div class="item__image">
        <img src="{{asset($item['image_url'])}}">
      </div>
    </a>
    <div class="item__info">
      <p class="item__price">\ {{ $item['price'] }}</p>
      @auth
      <div class="likes">
        <i class="bi bi-heart-fill like-toggle"
          data-like-id="{{ $item['like_id']}}"
          data-item-id="{{ $item['id'] }}"
          data-user-id="{{ Auth::id() }}"></i>
      </div>
      @endauth
    </div>
  </div>
  @endforeach
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var form = document.querySelector(".form");
  var keywordInput = document.querySelector(".keyword");

  // キーワード入力欄でEnterキーが押されたときにフォームを送信
  keywordInput.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
      event.preventDefault(); // デフォルトの送信動作をキャンセル
      form.submit(); // フォームを送信
    }
  });
});
</script>
@endsection
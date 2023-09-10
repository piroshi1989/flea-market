@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class= index__select>
    <p class="color__select">おすすめ</p>
    <a href="/mylist" class= "non-color__select">マイリスト</a>
</div>
<hr>
<div class="item__wrap">
  @foreach($items as $item)
  <div class="item__content">
    <div class="item__image">
      <a href="{{ asset('/item/' . $item['id']) }}">
        <img src="{{asset($item['image_url'])}}">
      </a>
    </div>
    <div class="item__info">
      <p class="item__price">\ {{ $item['price'] }}</p>
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
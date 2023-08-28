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
<div class="item__content">
    <div class="item">
    </div>
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
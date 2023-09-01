@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class= "item__content">
        <div class="item__image">
            <img src="{{asset($item['image_url'])}}">
        </div>
    <div class="item__detail">
        <p class="item__name">{{ $item['name'] }}</p>
        <p class="item__brand">ブランド</p>
        <p class="item__price">¥{{ $item['price'] }}(値段)</p>
        <div class="counter__icons">
            <div class="likes__count"></div>
            <div class="posts__count"></div>
        </div>
        <div class="form__content">
            <form action="/parchase" method=post>
                <button class="form__button-submit" type="submit">購入する
                </button>
            </form>
        </div>
        <h3 class="item__description">商品説明</h3>
        <p class="description__detail">{{ $item['detail'] }}
        </p>
        <h3 class="item__information">商品の情報</h3>
        <div class="item__information-table">
            <table class="item__information-table__inner">
                <tr class="item__information-table__row">
                    <th class="item__information-table__header">
                    <span class="item__information-table__header-span">カテゴリー</span>
                    </th>
                    <td class="item__information-table__item__category">
                        <div class="item__category">
                            {{ $item->category->name }}
                        </div>
                        <div class="item__category">
                            {{ $item->category->name }}
                        </div>
                    </td>
                </tr>
                <tr class="item__information-table__row">
                    <th class="item__information-table__header">
                    <span class="item__information-table__header-span">商品の状態</span>
                    </th>
                    <td class="item__information-table__item">
                        {{ $item->condition->name }}
                    </td>
                </tr>
            </table>
        </div>
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
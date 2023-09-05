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
        <p class="item__price_detail">¥{{ $item['price'] }}(値段)</p>
        <div class="counter__icons">
            <div class="likes__count">
                @auth
                <i class="bi bi-star like-toggle"
                data-like-id="{{ $likeData}}"
                data-item-id="{{ $item['id'] }}"
                data-user-id="{{ Auth::id() }}"></i>
                @endauth
                @guest
                <i class="bi bi-star like-toggle"></i>
                @endguest
                <span class= "like-count" id="like-count">{{ $likeCount }}</span>
            </div>
            <div class="contacts__count">
                <a class="icon-link" href={{ asset('/item/' . $item['id']) . '/contacts' }}>
                <i class="bi bi-chat"></i>
                </a>
                <span class= "contact-count">{{ $contactCount }}</span>
            </div>
        </div>
        <div class="form__content">
                <a href="/parchase" class="form__button-submit">購入する
                </a>
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
                        @if($item->childCategory->name !== 'その他')
                        <div class="item__category">
                            {{ $item->childCategory->name }}
                        </div>
                        @endif
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/ajaxlike.js') }}"></script>
@endsection
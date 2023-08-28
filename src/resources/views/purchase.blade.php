@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
    <div class="item__wrap">
        <div class= "item__content">
            <div class="item__photo">
                商品画像
            </div>
            <div class="item__detail">
                <p class="item__name">商品名</p>
                <p class="item__price">¥47,000</p>
            </div>
        </div>
        <div class="payment__wrap">
            <div class="payment__method">
                <h3 class="purchase__title">支払方法</h3>
                <div class="change__link">
                <a href="/??">変更する</a>
                </div>
            </div>
            <div class="shipping__address">
                <h3 class="purchase__title">配送先</h3>
                <div class="change__link">
                <a href="/address">変更する</a>
                </div>
            </div>
        </div>
    </div>
    <div class="purchase__wrap">
        <div class="purchase-table">
            <table class="purchase-table__inner">
                <tr class="purchase-table__row">
                    <th class="purchase-table__header-first">
                    <span class="purchase-table__header-span">商品代金</span>
                    </th>
                    <td class="purchase-table__item-first">
                        ¥47,000
                    </td>
                </tr>
                <tr class="purchase-table__row">
                    <th class="purchase-table__header">
                    <span class="purchase-table__header-span">支払金額</span>
                    </th>
                    <td class="purchase-table__item">
                        ¥47,000
                    </td>
                </tr>
                <tr class="purchase-table__row">
                    <th class="purchase-table__header">
                    <span class="purchase-table__header-span">支払方法</span>
                    </th>
                    <td class="purchase-table__item">
                        コンビニ払い
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__content">
            <form action="/parchase" method=post>
                <button class="form__button-submit" type="submit">購入する
                </button>
            </form>
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
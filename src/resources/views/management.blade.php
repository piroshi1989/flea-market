@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/management.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert">
    {{session('message')}}
</div>
@endif
<div class="form__content">
    <h2 class="form__heading">管理者作成</h2>
    <form class="form h-adr" action="/management/store" method="post">
        @csrf
        <input type ="hidden" name="role" value=1>
        <span class="p-country-name" style="display:none;">Japan</span>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">名前</p>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">メールアドレス</p>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">パスワード</p>
                <input type="password" name="password">
            </div>
            <div class="form__error">
            @error('password')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">郵便番号</p>
                <input type="text" class="p-postal-code" name="postcode" value="{{ old('postcode') }}">
            </div>
            <div class="form__error">
            @error('postcode')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">住所</p>
                <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address" value="{{ old('address') }}">
            </div>
            <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">建物名</p>
                <input type="text" name="building_name" value="{{ old('building_name') }}">
            </div>
            <div class="form__error">
            @error('building_name')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">管理者を作成する</button>
        </div>
    </form>
</div>
<hr>
<div class= "item-list">
    <h2 class="form__heading">商品一覧</h2>
    <div class="item-table">
        <table class="item-table__inner">
            <tr class="item-table__row">
                <th class="item-table__header">
                    <span class="item-table__header-span">商品ID</span>
                </th>
                <th class="item-table__header">
                    <span class="item-table__header-span">商品名</span>
                </th>
                <th class="item-table__header">
                <span class="item-table__header-span">商品代金</span>
                </th>
                <th class="item-table__header">
                    <span class="item-table__header-span">出品者</span>
                </th>
                <th class="item-table__header  number-column">
                    <span class="item-table__header-span">売却</span>
                </th>
            </tr>
            @if($items->isNotEmpty())
            @foreach ($items as $item)
            <tr class="item-table__row">
                <td class="item-table__item">
                {{ $item['id'] }}
                </td>
                <td class="item-table__item">
                {{ $item['name'] }}
                </td>
                <td class="item-table__item">
                {{ $item['price'] }}
                </td>
                <td class="item-table__item">
                {{ $item->user->name }}
                </td>
                <td class="item-table__item">
                {{ $item->sell }}
                </td>
            </tr>
            @endforeach
            @else
            <p>商品情報はありません</p>
            @endif
        </table>
    </div>
    <div class="paginate__links">
    {{ $items->links() }}
    </div>
</div>
<hr>
<div class = "payment__confirm">
    <h2 class="form__heading">送金額確認</h2>
    <div class="item-table">
        <table class="item-table__inner">
            <tr class="item-table__row">
                <th class="item-table__header">
                    <span class="item-table__header-span">売却ID</span>
                </th>
                <th class="item-table__header">
                    <span class="item-table__header-span">商品名</span>
                </th>
                <th class="item-table__header">
                <span class="item-table__header-span">送金額</span>
                </th>
                <th class="item-table__header">
                    <span class="item-table__header-span">出品者</span>
                </th>
                <th class="item-table__header  number-column">
                    <span class="item-table__header-span">購入者</span>
                </th>
            </tr>
            @if($sales->isNotEmpty())
            @foreach ($sales as $sale)
            <tr class="item-table__row">
                <td class="item-table__item">
                {{ $sale['id'] }}
                </td>
                <td class="item-table__item">
                {{ $sale->item->name }}
                </td>
                <td class="item-table__item">
                {{ $sale['payment_amount'] }}
                </td>
                <td class="item-table__item">
                {{ $sale->item->user->name }}
                </td>
                <td class="item-table__item">
                {{ $sale->user->name }}
                </td>
            </tr>
            @endforeach
            @else
            <p>商品情報はありません</p>
            @endif
        </table>
    </div>
    <div class="paginate__links">
    {{ $sales->links() }}
    </div>
</div>
<hr>
<div class="form__content">
    <h2 class="form__heading">メール作成</h2>
    <form class="form" method="POST" action="/mail/confirm">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">件名</p>
                <input type="text" name="subject" value="{{ old('subject') }}">
            </div>
            <div class="form__error">
            @error('subject')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">本文</p>
                <textarea name="body" value="{{ old('body') }}"></textarea>
            </div>
            <div class="form__error">
            @error('body')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">メールを送信する</button>
        </div>
    </form>
</div>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert">
    {{session('message')}}
</div>
@endif
<div class= "item__content">
    <div class="item__image">
        <img src="{{ asset($item->image_url) }}">
    </div>
    <div class="item__detail">
        <p class="item__name">{{ $item->name }}</p>
        <p class="item__brand">{{ $item->brand->name }}</p>
        <p class="item__price_detail">¥{{ $item->price }}(値段)</p>
        <div class="counter__icons">
            <div class="likes__count">
                @auth
                <i class="bi bi-star like-toggle"
                data-like-id="{{ $likeData}}"
                data-item-id="{{ $item->id }}"
                data-user-id="{{ Auth::id() }}"></i>
                @endauth
                @guest
                <i class="bi bi-star like-toggle"></i>
                @endguest
                <span class= "like-count" id="like-count">{{ $likeCount }}</span>
            </div>
            <div class="contacts__count">
                <a class="icon-link" href={{ asset('/item/' . $item->id) . '/contacts' }}>
                <i class="bi bi-chat"></i>
                </a>
                <span class= "contact-count">{{ $contactCount }}</span>
            </div>
        </div>
        <div class="form__content">
            @if($soldOutInfo)
            <a class="form__button-submit">売却済です
            </a>
            @elseif($item->user_id === $userId)
            <a class="form__button-submit">出品商品です
            </a>
            @else
            @auth
            <a href={{ asset('/purchase/' . $item->id)}} class="form__button-submit">購入する
            </a>
            @endauth
            @endif
            @guest
            <a class="form__button-submit">購入にはログインしてください
            </a>
            @endguest
        </div>
        <h3 class="item__description">商品説明</h3>
        <p class="description__detail">{{ $item->detail }}</p>
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
                        @if((!empty($item->childCategory->name)) && $item->category->name !== 'その他' )
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
        @can('user')
        @if($userId !== $item->user_id && empty($followingUsers))
        <div class="following__content">
            <form class="form" method="post" action="/following/store">
            @csrf
                <input type="hidden" name="user_id" value="{{ $userId }}">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="following_user_id" value="{{ $item->user_id}}">
                <div class="form__button">
                    <button class="form__button-submit" type="submit">出品者をフォローする</button>
                </div>
            </form>
        </div>
        @elseif($userId !== $item->user_id && !empty($followingUsers))
        <div class="following__content">
            <form class="form" method="post" action="/following/delete">
            @csrf
            @method('DELETE')
                <input type="hidden" name="id" value="{{ $item->user_id}}">
                <div class="form__button">
                    <button class="form__button-submit" type="submit">出品者のフォローをやめる</button>
                </div>
            </form>
        </div>
        @endif
        @endcan
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/ajaxlike.js') }}"></script>
@endsection
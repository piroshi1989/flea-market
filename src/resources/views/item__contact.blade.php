@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert">
    {{session('message')}}
</div>
@endif
<div class = "item__content">
        <div class="item__image">
            <img src="{{asset($item['image_url'])}}">
        </div>
        <div class= "item-contact__wrap">
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
    </div>
    <div class= "contact__content">
        @foreach($contacts as $contact)
        <div class= "profile__content{{ $contact->user['id'] === $item['user_id'] ? ' right-align' : '' }}">
            <div class="profile__image">
                @if(!empty($contact->user['image_url']))
                <img src="{{asset($contact->user['image_url'])}}">
                @else
                <i class="bi bi-person-circle"></i>
                @endif
            </div>
            <p class="profile__name">{{ $contact->user['name'] }}</p>
        </div>
        <div class="contact__comment">
            {{ $contact['comment'] }}
        </div>
        @if($contact->user_id === Auth::id())
            <form class= "form" action ="/contact/delete" method="post">
            @csrf
            @method('DELETE')
                <div class="delete-form__button">
                    <input type="hidden" name="id" value="{{ $contact['id'] }}">
                    <input type="hidden" name="item_id" value="{{ $contact['item_id']}}">
                    <button class="delete-form__button-submit" type="submit">削除</button>
                </div>
            </form>
        @endif
        @endforeach
        @can('user')
        <form class="form" method="POST" action="/contact/store">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">商品へのコメント</p>
                <textarea name="comment" value="{{ old('comment') }}"></textarea>
            </div>
            <div class="form__error">
            @error('comment')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">コメントを送信する</button>
        </div>
        </form>
        @endcan
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/ajaxlike.js') }}"></script>
@endsection
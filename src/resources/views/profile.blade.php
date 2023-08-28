@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="form__content">
    <h2 class="form__heading">プロフィール設定</h2>
    <div class="profile__content">
        <div class="profile__image">
        </div>
        <div class="upload__image-button">
            <a href="">画像を選択する</a>
        </div>
    </div>
    <form class="form" action="/profile" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">ユーザー名</p>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
            </div>
            <div class="form__group-content">
                <p class="input__title">郵便番号</p>
                <input type="text" name="postcode" value="{{ old('postcode') }}">
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
                <input type="text" name="address">
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
                <input type="text" name="buildingname">
            </div>
            <div class="form__error">
            @error('buildingname')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection
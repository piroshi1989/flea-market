@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert">
    {{session('message')}}
</div>
@endif
<div class="form__content">
    <h2 class="form__heading">プロフィール設定</h2>
    <div class="profile__content">
        <div class="profile__image">
            <img src="{{asset($user['image_url'])}}">
        </div>
        <form  class="upload__form" method="POST" action="profile/upload" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <label for="fileInput" class="upload__image-button">
        </label>
        <input type="file" name="image" id="fileInput" style="display: none;">
        </form>
    </div>

    <form class="form h-adr" action="profile/update" method="post" >
        @csrf
        @method('PATCH')
        <input type="hidden" name="form_type" value="profile_form" >
        <span class="p-country-name" style="display:none;">Japan</span>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">ユーザー名</p>
                <input type="text" name="name" value="{{ old('name', $user->name) }}">
            </div>
            <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
            </div>
            <div class="form__group-content">
                <p class="input__title">郵便番号</p>
                <input type="text" class="p-postal-code" name="postcode" value="{{ old('postcode', $user->postcode) }}">
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
                <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address" value="{{ old('address', $user->address) }}">
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
                <input type="text" name="building_name" value="{{ old('building_name', $user->building_name) }}">
            </div>
            <div class="form__error">
            @error('building_name')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
<script>
    document.getElementById('fileInput').addEventListener('change', function() {
        document.getElementById('uploadForm').submit();
    });
</script>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
@endsection
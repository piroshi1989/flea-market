@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="form__content">
    <h2 class="form__heading">住所の変更</h2>
    <form class="form" action="/address" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">郵便番号</p>
                <input type="text" name="post-code" value="{{ old('post-code') }}">
            </div>
            <div class="form__error">
            @error('post-code')
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
                <input type="text" name="building-name">
            </div>
            <div class="form__error">
            @error('building-name')
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
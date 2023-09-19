@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="form__content">
    <h2 class="form__heading">メール内容確認</h2>
    <form class="form" action="/mail/send" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">件名</p>
                <input type="text" name="subject" value="{{ $emails->subject }}" readonly>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">本文</p>
                <textarea class="mail__body" name="body" readonly>{{ $emails->body }}</textarea>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit" name="action" value="back">入力内容修正</button>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit" name="action" value="submit">送信</button>
        </div>
    </form>
</div>
@endsection
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>flea-market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
<div class="form__content">
    <h2 class="form__heading">住所の変更</h2>
    <form class="form h-adr" action="/address/change" method="post">
        @csrf
        <input type="hidden" name="name" value="{{ $user->name }}">
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <span class="p-country-name" style="display:none;">Japan</span>
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
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</body>
</html>
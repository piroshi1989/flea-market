@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert">
    {{session('message')}}
</div>
@endif
<div class="form__content">
    <h2 class="form__heading">商品の出品</h2>
    <div class="item__image">
        <img id="imagePreview" src="" alt="画像プレビュー" style="max-width: 100%; display: none;">
    </div>
    <form  class="form" method="POST" action="/sell/store" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <label for="fileInput" class="upload__image-button">
        </label>
        <input type="file" name="image" id="fileInput" style="display: none;">
        <div class="form__group">
            <h3 class="form__title">商品の詳細</h3>
            <div class="line"></div>
            <div class="form__group-content">
                <p class="input__title">カテゴリー</p>
                <select name="category_id" class="category_id">
                    <option>選択してください</option>
                    @foreach($categories as $category)
                    <option class="categories__option" value="{{ $category->id}}">
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__group-content">
                <p class="input__title">カテゴリー2</p>
                <select name="child_category_id" class="child_category_id">
                    <option>選択してください</option>
                    @foreach($child_categories as $child_category)
                    <option class="child_categories__option" value="{{ $child_category->id}}">
                        {{ $child_category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
            @error('category_id')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">商品の状態</p>
                <select name="condition_id" class="condition_id">
                    <option>選択してください</option>
                    @foreach($conditions as $condition)
                    <option class="conditions__option" value="{{ $condition->id}}">
                        {{ $condition->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
            @error('condition_id')
            {{ $message }}
            @enderror
            </div>
        </div>
        <h3 class="form__title">商品名と説明</h3>
        <div class="line"></div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">商品名</p>
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
                <p class="input__title">商品の説明</p>
                <textarea name="detail" value="{{ old('detail') }}"></textarea>
            </div>
            <div class="form__error">
            @error('detail')
            {{ $message }}
            @enderror
            </div>
        </div>
        <h3 class="form__title">販売価格</h3>
        <div class="line"></div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">販売価格</p>
                <input type="text" name="price" placeholder="¥" value="{{ old('price') }}">
            </div>
            <div class="form__error">
            @error('price')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // カテゴリーの選択が変更されたときのイベントリスナー
    $('.category_id').on('change', function () {
        var selectedCategoryId = $(this).val();
        // 選択したカテゴリーIDを取得

        // 関連する子カテゴリーのドロップダウンを更新
        $('.child_category_id').empty(); // 子カテゴリーのドロップダウンをクリア

        // 選択したカテゴリーに関連する子カテゴリーを取得してドロップダウンに追加
        $.ajax({
            url: '/get-child-categories/' + selectedCategoryId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.child_category_id').append('<option value="">選択してください</option>');
                $.each(data, function (key, value) {
                    $('.child_category_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
});
$(document).ready(function () {
    // ファイル選択時のイベントリスナーを設定
    $('#fileInput').on('change', function (e) {
        var fileInput = e.target;
        var imagePreview = $('#imagePreview')[0];

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // 選択した画像のデータURLをプレビューに設定し表示
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // プレビュー表示
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    });
});

</script>

@endsection
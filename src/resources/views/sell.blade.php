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
        <div class="form__error">
            @error('image')
            {{ $message }}
            @enderror
        </div>
        <div class="form__group">
            <h3 class="form__title">商品の詳細</h3>
            <hr class="centered-hr">
            <div class="form__group-content">
                <p class="input__title">カテゴリー</p>
                <select name="category_id" class="category_id">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                    <option class="categories__option" value="{{ $category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }} >
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group-content">
                <p class="input__title">カテゴリー2</p>
                <select name="child_category_id" class="child_category_id">
                    <option value="">選択してください</option>
                    @foreach($childCategories as $childCategory)
                    <option class="child_categories__option" value="{{ $childCategory->id}}"  {{ old('child_category_id') == $childCategory->id ? 'selected' : '' }} >
                        {{ $childCategory->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">ブランド名</p>
                <select name="brand_id" class="brand_id">
                    <option value="">選択してください</option>
                    @foreach($brands as $brand)
                    <option class="brands__option" value="{{ $brand->id}}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('brand_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">商品の状態</p>
                <select name="condition_id" class="condition_id">
                    <option value="">選択してください</option>
                    @foreach($conditions as $condition)
                    <option class="conditions__option" value="{{ $condition->id}}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
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
        <hr class="centered-hr">
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
                <textarea name="detail">{{ old('detail') }}</textarea>
            </div>
            <div class="form__error">
                @error('detail')
                {{ $message }}
                @enderror
            </div>
        </div>
        <h3 class="form__title">販売価格</h3>
        <hr class="centered-hr">
        <div class="form__group">
            <div class="form__group-content">
                <p class="input__title">販売価格</p>
                <input type="number" name="price" placeholder="¥" value="{{ old('price') }}">
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
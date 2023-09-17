@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class= index__select>
    <a href="/recommend" class= "non-color__select">おすすめ</a>
    <a href="/mylist" class= "non-color__select">マイリスト</a>
</div>
<hr>
<form method="GET" action="/" id="form">
  <div class="form__wrap">
  <div class="form__content">
    <input type="hidden" name="form__type" value="sort__form">
    <input type="checkbox" name="hideSold" id="hideSold" {{ request()->has('hideSold') ? 'checked' : '' }}>
    <label for="hideSold">売却済みを非表示</label>
    <br>
  </div>
  <div class="form__content">
    <label for="sort">並び替え:</label>
    <select name="sort" id="sort">
        <option value="price_asc" {{ request()->input('sort') === 'price_asc' ? 'selected' : '' }}>価格の安い順</option>
        <option value="price_desc" {{ request()->input('sort') === 'price_desc' ? 'selected' : '' }}>価格の高い順</option>
        <option value="newest" {{ request()->input('sort') === 'newest' ? 'selected' : '' }}>新しい順</option>
        <option value="oldest" {{ request()->input('sort') === 'oldest' ? 'selected' : '' }}>古い順</option>
        <option value="most_famous" {{ request()->input('sort') === 'most_famous' ? 'selected' : '' }}>いいねが多い順</option>
    </select>
    <br>

    <button type="submit" style="display: none;"></button>
    </div>
    </div>
</form>

<div class="item__wrap">
  @foreach($items as $item)
  <div class="item__content">
    <div class="item__image">
      <a href="{{ asset('/item/' . $item['id']) }}">
        <img src="{{asset($item['image_url'])}}">
      </a>
      @if($item['sale'] === 'SoldOut')
      <div class="soldout-label">SoldOut</div>
      @endif
    </div>
    <div class="item__info">
      <p class="item__price">\ {{ $item['price'] }}</p>
    </div>
  </div>
  @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterForm = document.getElementById("form");

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const selectBox = document.getElementById("sort");

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                form.submit();
            });
        });

        selectBox.addEventListener("change", function() {
            form.submit();
        });
    });
</script>



@endsection
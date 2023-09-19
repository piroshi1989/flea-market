@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class= index__select>
  <a href="/recommend" class= "non-color__select">おすすめ</a>
  <a href="/mylist" class= "non-color__select">マイリスト</a>
</div>
<hr class="centered-hr">

<div class="item__wrap">
  @if($searchedItems->isEmpty())
    <p>検索結果は0件です</p>
  @else
  @foreach($searchedItems as $searchedItem)
  <div class="item__content">
    <div class="item__image">
      <a href="{{ asset('/item/' . $searchedItem['id']) }}">
        <img src="{{asset($searchedItem['image_url'])}}">
      </a>
      <div class="item-label {{ $searchedItem['sale'] === 'SoldOut' ? 'soldout-label' : '' }}">
        <span>{{ $searchedItem['sale'] }}</span>
      </div>
    </div>
    <div class="item__info">
      <p class="item__price">\ {{ $searchedItem['price'] }}</p>
    </div>
  </div>
  @endforeach
  @endif
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
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form__confirm.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <p>ご購入ありがとうございます</p>
</div>
@if( $saleInfo->payment_method_id  == 1 )
<p>お支払い番号は以下の通りです。コンビニの機器に従ってお支払いください</p>
<p>{{ $saleInfo->payment_code }}</p>
@elseif( $saleInfo->payment_method_id == 2 )
<p>お支払いは代引きです。商品到着時にお支払いください</p>
@else
<p>クレジット払いは以下のリンクからお支払いください</p>
<a href="{{ asset('/payment/' . $saleInfo->item_id) }}">こちらをクリック</a>
@endif
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase__container">
    <div class="item__content">
        <div class="item__unit">
            <div class="item__img">
                <img class="img" src="{{ Storage::url($item->item_img) }}" alt="ストレージ画像">
            </div>
            <div class="item-info">
                <h1>{{ $item->name }}</h1>
                <div class="price"> &yen; {{ $item->price }} （値段）</div>
            </div>
        </div>
        <div class="payment__unit">
            <div class="payment-method">支払い方法<a class="link" href="">変更する</a></div>
            <div class="address">配送先<a class="link" href="{{route('purchase_address', $item->id) }}">変更する</a></div>
        </div>
    </div>

    <div class="confirm__content">
        <table class="confirm__table">
            <tr class="confirm__row">
                <th class="confirm__label">商品代金</th>
                <td class="confirm__data"> &yen; {{ $item->price }}</td>
            </tr>
            <tr class="confirm__row">
                <th class="confirm__label">支払い金額</th>
                <td class="confirm__data"> &yen; {{ $item->price }}</td>
            </tr>
            <tr class="confirm__row">
                <th class="confirm__label">支払い方法</th>
                <td class="confirm__data">コンビニ払い</td>
            </tr>
        </table>
        <form action="">
            <button class="btn">購入する</button>
        </form>
    </div>
</div>
@endsection
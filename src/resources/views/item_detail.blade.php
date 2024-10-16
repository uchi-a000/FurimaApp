@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')
<div class="item-detail__container">
    <div class="item-detail__inner">
        <div class="item-img">
            <img src="{{ Storage::url($item->item_img) }}" alt="ストレージ画像">
        </div>

        <div class="item-info">
            <h2 class="item-ttl">{{ $item->name }}</h2>
            <div> &yen; {{ $item->price }} （値段）</div>
            <div class="favorites"></div>
            <div class="comments"></div>
            <form class="item-form">
                @csrf
                <div class="form__btn">
                    <button class="btn" type="submit">購入する</button>
                </div>
            </form>
            <h3>商品説明</h3>
            <div>{{ $item->description }}</div>
            <h3>商品の情報</h3>
            <div class="ttl">カテゴリー</div>
            @foreach($category_items as $category_item)
            <div>{{ $category_item->category->name }}</div>
            @endforeach
            <div class="ttl">商品の状態</div>
            <div>{{ $item->condition->condition }}</div>
        </div>
    </div>
</div>
@endsection
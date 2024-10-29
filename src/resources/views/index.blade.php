@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="item__list">
    <a href="" class="ttl">おすすめ</a>
    <a href="" class="ttl">マイリスト</a>
</div>
<div class="item__container">
    <div class="item__inner">
        @foreach($items as $item)
        <div class="item__block">
            <div class="item__img">
                <a class="shop-detail__form" href="{{ route('item_detail', $item->id) }}">
                    <img src="{{ Storage::url($item->item_img) }}" alt="アイテム画像">
                </a>
                <div>{{ \Illuminate\Support\str::limit($item->description, 30) }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
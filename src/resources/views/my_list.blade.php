@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_list.css') }}">
@endsection

@section('content')
<nav class="heading-nav">
    <ul class="heading-nav-list">
        <li class="heading-nav-item-1"><a href="/">おすすめ</a></li>
        <li class="heading-nav-item-2">マイリスト</li>
    </ul>
</nav>
<div class="favorites-item__container">
    <div class="favorites-item__inner">
        @if(isset($favorites) && $favorites->isNotEmpty())
        @foreach($favorites as $favorite)
        <div class="item__block">
            <div class="item__img">
                <a class="shop-detail__form" href="{{ route('item_detail', $favorite->item->id) }}">
                    @if(Storage::disk('public')->exists($favorite->item['item_img']))
                    <img src="{{ Storage::url($favorite->item->item_img) }}" alt="アイテム画像">
                    @else
                    <img src="{{ $favorite->item->item_img }}" alt="ダミー画像" />
                    @endif
                </a>
                <div>{{ \Illuminate\Support\str::limit($favorite->item->description, 30) }}</div>
            </div>
        </div>
        @endforeach
        @else
        <p class="favorites-shop__not">マイリストはありません</p>
        @endif
    </div>
</div>
@endsection
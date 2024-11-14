@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<nav class="heading-nav">
    <ul class="heading-nav-list">
        <li class="heading-nav-item-1">おすすめ</li>
        <li class="heading-nav-item-2"><a href="/my_list">マイリスト</a></li>
    </ul>
</nav>
<div class="item__container">
    <div class="item__inner">
        @foreach($items as $item)
        <div class="item__block">
            <div class="item__img">
                <a class="shop-detail__form" href="{{ route('item_detail', $item->id) }}">
                    @if(Storage::disk('public')->exists($item['item_img_1']))
                    <img src="{{ Storage::url($item->item_img_1) }}" alt="アイテム画像">
                    @else
                    <img src="{{ $item->item_img_1 }}" alt="ダミー画像" />
                    @endif
                </a>
                <div>{{ \Illuminate\Support\str::limit($item->description, 30) }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')
<div class="item-detail__container">
    <div class="item-detail__inner">
        <div class="item__img">
            <img src="{{ Storage::url($item->item_img) }}" alt="ストレージ画像">
        </div>

        <div class="item-info">
            <h1>{{ $item->name }}</h1>
            <div class="price"> &yen; {{ $item->price }} （値段）</div>
            <div class="favorites-comments__content">
                <div class="favorites">
                    @if(Auth::check() && Auth::user()->favorites->contains('id', $item->id))
                    <form class="favorites__form" action="{{ route('favorites', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="favorites-submit" type="submit" name="favorites_destroy">
                            <img class="heart-img" src="{{ asset('img/star.png')}}" alt="red_heart">
                        </button>
                    </form>
                    @else
                    <form class="favorites__form" action="{{ route('favorites', $item->id) }}" method="POST">
                        @csrf
                        <button class="favorites-submit" type="submit" name="favorites_store">
                            <img class="heart-img" src="{{ asset('img/gray_star.png')}}" alt="gray_heart">
                        </button>
                    </form>
                    @endif
                    <div class="favorites-count">
                        {{ $item->favorites()->count() }}
                    </div>
                </div>
                <div class="comments">
                    <form class="comments__form" action="{{ route('comment', $item->id) }}" method="POST">
                        @csrf
                        <button class="comments-submit" type="submit" name="comment">
                            <img class="speech_bubble-img" src="{{ asset('img/speech_bubble.png')}}" alt="speech bubble">
                        </button>
                    </form>
                    <div class="favorites-count">
                        {{ $item->comment()->count() }}
                    </div>
                </div>
            </div>

            <a class="purchase_link" href="{{ route('purchase', $item->id) }}">購入手続きへ</a>
            <h2>商品説明</h2>
            <div class="description">{{ $item->description }}</div>
            <h2>商品の情報</h2>
            <div class="category">
                <div class="ttl">カテゴリー</div>
                @foreach($category_items as $category_item)
                <div class="category__item">{{ $category_item->category->name }}</div>
                @endforeach
            </div>
            <div class="condition">
                <div class="ttl">商品の状態</div>
                <div class="condition__item">{{ $item->condition->condition }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page_sell.css') }}">
@endsection

@section('content')
<div class="mypage__container">
    <div class="heading">
        <div class="user-profile">
            @if($profile->img)
            <img id="img-preview" class="img-preview" src="{{ Storage::url('profile/' . $profile->img ) }}" alt="ストレージ画像">
            @else
            <img id="img-preview" class="img-preview" src=" {{ asset('img/user.svg') }}" alt="プレビュー画像">
            @endif
            <h2 class="user-name">{{ Auth::user()->nick_name }} </h2>
        </div>
        <div>
            <a class="profile-link" href="/mypage/profile">プロフィールを編集</a>
        </div>
    </div>

    <nav class="heading-nav">
        <ul class="heading-nav-list">
            <li class="heading-nav-item-1"><a href="/mypage/purchase">出品した商品</a></li>
            <li class="heading-nav-item-2">購入した商品</li>
        </ul>
    </nav>
    <div class="item__block">
        <div class="item__inner">
            @if(isset($sold_items) && $sold_items->isNotEmpty())
            @foreach($sold_items as $sold_item)
            <div class="item">
                <div class="item__img">
                    <a class="shop-detail__form" href="{{ route('item_detail', $sold_item->item->id) }}">
                        @if(Storage::disk('public')->exists($sold_item->item['item_img']))
                        <img src="{{ Storage::url($sold_item->item->item_img) }}" alt="アイテム画像">
                        @else
                        <img src="{{ $sold_item->item->item_img }}" alt="ダミー画像" />
                        @endif
                    </a>
                    <div>{{ \Illuminate\Support\str::limit($sold_item->item->description, 30) }}</div>
                </div>
            </div>
            @endforeach
            @else
            <p class="sell__not">購入した商品ははありません</p>
            @endif
        </div>
    </div>
</div>
@endsection
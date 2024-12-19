@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page_purchase.css') }}">
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
            <li class="heading-nav-item-1">出品した商品</li>
            <li class="heading-nav-item-2"><a href="/mypage/sell">購入した商品</a></li>
        </ul>
    </nav>
    <div class="item__block">
        <div class="item__inner">
            @if(isset($items) && $items->isNotEmpty())
            @foreach($items as $item)
            <div class="item">
                <div class="item__img">
                    <a class="shop-detail__form" href="{{ route('item_detail', $item->id) }}">
                        @if(Storage::disk('public')->exists($item['item_img']))
                        <img src="{{ Storage::url($item->item_img) }}" alt="アイテム画像">
                        @else
                        <img src="{{ $item->item_img }}" alt="ダミー画像" />
                        @endif
                    </a>
                    <div>{{ \Illuminate\Support\str::limit($item->description, 30) }}</div>
                </div>
            </div>
            @endforeach
            @else
            <p class="purchase__not">出品した商品はありません</p>
            @endif
        </div>
    </div>
</div>
@endsection
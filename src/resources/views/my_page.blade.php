@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<div class="mypage__container">
    <div class="heading">
        <div class="user-profile">
            @if($profile)
            <img class="user-img" src="{{ Storage::url($profile->img) }}" alt="アイテム画像">
            <h2 class="user-name">{{ $profile->name }}</h2>
            @else
            <div class="no-img"><span>No image</span></div>
            <h2 class="user-name">ユーザー名</h2>
            @endif

        </div>
        <div>
            <a class="profile-link" href="/mypage/profile">プロフィールを編集</a>
        </div>
    </div>

    <div class="item__list">
        <a href="" class="ttl">出品した商品</a>
        <a href="" class="ttl">購入した商品</a>
    </div>
    <div class="item__content">
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

</div>
@endsection
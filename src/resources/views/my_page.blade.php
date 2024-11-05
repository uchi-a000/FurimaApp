@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<div class="mypage__container">
    <div class="heading">
        <div class="user-profile">
            @if($profile)
            <img class="user-img" src="{{ Storage::url('profile/' . $profile['img']) }}" alt="ストレージ画像">
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

    <nav class="menu-nav">
        <ul class="menu-nav-list">
            <li class="menu-nav-list-item">
                <a href="" id="favorites">
                    <img class="icon-img" src="{{ asset('img/heart.svg')}}" alt="ハート">
                    <p class="item__ttl">いいね！一覧</p>
                </a>
            </li>
            <li class="menu-nav-list-item">
                <a href="" id="follow">
                    <img class="icon-img" src="{{ asset('img/bookmark.svg')}}" alt="">
                    <p class="item__ttl">フォローリスト</p>
                </a>
            </li>
            <li class="menu-nav-list-item">
                <a href="" id="purchases">
                    <img class="icon-img" src="{{ asset('img/cart.svg')}}" alt="">
                    <p class="item__ttl">購入した商品</p>
                </a>
            </li>
            <li class="menu-nav-list-item">
                <a href="" id="listings">
                    <img class="icon-img" src="{{ asset('img/box.svg')}}" alt="">
                    <p class="item__ttl">出品した商品</p>
                </a>
            </li>
        </ul>
    </nav>

</div>
@endsection
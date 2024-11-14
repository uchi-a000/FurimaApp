@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<div class="mypage__container">
    <div class="heading">
        <div class="user-profile">
            @if($profile)
            <img class="img-preview" src="{{ Storage::url('profile/' . $profile['img']) }}" alt="ストレージ画像">
            @else
            <img id="img-preview" class="img-preview" src=" {{ asset('img/user.svg') }}" alt="プレビュー画像">
            @endif
            <h2 class="user-name">{{ Auth::user()->name }} </h2>
        </div>
        <div>
            <a class="profile-link" href="/mypage/profile">プロフィールを編集</a>
        </div>
    </div>

    <nav class="menu-nav">
        <ul class="menu-nav-list">
            <li class="menu-nav-list-item">
                <a href="" id="favorites">
                    <img class="icon-img" src="{{ asset('img/gray_star.png')}}" alt="ハート">
                    <p class="item__ttl">いいね！一覧</p>
                </a>
            </li>
            <li class="menu-nav-list-item">
                <a href="" id="follow">
                    <img class="icon-img" src="{{ asset('img/follow.svg')}}" alt="">
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
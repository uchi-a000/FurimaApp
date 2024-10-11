@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell__content">
    <h2 class="sell-ttl">商品の出品</h2>
    <div class="sell__alert">
        @if(session('message'))
        <div class="sell__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <form class="form" action="/sell" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="item">
            <div class="ttl"><span>商品画像</span></div>
            <input class="file" type="file" name="item_img" id="item_img" />
        </div>
        <div class="item">
            <div class="ttl"><span>カテゴリー</span></div>
            <div class="inner">
                <select class="contact-form__select" name="category_item_ids[]" id="category_item_select" multiple>
                    <option disabled selected>選択してください</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array('category_id', old('category_item_ids', [])) ? 'selected' : '' }}>{{$category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="item">
            <div class="ttl"><span>商品の状態</span></div>
            <div class="inner">
                <select class="contact-form__select" name="condition_id" id="condition_select">
                    <option disabled selected>選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}" {{ old('condition_id')==$condition->id ? 'selected' : '' }}>{{$condition->condition }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="item">
            <div class="ttl"><span>商品名</span></div>
            <input class="input" type="text" name="name" value="{{ old('name') }}" />
        </div>
        <div class="item">
            <div class="ttl"><span>商品の説明</span></div>
            <textarea class="textarea" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="item">
            <div class="ttl"><span>販売価格</span></div>
            <input class="input" type="text" name="price" value="{{ old('price') }}" />
        </div>
        <button class="form__btn">登録</button>
    </form>
</div>
@endsection
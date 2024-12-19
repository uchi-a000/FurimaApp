@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_address.css') }}">
@endsection

@section('content')
<div class="alert">
    @if(session('message'))
    <div class="alert--success">
        {{ session('message') }}
    </div>
    @endif
</div>
<div class="purchase_address__container">
    <div class="heading">
        <a class="back__link" href="{{ route('purchase', ['item_id' => $item->id]) }}">&lt;</a>
        <h1 class="ttl">住所の変更</h1>
    </div>
    <div class="content">
        <form class="form" action="{{ route('address_update', $profile->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id" value="{{ $profile->id }}">
            <div class="form__group">
                <div class="form__label" for="postcode">郵便番号</div>
                <input class="form__input" type="text" name="postcode" id="postcode" value="{{ $profile->postcode }}">
                <div class="form__error">
                    @error('postcode')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label" for="address">住所</div>
                <input class="form__input" type="text" name="address" id="address" value="{{ $profile->address }}">
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label" for="building">建物名</div>
                <input class="form__input" type="text" name="building" id="building" value="{{ $profile->building }}">
            </div>
            <div class="form__button">
                <button class="btn">更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_address.css') }}">
@endsection

@section('content')
<div class="profile__container">
    <div class="profile__alert">
        @if(session('message'))
        <div class="profile__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <h1 class="profile__ttl">住所の変更</h1>
    <div class="content">
        <form class="form" action="{{ route('update', $profile->id) }}" method="POST">
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
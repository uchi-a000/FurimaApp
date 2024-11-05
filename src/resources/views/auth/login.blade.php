@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__container">
    <div class="inner">
        <h2 class="heading">ログイン</h2>
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="group__ttl"><span>メールアドレス</span></div>
                <input class="group__input" type="email" name="email" value="{{ old('email') }}" />
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="group__ttl"><span class=>パスワード</span></div>
                <input class="group__input" type="password" name="password" />
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form__button">
                <button class="login__btn" type="submit">ログインする</button>
            </div>
            <a class="register__link" href="/register">会員登録はこちら</a>
        </form>
    </div>
</div>
@endsection
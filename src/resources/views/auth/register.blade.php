@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__container">
    <div class="inner">
        <h2 class="heading">会員登録</h2>
        <form class="form" action="/register" method="post">
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
                <button class="btn" type="submit">登録する</button>
            </div>
            <a class="login__link" href="/login">ログインはこちら</a>
        </form>
    </div>
</div>
@endsection
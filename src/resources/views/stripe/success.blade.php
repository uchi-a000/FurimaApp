@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe/success.css') }}">
@endsection

@section('content')
<div class="success">
    <div class="success__inner">
        <h1>Payment Successful!</h1>
        <p class="message">お支払い完了しました</p>
        <a class="back_btn" href="/">戻る</a>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe/payment.css') }}">
@endsection

@section('content')
<div class="payment">
    @if (session('error'))
    <div class="error__alert">{{ session('error') }}</div>
    @endif
    <h2>クレジットカードでのお支払い</h2>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <div class="form__error">
            @error('amount')
            {{ $message }}
            @enderror
        </div>
        <div class="amount">金額: &yen; {{ number_format($item->price) }} </div>
        <div class="item_name">商品名: {{ $item->item_name }} </div>
        <div>
            <button class="submit" type="submit">Stripe決済</button>
            <a class="back_btn" href="{{ route('purchase', ['item_id' => $item->id]) }}">戻る</a>
        </div>
    </form>
</div>
@endsection
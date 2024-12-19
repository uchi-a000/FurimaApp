@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_payment_method.css') }}">
@endsection

@section('content')
<div class="alert">
    @if(session('message'))
    <div class="alert--success">
        {{ session('message') }}
    </div>
    @endif
</div>
<div class="payment_method__container">
    <div class="inner">
        <div class="heading">
            <a class="back__link" href="{{ route('purchase', ['item_id' => $item->id]) }}">&lt;</a>
            <h1 class="ttl">お支払い方法変更</h1>
        </div>
        <form class="form" action="{{ route('payment_method_update', $profile->id) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $profile->id }}">
            <div class="form__group">
                <select class="payment__select" name="payment_id">
                    <option value="{{ $profile->payment->id }}">{{ $profile->payment->payment }}</option>
                    @foreach($payments as $payment)
                    @if($payment->id !== $profile->payment->id)
                    <option value="{{ $payment->id }}"
                        @if((request('payment_id')==$payment->id || old('payment_id') == $payment->id)) selected @endif>
                        {{ $payment->payment }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form__button">
                <button class="form__btn">更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection
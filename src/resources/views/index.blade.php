@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="shop__container">
    <div class="shop__inner">
        @foreach($items as $item)
        <div class="shop__block">
            <div class="shop__img">
                <img src="{{ asset('storage/' . $item->item_img) }}" alt="アイテム画像">
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
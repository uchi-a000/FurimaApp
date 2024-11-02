@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
<div class="item-detail__container">
    <div class="item-detail__inner">
        <div class="item__img">
            @if(Storage::disk('public')->exists($item['item_img']))
            <img src="{{ Storage::url($item->item_img) }}" alt="アイテム画像">
            @else
            <img src="{{ $item->item_img }}" alt="ダミー画像" />
            @endif
        </div>
        <div class="item-info">
            <h1>{{ $item->name }}</h1>
            <div class="price"> &yen; {{ $item->price }} （値段）</div>
            <div class="favorites-comments__content">
                <div class="favorites">
                    @if(Auth::check() && Auth::user()->favorites->contains('id', $item->id))
                    <form class="favorites__form" action="{{ route('favorites', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="favorites-submit" type="submit" name="favorites_destroy">
                            <img class="heart-img" src="{{ asset('img/star.png')}}" alt="red_heart">
                        </button>
                    </form>
                    @else
                    <form class="favorites__form" action="{{ route('favorites', $item->id) }}" method="POST">
                        @csrf
                        <button class="favorites-submit" type="submit" name="favorites_store">
                            <img class="heart-img" src="{{ asset('img/gray_star.png')}}" alt="gray_heart">
                        </button>
                    </form>
                    @endif
                    <div class="favorites-count">
                        {{ $item->favorites()->count() }}
                    </div>
                </div>
                <div class="comments">
                    <form class="comments__form" action="{{ route('comment', $item->id) }}" method="POST">
                        @csrf
                        <button class="comments-submit" type="submit" name="comment">
                            <img class="speech_bubble-img" src="{{ asset('img/speech_bubble.png')}}" alt="speech bubble">
                        </button>
                    </form>
                    <div class="favorites-count">
                        {{ $item->comment()->count() }}
                    </div>
                </div>
            </div>
            <p>コメント( {{ $item->comment()->count() }} )</p>
            @foreach($comments as $comment)
            <div>{{ $comment->comment }}</div>
            @endforeach
            <form class="comment-form" action="/comment" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <div class="comment-form-item">
                    <p class="comment-form-item__label">商品へのコメント</p>
                    <textarea class="comment-form-item__textarea" name="comment" id="comment">{{ old('comment') }}</textarea>
                    <div class="form__btn">
                        <button class="btn" type="submit">コメントを送信する</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
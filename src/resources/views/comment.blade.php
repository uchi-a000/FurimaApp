@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
<div class="comment__container">
    <div class="comment__inner">
        <div class="item-img__content">
            @if(Storage::disk('public')->exists($item['item_img']))
            <img src="{{ Storage::url($item->item_img) }}" alt="アイテム画像">
            @else
            <img src="{{ $item->item_img }}" alt="ダミー画像" />
            @endif
        </div>
        <div class="item-comment__content">
            <h1>{{ $item->item_name }}</h1>
            <div class="price"> &yen; {{ $item->price }}</div>
            <div class="favorites-comments__item">
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
                    <div class="comments-count">
                        {{ $item->comment()->count() }}
                    </div>
                </div>
            </div>
            @foreach($comments as $comment)
            <div class="user__item {{ $comment->user->id === auth()->id() ? 'self-comment' : '' }}">
                <!-- ログインユーザーとコメントしようとしているユーザーが同じなら true→'self-comment' css適用-->
                @if($comment->user->profile)
                <img class="img-preview" src="{{ Storage::url('profile/' . $comment->user->profile->img) }}" alt="ストレージ画像">
                <div class="user-name">{{ $comment->user->nick_name }} </div>
                @else
                <img id="img-preview" class="img-preview" src=" {{ asset('img/user.svg') }}" alt="プレビュー画像">
                <div class="user-name">{{ $comment->user->nick_name }} </div>
                @endif
                @if(Auth::check() && Auth::user()->hasRole('admin'))
                <div class="user-destroy">
                    <form action="{{ route('admin.comments_destroy', $comment->id) }}" method="POST" onclick="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete_btn">削除する</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="comment-box">{{ $comment->comment }}</div>
            @endforeach
            <form class="comment-form" action="/comment" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <div class="comment-form-item">
                    <p class="comment-form-item__label">商品へのコメント</p>
                    <div class="form__error">
                        @error('comment')
                        {{ $message }}
                        @enderror
                    </div>
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
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
    <h2 class="profile__ttl">プロフィール設定</h2>
    @if(!$profile)
    <div class="content">
        <form class="form" action="/mypage/profile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form__group">
                <img id="img-preview" class="img-preview" src=" {{ asset('img/user.svg') }}" alt="プレビュー画像">
                <label for="file-upload" class="custom-file-upload">画像を選択する</label>
                <input id="file-upload" class="file" type="file" name="img" style="display: none;" onchange="previewAndUploadImage(event)" />
            </div>
            <div class="form__group">
                <div class="form__label" for="name">ニックネーム</div>
                <input class="form__input" type="text" name="name" value="{{ Auth::user()->name }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label" for="name">名前</div>
                <input class="form__input" type="text" name="name" value="{{ old('name') }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label" for="postcode">郵便番号</div>
                <input class="form__input" type="text" name="postcode" id="postcode" value="{{ old('postcode') }}">
                <div class="form__error">
                    @error('postcode')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label" for="address">住所</div>
                <input class="form__input" type="text" name="address" id="address" value="{{ old('address') }}">
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label" for="building">建物名</div>
                <input class="form__input" type="text" name="building" id="building" value="{{ old('building') }}">
            </div>
            <div class="form__button">
                <button class="btn">登録する</button>
            </div>
        </form>
    </div>
    @else
    <div class="content">
        <form class="form" action="{{ route('profile_update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id" value="{{ $profile->id }}">
            <div class="form__group">
                <img id="img-preview" class="img-preview" src="{{ Storage::url('profile/' . $profile['img']) }}" alt="ストレージ画像">
                <label for="file-upload" class="custom-file-upload">画像を選択する</label>
                <input id="file-upload" class="file" type="file" name="img" style="display: none;" onchange="previewAndUploadImage(event)" />
            </div>
            <div class="form__group">
                <div class="form__label" for="name">ニックネーム</div>
                <input class="form__input" type="text" name="name" value="{{ Auth::user()->name }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <label class="form__label" for="name">名前</label>
                <input class="form__input" type="text" name="name" value="{{ $profile->name }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
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
    @endif
</div>
@endsection

<script>
    function previewAndUploadImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('img-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);

            const formData = new FormData();
            formData.append('img', file);
        }
    }
</script>
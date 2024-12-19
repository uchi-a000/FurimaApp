@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="alert">
    @if(session('message'))
    <div class="alert--success">
        {{ session('message') }}
    </div>
    @endif
</div>
<div class="profile__container">
    <h2 class="profile__ttl">プロフィール設定</h2>
    @if(!$profile)
    <div class="content">
        <form class="form" action="/mypage/profile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form__group">
                <img id="img-preview" class="img-preview" src=" {{ asset('img/user.svg') }}" alt="プレビュー画像">
                <label for="file-upload" class="custom-file-upload">画像を選択する</label>
                <input id="file-upload" class="file" type="file" name="img" style="display: none;" onchange="previewAndUploadImage(event)" />
                <div class="form__error">
                    @error('img')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">ニックネーム</div>
                <input class="form__input" type="text" name="nick_name" value="{{ Auth::user()->nick_name }}" />
                <div class="form__error">
                    @error('nick_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">名前</div>
                <input class="form__input" type="text" name="real_name" value="{{ old('real_name') }}" />
                <div class="form__error">
                    @error('real_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">郵便番号（ハイフンなし）</div>
                <input class="form__input" type="text" name="postcode" id="postcode" value="{{ old('postcode') }}">
                <div class="form__error">
                    @error('postcode')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">住所</div>
                <input class="form__input" type="text" name="address" id="address" value="{{ old('address') }}">
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">建物名</div>
                <input class="form__input" type="text" name="building" id="building" value="{{ old('building') }}">
            </div>
            <div class="form__group">
                <div class="form__label">お支払い方法</div>
                <select class="payment__select" name="payment_id" id="payment_select">
                    <option disabled selected>選択してください</option>
                    @foreach($payments as $payment)
                    <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>{{$payment->payment }}
                    </option>
                    @endforeach
                </select>
                <div class="form__error">
                    @error('payment_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__button">
                <button class="btn">登録する</button>
            </div>
        </form>
    </div>

    <!-- profile変更  -->
    @else
    <div class="content">
        <form class="form" action="{{ route('profile_update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id" value="{{ $profile->id }}">
            <div class="form__group">
                @if($profile->img)
                <img id="img-preview" class="img-preview" src="{{ Storage::url('profile/' . $profile->img ) }}" alt="ストレージ画像">
                @else
                <img id="img-preview" class="img-preview" src=" {{ asset('img/user.svg') }}" alt="プレビュー画像">
                @endif
                <label for="file-upload" class="custom-file-upload">画像を選択する</label>
                <input id="file-upload" class="file" type="file" name="img" style="display: none;" onchange="previewAndUploadImage(event)" />
                <div class="form__error">
                    @error('img')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">ニックネーム</div>
                <input class="form__input" type="text" name="nick_name" value="{{ Auth::user()->nick_name }}" />
                <div class="form__error">
                    @error('nick_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <label class="form__label">名前</label>
                <input class="form__input" type="text" name="real_name" value="{{ $profile->real_name }}" />
                <div class="form__error">
                    @error('real_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">郵便番号（ハイフンなし）</div>
                <input class="form__input" type="text" name="postcode" id="postcode" value="{{ $profile->postcode }}">
                <div class="form__error">
                    @error('postcode')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">住所</div>
                <input class="form__input" type="text" name="address" id="address" value="{{ $profile->address }}">
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__label">建物名</div>
                <input class="form__input" type="text" name="building" id="building" value="{{ $profile->building }}">
            </div>
            <div class="form__group">
                <div class="form__label">お支払い方法</div>
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
                <div class="form__error">
                    @error('payment')
                    {{ $message }}
                    @enderror
                </div>
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
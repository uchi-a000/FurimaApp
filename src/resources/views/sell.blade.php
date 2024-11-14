@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">

@endsection

@section('content')
<div class="sell__container">
    <div class="sell__inner">
        <div class="sell__alert">
            @if(session('message'))
            <div class="sell__alert--success">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <h2 class="heading__ttl">商品の出品</h2>
        <form class="sell__form" action="/sell" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="sell__content__img">
                <div class="item__ttl">商品画像</div>
                <div class="img-preview__item ">
                    <img id="img-preview" class="img-preview" src="" alt="プレビュー画像" style="display: none;">
                </div>

                <div class="file-upload__btn">
                    <label for="file-upload" class="custom-file-upload">画像を選択する</label>
                    <input id="file-upload" class="file" type="file" name="item_img_1" style="display: none;" onchange="previewAndUploadImage(event)" />
                </div>
            </div>

            <div class="sell__content">
                <h3 class="content__ttl">商品の詳細</h3>
                <div class="content__item">
                    <div class="item__ttl">カテゴリー</div>
                    <select class="category__select" name="category_item_ids[]" id="category_item_select" multiple>
                        <option disabled selected>以下より選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array('category_id', old('category_item_ids', [])) ? 'selected' : '' }}>{{$category->name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="item__ttl">商品の状態</div>
                    <select class="condition__select" name="condition_id" id="condition_select">
                        <option disabled selected>選択してください</option>
                        @foreach($conditions as $condition)
                        <option value="{{ $condition->id }}" {{ old('condition_id')==$condition->id ? 'selected' : '' }}>{{$condition->condition }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="sell__content">
                <h3 class="content__ttl">商品名と説明</h3>
                <div class="content__item">
                    <div class="item__ttl">商品名</div>
                    <input class="item-name__input" type="text" name="item_name" value="{{ old('item_name') }}" />

                    <div class="item__ttl">商品説明</div>
                    <textarea class="item__textarea" name="description">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="sell__content">
                <h3 class="content__ttl">販売価格</h3>
                <div class="content__item-price">
                    <div class="item__ttl">販売価格</div>
                    <span class="price__icon">&yen;</span>
                    <input class="price__input" type="text" name="price" value=" {{ old('price') }}" />
                </div>
            </div>
            <div class="sell-form__btn">
                <button class="sell__btn">出品する</button>
            </div>
        </form>
    </div>
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
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);

            const formData = new FormData();
            formData.append('item_img_1', file);
        }
    }
</script>
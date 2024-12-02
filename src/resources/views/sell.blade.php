@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">

@endsection

@section('content')
<div class="alert">
    @if(session('message'))
    <div class="alert--success">
        {{ session('message') }}
    </div>
    @endif
</div>
<div class="sell__container">
    <div class="sell__inner">
        <h2 class="heading__ttl">商品の出品</h2>
        <form class="sell__form" action="/sell" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="sell__content__img">
                <h2 class="item__ttl">商品画像</h2>
                <label for="file-upload" class="upload-area" id="upload-area">
                    <div class="custom-file-upload">画像を選択する</div>
                    <input id="file-upload" class="file" type="file" name="item_img" style="display: none;" onchange="previewAndUploadImage(event)" />
                </label>
            </div>
            <div id="img-preview" class="img-preview"></div>
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
        const file = event.target.files[0]; // 1枚目のみ取得
        const previewContainer = document.getElementById('img-preview');

        // 既存のプレビューをクリア
        previewContainer.innerHTML = "";

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // プレビュー画像を生成
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.style.width = '100px';
                imgElement.style.height = '100px';
                imgElement.style.objectFit = 'cover';
                imgElement.style.margin = '20px 0';

                // 削除ボタンを生成
                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = '×';
                deleteBtn.style.position = 'absolute';
                deleteBtn.style.top = '5px';
                deleteBtn.style.right = '5px';
                deleteBtn.style.backgroundColor = 'red';
                deleteBtn.style.color = 'white';
                deleteBtn.style.border = 'none';
                deleteBtn.style.cursor = 'pointer';
                deleteBtn.style.borderRadius = '50%';
                deleteBtn.style.width = '20px';
                deleteBtn.style.height = '20px';
                deleteBtn.style.fontSize = '12px';
                deleteBtn.style.margin = '20px 0';

                // 削除ボタンのクリックイベント
                deleteBtn.addEventListener('click', function() {
                    previewContainer.innerHTML = ""; // プレビューをクリア
                    document.getElementById('file-upload').value = ""; // ファイル入力をリセット
                });

                // プレビューエリアに画像と削除ボタンを追加
                previewContainer.style.marginTop = "10px";
                previewContainer.appendChild(imgElement);
                previewContainer.appendChild(deleteBtn);
            };
            reader.readAsDataURL(file); // 画像をデータURLとして読み込む
        }
    }
</script>
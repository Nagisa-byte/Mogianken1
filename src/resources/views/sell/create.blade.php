@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sell/create.css') }}">
@endsection

@section('content')

<div class="sell-container">

    <form action="/sell" method="POST" enctype="multipart/form-data" class="sell-form">
        @csrf

        <h1 class="page-title">商品の出品</h1>

        {{-- 商品画像 --}}
        <h2 class="section-title">商品画像</h2>

        <div class="image-box-wrapper">
            <label for="item-image" class="image-box">
                <span class="image-btn">画像を選択する</span>
                <input type="file" id="item-image" name="image" accept="image/*" hidden>
            </label>
            {{-- 選択した画像をプレビュー表示 --}}
            <img id="preview" class="preview-img" style="display:none;">
        </div>
        @error('image')
        <div class="error">{{ $message }}</div>
        @enderror

        {{-- 商品詳細 --}}
        <h2 class="section-title">商品の詳細</h2>
        <hr>

        {{-- カテゴリー --}}
        <p class="input-title">カテゴリー</p>
        <div class="category-area">
            @foreach ($categories as $category)
            <label class="category-pill">
                <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                <span>{{ $category->name }}</span>
            </label>
            @endforeach
        </div>
        @error('categories')
        <div class="error">{{ $message }}</div>
        @enderror


        {{-- 商品の状態 --}}
        <p class="input-title">商品の状態</p>
        <div class="select-wrapper">
            <select name="condition" class="select-box">
                <option value="" selected disabled>選択してください</option>
                <option value="良好">良好</option>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                <option value="状態が悪い">状態が悪い</option>
            </select>
        </div>
        @error('condition')
        <div class="error">{{ $message }}</div>
        @enderror


        {{-- 商品名と説明 --}}
        <h2 class="section-title">商品名と説明</h2>
        <hr>

        <p class="input-title">商品名</p>
        <input type="text" name="title" class="text-input">
        @error('title')
        <div class="error">{{ $message }}</div>
        @enderror


        <p class="input-title">ブランド名</p>
        <input type="text" name="brand" class="text-input">

        <p class="input-title">商品の説明</p>
        <textarea name="description" class="textarea-input"></textarea>
        @error('description')
        <div class="error">{{ $message }}</div>
        @enderror


        <p class="price-wrapper">販売価格</p>
        <span class="yen">¥</span>
        <input type="text" name="price" class="price-input" min="1">
        @error('price')
        <div class="error">{{ $message }}</div>
        @enderror


        <button type="submit" class="submit-btn">出品する</button>
    </form>

</div>

@endsection
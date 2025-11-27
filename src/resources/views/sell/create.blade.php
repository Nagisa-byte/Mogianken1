@extends('layouts.app')

@section('content')
<h1>商品を出品する</h1>

<form action="/sell" method="POST" enctype="multipart/form-data">
    @csrf

    <label>商品名</label>
    <input type="text" name="title">
    @error('title') <div>{{ $message }}</div> @enderror

    <label>商品説明</label>
    <textarea name="description"></textarea>
    @error('description') <div>{{ $message }}</div> @enderror

    <label>商品画像</label>
    <input type="file" name="image">
    @error('image') <div>{{ $message }}</div> @enderror

    <label>カテゴリー</label>
    <select name="category_id">
        @foreach ($categories ?? [] as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id') <div>{{ $message }}</div> @enderror

    <label>状態</label>
    <select name="condition">
        <option value="新品">新品</option>
        <option value="中古">中古</option>
    </select>

    <label>価格</label>
    <input type="number" name="price">
    @error('price') <div>{{ $message }}</div> @enderror

    <button type="submit">出品する</button>
</form>

@endsection
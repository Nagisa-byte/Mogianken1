@extends('layouts.app')

@section('content')
<h1>購入確認</h1>

<p>商品：{{ $item->title }}</p>
<p>価格：¥{{ number_format($item->price) }}</p>

<form action="/purchase/{{ $item->id }}" method="POST">
    @csrf

    <label>支払い方法</label>
    <select name="payment_method">
        <option value="card">クレジットカード</option>
        <option value="bank">銀行振込</option>
    </select>
    @error('payment_method') <div>{{ $message }}</div> @enderror

    <button type="submit">購入する</button>
</form>

<a href="/purchase/address/{{ $item->id }}">住所を変更する</a>

@endsection
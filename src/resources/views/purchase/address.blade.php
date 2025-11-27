@extends('layouts.app')

@section('content')
<h1>住所変更</h1>

<form action="/purchase/address/{{ $item->id }}" method="POST">
    @csrf

    <label>郵便番号</label>
    <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}">
    @error('postal_code') <div>{{ $message }}</div> @enderror

    <label>住所</label>
    <input type="text" name="address" value="{{ old('address', $address->address ?? '') }}">
    @error('address') <div>{{ $message }}</div> @enderror

    <label>建物名</label>
    <input type="text" name="building" value="{{ old('building', $address->building ?? '') }}">

    <button type="submit">更新する</button>
</form>

@endsection
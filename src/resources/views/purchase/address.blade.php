@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/purchase/address.css') }}">
@endsection

@section('content')

<div class="purchase-address-container">

    <h2>住所の変更</h2>

    <form action="{{ url('/purchase/address/' . $item->id) }}" method="POST">
        @csrf

        <label>郵便番号</label>
        <input type="text" name="postal_code"
            value="{{ old('postal_code', $user->profile->postal_code ?? '') }}">
        @error('postal_code')<div class="error">{{ $message }}</div>@enderror

        <label>住所</label>
        <input type="text" name="address"
            value="{{ old('address', $user->profile->address ?? '') }}">
        @error('address')<div class="error">{{ $message }}</div>@enderror

        <label>建物名</label>
        <input type="text" name="building"
            value="{{ old('building', $user->profile->building ?? '') }}">

        <button type="submit">更新する</button>
    </form>

</div>

@endsection
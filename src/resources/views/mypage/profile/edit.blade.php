@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/mypage/edit.css') }}">
@endsection

@section('content')
<h1>プロフィール編集</h1>

<form action="/mypage/profile/edit" method="POST" enctype="multipart/form-data" class="profile-edit-form">
    @csrf

    <label>プロフィール画像</label>
    <div class="profile-image-row">
        <img src="{{ $profile->profile_image ?? '/noimage.png' }}" class="profile-preview">
        <input type="file" name="profile_image" id="profile_image" class="hidden-file">
        {{-- カスタムボタン --}}
        <label for="profile_image" class="custom-file-btn">
            画像を選択する
        </label>
    </div>
    @error('profile_image') <div>{{ $message }}</div> @enderror

    <label>ユーザー名</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}">
    @error('name') <div>{{ $message }}</div> @enderror

    <label>郵便番号</label>
    <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code ?? '') }}">
    @error('postal_code') <div>{{ $message }}</div> @enderror

    <label>住所</label>
    <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}">
    @error('address') <div>{{ $message }}</div> @enderror

    <label>建物</label>
    <input type="text" name="building" value="{{ old('building', $profile->building ?? '') }}">

    <button type="submit">更新する</button>
</form>

@endsection
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h1>会員登録</h1>

    <form class="register-form" action="/register" method="POST">
        @csrf

        <label>ユーザー名</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div>{{ $message }}</div> @enderror

        <label>メールアドレス</label>
        <input type="text" name="email" value="{{ old('email') }}">
        @error('email') <div>{{ $message }}</div> @enderror

        <label>パスワード</label>
        <input type="password" name="password">
        @error('password') <div>{{ $message }}</div> @enderror

        <label>確認用パスワード</label>
        <input type="password" name="password_confirmation">

        <button type="submit">登録する</button>

        <a href=/login class="login-link">ログインはこちら</a>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')

<div class="login-container">
    <h1 class="login-title">ログイン</h1>

    <form class="login-form" action="/login" method="POST">
        @csrf

        <div class="form-group">
            <label>メールアドレス</label>
            <input type="text" name="email" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password">
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="login-btn">ログインする</button>

        <a href="/register" class="register-link">会員登録はこちら</a>
    </form>
</div>

@endsection
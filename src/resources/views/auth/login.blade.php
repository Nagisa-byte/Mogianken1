@extends('layouts.app')

@section('content')
<h1>ログイン</h1>

<form action="/login" method="POST">
    @csrf

    <label>メールアドレス</label>
    <input type="email" name="email" value="{{ old('email') }}">
    @error('email') <div>{{ $message }}</div> @enderror

    <label>パスワード</label>
    <input type="password" name="password">
    @error('password') <div>{{ $message }}</div> @enderror

    <button type="submit">ログイン</button>
</form>

@endsection
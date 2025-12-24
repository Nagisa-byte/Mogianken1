@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth/verify.css') }}">
@endsection

@section('content')
<div class="verify-container">

    <p>登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。</p>

    <form method="POST" action="/email/verification-notification">
        @csrf
        <button type="submit" class="verify-btn">認証はこちらから</button>
    </form>

    <form method="POST" action="/email/verification-notification">
        @csrf
        <button type="submit" class="resend-link">認証メールを再送する</button>
    </form>

</div>
@endsection
@extends('layouts.app')

@section('content')
<h1>プロフィール</h1>

<p>名前：{{ $user->name }}</p>
<p>郵便番号：{{ $profile->postal_code }}</p>
<p>住所：{{ $profile->address }}</p>

<a href="/mypage/profile/edit">編集する</a>

@endsection
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-container">

    {{-- プロフィール表示 --}}
    <div class="profile-area">
        <img src="{{ $user->profile->profile_image ?? '/noimage.png' }}" class="profile-img">
        <h2 class="username">{{ $user->name }}</h2>
        <a href="/mypage/profile/edit" class="profile-edit-btn">プロフィールを編集</a>
    </div>

    {{-- タブ --}}
    <div class="mypage-tabs">
        <a href="/mypage?page=sell" class="{{ request('page') !== 'buy' ? 'active-tab' : '' }}">
            出品した商品
        </a>
        <a href="/mypage?page=buy" class="{{ request('page') === 'buy' ? 'active-tab' : '' }}">
            購入した商品
        </a>
    </div>

    <div class="tab-border"></div>

    {{-- 商品一覧（必ず6つ表示） --}}
    <div class="item-list">

        @php
        $displayItems = $items->take(6); // 実データ最大6つ
        $missing = 6 - $displayItems->count();
        @endphp

        {{-- 実データを表示 --}}
        @foreach ($displayItems as $item)
        <div class="item-card">
            <a href="{{ $item->id ? '/item/'.$item->id : '#' }}">
                <img src="{{ $item->image_path ?? '/noimage.png' }}" alt="商品画像">
                <p class="item-title">{{ $item->title ?? '商品名' }}</p>
                <p class="item-price">
                    {{ $item->price ? '¥'.number_format($item->price) : '' }}
                </p>
            </a>
        </div>
        @endforeach

        {{-- 足りない分だけダミー枠を表示 --}}
        @for ($i = 0; $i < $missing; $i++)
            <div class="item-card dummy-card">
            <div class="dummy-img">商品画像</div>
            <p class="dummy-title">商品名</p>
    </div>
    @endfor

</div>

</div>
@endsection
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/item/show.css') }}">
@endsection

@section('content')

<div class="item-detail-container">

    {{-- 左側：商品画像 --}}
    <div class="item-image-area">
        <img src="{{ $item->image_path }}" alt="商品画像" class="item-main-image">
    </div>

    {{-- 右側：商品情報 --}}
    <div class="item-info-area">

        {{-- 商品名 --}}
        <h1 class="item-title">{{ $item->title }}</h1>

        {{-- ブランド名 --}}
        @if ($item->brand)
        <p class="item-brand">{{ $item->brand }}</p>
        @endif

        {{-- 販売価格 --}}
        <p class="item-price">
            ¥{{ number_format($item->price) }}
            <span class="tax">（税込）</span>
        </p>

        {{-- お気に入り & コメントボタン --}}
        <div class="action-buttons">
            <div class="action-item">
                <button class="icon-btn" id="like-btn" data-item-id="{{ $item->id }}">♡</button>
                <p class="count" id="like-count">{{ $item->favorites()->count() }}</p>
            </div>
            <div class="action-item">
                <button class="icon-btn">💬</button>
                <p class="count">{{ $item->comments()->count() }}</p>
            </div>
        </div>
        {{-- 購入ボタン--}}
        <a href="{{ url('/purchase/' . $item->id) }}" class="purchase-btn">
            購入手続きへ
        </a>


        {{-- 商品説明 --}}
        <h2 class="section-title">商品説明</h2>
        <div class="description-box">
            <p class="item-description">{{ $item->description }}</p>
        </div>

        {{-- 商品の情報 --}}
        <h2 class="section-title">商品の情報</h2>
        <div class="info-box">
            <p><strong>カテゴリー：</strong>
                @foreach ($item->categories as $category)
                {{ $category->name }}@unless($loop->last)、@endunless
                @endforeach
            </p>
            <p><strong>商品の状態：</strong> {{ $item->condition }}</p>
        </div>

        {{-- コメント一覧 --}}
        <h2 class="section-title">コメント（{{ $item->comments->count() }}）</h2>

        <div class="comment-list">
            @forelse ($item->comments as $comment)
            <div class="comment-item">

                {{-- プロフィール画像 --}}
                <img
                    src="{{ $comment->user->profile->profile_image ?? '/noimage.png' }}"
                    class="comment-icon">

                <div>
                    {{-- ユーザー名 --}}
                    <p class="comment-user">{{ $comment->user->name }}</p>

                    {{-- コメント内容 --}}
                    <p class="comment-text">{{ $comment->content }}</p>
                </div>

            </div>
            @empty
            <p class="no-comment">コメントはまだありません。</p>
            @endforelse
        </div>

        {{-- コメント投稿フォーム --}}
        <h2 class="section-title">商品へのコメント</h2>

        <form action="/item/{{ $item->id }}/comment" method="POST" class="comment-form">
            @csrf
            <textarea name="comment" class="comment-textarea" placeholder="コメントを入力してください"></textarea>
            <button type="submit" class="comment-submit-btn">コメントを送信する</button>
            @if ($errors->any())
            <div class="error-messages">
                @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </form>

    </div>
</div>

<script>
    document.getElementById('like-btn').addEventListener('click', function() {
        const itemId = this.dataset.itemId;

        fetch(`/item/${itemId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('like-count').innerText = data.likes_count;
            });
    });
</script>

@endsection
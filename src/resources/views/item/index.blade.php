@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/item/index.css') }}">
@endsection

@section('content')
<h1></h1>

{{-- タブメニュー --}}
<div class="tab-menu">

    <a href="/" class="{{ request('tab') !== 'mylist' ? 'tab-active' : '' }}">
        おすすめ
    </a>

    <a href="/?tab=mylist" class="{{ request('tab') === 'mylist' ? 'tab-active' : '' }}">
        マイリスト
    </a>
</div>

{{-- 下の水平線 --}}
<div class="tab-border"></div>

{{-- 商品一覧 --}}
<div class="item-list">

    @forelse ($items ?? [] as $item)
    <div class="item-card">
        <a href="/item/{{ $item->id }}">
            <img src="{{ $item->image_path ?? '/noimage.png' }}" alt="商品画像">
            <p>{{ $item->title }}</p>
            <p>¥{{ number_format($item->price) }}</p>
        </a>
    </div>
    @empty
    <p>商品がありません。</p>
    @endforelse

</div>


@endsection
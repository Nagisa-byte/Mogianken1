@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/item/index.css') }}">
@endsection

@section('content')

{{-- タブメニュー --}}
<div class="tab-menu">

    {{-- おすすめタブ（tab=mylist 以外はおすすめ） --}}
    <a href="/"
        class="{{ request('tab') !== 'mylist' ? 'tab-active' : '' }}">
        おすすめ
    </a>

    {{-- マイリストタブ --}}
    <a href="/?tab=mylist"
        class="{{ request('tab') === 'mylist' ? 'tab-active' : '' }}">
        マイリスト
    </a>
</div>

<div class="tab-border"></div>


{{-- 商品一覧 --}}
<div class="item-list">

    @forelse ($items as $item)
    <div class="item-card">
        <a href="/item/{{ $item->id }}">
            <img src="{{ $item->image_path ?? '/noimage.png' }}" alt="商品画像">
            <p class="item-title">{{ $item->title }}</p>
            <p class="item-price">¥{{ number_format($item->price) }}</p>
        </a>
    </div>

    @empty
    {{-- 商品が無いときは 6 枠ダミー表示 --}}
    @for ($i = 0; $i < 6; $i++)
        <div class="item-card dummy-card">
        <div class="dummy-img">商品画像</div>
        <p class="dummy-title">商品名</p>
</div>
@endfor
@endforelse

</div>

@endsection
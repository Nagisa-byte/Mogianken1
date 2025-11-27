@extends('layouts.app')

@section('content')
<h1>{{ $item->title ?? '商品名' }}</h1>

<img src="{{ $item->image_path ?? '/noimage.png' }}" width="300">

<p>価格：¥{{ number_format($item->price ?? 0) }}</p>
<p>説明：{{ $item->description ?? '' }}</p>

{{-- お気に入り --}}
@auth
@if(!($item->isFavorited ?? false))
<form action="/item/{{ $item->id }}/favorite" method="POST">
    @csrf
    <button type="submit">お気に入りに追加</button>
</form>
@else
<form action="/item/{{ $item->id }}/favorite" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">お気に入り解除</button>
</form>
@endif
@endauth

{{-- コメント --}}
<h3>コメント</h3>

@foreach ($comments ?? [] as $comment)
<p>{{ $comment->user->name ?? '名無しさん' }}： {{ $comment->comment }}</p>
@endforeach

@auth
<form action="/item/{{ $item->id }}/comment" method="POST">
    @csrf
    <textarea name="comment" rows="3"></textarea>
    @error('comment') <div>{{ $message }}</div> @enderror
    <button type="submit">コメントする</button>
</form>
@endauth

@endsection
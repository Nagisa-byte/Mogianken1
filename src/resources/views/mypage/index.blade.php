@extends('layouts.app')

@section('content')
<h1>マイページ</h1>

<p>{{ auth()->user()->name }} さん、こんにちは！</p>

<h2>出品した商品</h2>

@foreach ($items ?? [] as $item)
<p>
    <a href="/item/{{ $item->id }}">{{ $item->title }}</a>
</p>
@endforeach

@endsection
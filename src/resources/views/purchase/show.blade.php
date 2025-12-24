@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/purchase/show.css') }}">
@endsection

@section('content')

<div class="purchase-container">

    {{-- 左側 70% --}}
    <div class="purchase-left">

        {{-- 商品情報 --}}
        <div class="item-summary">
            <img src="{{ $item->image_path }}" class="purchase-item-image">

            <div class="item-text">
                <p class="item-name">{{ $item->title }}</p>
                <p class="item-price">¥{{ number_format($item->price) }}</p>
            </div>
        </div>

        <hr>

        {{-- 支払い方法 --}}
        <div class="section">
            <h3>支払い方法</h3>
            <select name="payment_method" form="purchase-form">
                <option value="" selected disabled>選択してください</option>
                <option value="card">カード払い</option>
                <option value="convenience">コンビニ払い</option>
            </select>
        </div>

        <hr>

        {{-- 配送先 --}}
        <div class="section">
            <h3>配送先</h3>
            <div class="address-row">
                <p>
                    〒{{ $user->profile->postal_code ?? '未登録' }}<br>
                    {{ $user->profile->address ?? '' }}<br>
                    {{ $user->profile->building ?? '' }}
                </p>

                <a href="{{ url('/purchase/address/' . $item->id) }}" class="change-link">
                    変更する
                </a>
            </div>
        </div>

    </div>


    {{-- 右側 30% --}}
    <div class="purchase-right">

        <table class="summary-table">
            <tr>
                <th>商品代金</th>
                <td>¥{{ number_format($item->price) }}</td>
            </tr>
            <tr>
                <th>支払い方法</th>
                <td id="payment-summary">{{$payment_method ??''}}</td>
            </tr>
        </table>


        <form id="purchase-form" action="{{ route('purchase.execute', $item->id) }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" id="payment_method_hidden">
            <button class="purchase-btn">購入する</button>
        </form>

    </div>

</div>

@endsection

@section('scripts')
<script>
    const select = document.querySelector('select[name="payment_method"]');
    const summary = document.getElementById('payment-summary');
    const hidden = document.getElementById('payment_method_hidden');

    function updatePayment() {
        const text = select.options[select.selectedIndex].text;
        summary.textContent = text;
        hidden.value = select.value;
    }

    updatePayment();
    select.addEventListener('change', updatePayment);
</script>
@endsection
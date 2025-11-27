<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * 購入確認画面
     */
    public function showPurchaseForm($item_id)
    {
        return view('purchase.form');
    }

    /**
     * 購入処理
     */
    public function purchase($item_id)
    {
        // 購入処理
        return redirect('/mypage');
    }

    /**
     * 住所変更画面
     */
    public function showAddressForm($item_id)
    {
        return view('purchase.address');
    }

    /**
     * 住所変更処理
     */
    public function updateAddress($item_id)
    {
        // 住所変更処理
        return redirect("/purchase/{$item_id}");
    }
}

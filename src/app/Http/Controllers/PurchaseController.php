<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PurchaseController extends Controller
{
    /**
     * 購入確認画面
     */
    public function showPurchaseForm($item_id)
    {
        $item = Item::with('user')->findOrFail($item_id);
        $user = auth()->user();

        return view('purchase.show', compact('item', 'user'));
    }

    /**
     * 購入処理
     */
    public function purchase(Request $request, $item_id)
    {
        // 購入処理
        return redirect('/mypage');
    }

    /**
     * 住所変更画面
     */
    public function showAddressForm($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        return view('purchase.address', compact('item', 'user')); // ← ここで$itemを渡す
    }

    /**
     * 住所変更処理
     */
    public function updateAddress(Request $request,$item_id)
    {
        $user = auth()->user();

        $request->validate([
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $profile = $user->profile;
        $profile->update([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase.form', $item_id);
    }
}

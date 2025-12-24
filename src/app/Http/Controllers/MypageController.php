<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Purchase;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        return $this->soldList($request);
    }

    /* 出品した商品 */
    public function soldList(Request $request)
    {
        $user = Auth::user();

        $items = Item::where('user_id', $user->id)->get();

        return view('mypage.index', [
            'user' => $user,
            'items' => $items
        ]);
    }

    /* 購入した商品 */
    public function purchasedList(Request $request)
    {
        $user = Auth::user();

        // purchases → item を参照
        $items = Item::whereIn(
            'id',
            Purchase::where('user_id', $user->id)->pluck('item_id')
        )->get();

        return view('mypage.index', [
            'user' => $user,
            'items' => $items
        ]);
    }
}

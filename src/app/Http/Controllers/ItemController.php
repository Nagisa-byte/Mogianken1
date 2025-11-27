<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Favorite;

class ItemController extends Controller
{
    /**
     * トップページ（商品一覧）
     */
    public function index()
    {
        // 常に商品一覧を表示（おすすめ）
        $items = Item::orderBy('created_at', 'desc')->get();

        return view('item.index', compact('items'));
    }

    /**
     * ログインユーザーのお気に入り商品一覧
     */
    public function mylist()
    {
        // 未ログイン → 空配列を渡す
        if (!auth()->check()) {
            return view('item.index', ['items' => []]);
        }

        // ログイン時 → お気に入り商品を取得
        $items = Item::whereHas('favorites', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();

        return view('item.index', compact('items'));
    }
    /**
     * 商品詳細
     */
    public function show($item_id)
    {
        return view('item.show');
    }
}

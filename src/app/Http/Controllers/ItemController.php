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
        // ★ ログアウト状態なら空配列を返す
        if (!auth()->check()) {
            return view('item.index', [
                'items' => collect(), // 空コレクション
            ]);
        }

        // ★ ログイン時：お気に入り商品を取得
        $items = auth()->user()
            ->favorites()
            ->with('item')
            ->get()
            ->pluck('item'); // item モデルのみ抽出

        return view('item.index', compact('items'));
    }


    /**
     * 商品詳細
     */
    public function show($item_id)
    {
        // IDで商品を取得
        $item = Item::with(['categories', 'comments.user.profile'])->findOrFail($item_id);

        return view('item.show', compact('item'));
    }
}

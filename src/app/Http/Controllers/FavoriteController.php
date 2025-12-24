<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Item;

class FavoriteController extends Controller
{
    /**
     * お気に入り登録
     */
    public function store(ITEM $item)
    {
        $item->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'likes_count' => $item->likes()->count(),
        ]);
    }

    /**
     * お気に入り解除
     */
    public function destroy(ITEM $item)
    {
        $item->likes()
            ->where('user_id', auth()->id())
            ->delete();

        return response()->json([
            'likes_count' => $item->likes()->count(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * お気に入り登録
     */
    public function store($item_id)
    {
        // お気に入り登録
        return back();
    }

    /**
     * お気に入り解除
     */
    public function destroy($item_id)
    {
        // お気に入り解除
        return back();
    }
}

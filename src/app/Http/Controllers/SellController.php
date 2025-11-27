<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * 出品画面表示
     */
    public function create()
    {
        return view('sell.create');
    }

    /**
     * 出品処理
     */
    public function store(Request $request)
    {
        // 出品処理
        return redirect('/mypage');
    }
}

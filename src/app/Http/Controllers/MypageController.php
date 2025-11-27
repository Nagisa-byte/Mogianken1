<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    /**
     * マイページ（出品した商品一覧）
     */
    public function index()
    {
        return view('mypage.index');
    }

    /**
     * 購入した商品一覧
     */
    public function purchasedList()
    {
        return view('mypage.index');
    }

    /**
     * 出品した商品一覧
     */
    public function soldList()
    {
        return view('mypage.index');
    }
}

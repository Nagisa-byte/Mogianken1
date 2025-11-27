<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * プロフィール表示
     */
    public function showProfile()
    {
        return view('profile.show');
    }

    /**
     * プロフィール編集画面
     */
    public function editProfile()
    {
        return view('profile.edit');
    }

    /**
     * プロフィール更新処理
     */
    public function updateProfile(Request $request)
    {
        // プロフィール更新処理
        return redirect('/mypage/profile');
    }
}

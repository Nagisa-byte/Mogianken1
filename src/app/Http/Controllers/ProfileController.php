<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('mypage.profile.edit', compact('user', 'profile'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = Auth::user();

        // 画像アップロード処理
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $profileImagePath = '/storage/' . $path;
        }

        // user 更新
        $user->update([
            'name' => $request->name,
        ]);

        // profile 更新 or 作成
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'postal_code'   => $request->postal_code,
                'address'       => $request->address,
                'building'      => $request->building,
                'profile_image' => $profileImagePath ?? ($user->profile->profile_image ?? null),
            ]
        );

        // ★ ここが今回のポイント
        return redirect()->route('mypage')->with('message', 'プロフィールを更新しました。');
    }
}

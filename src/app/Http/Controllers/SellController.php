<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class SellController extends Controller
{
    /**
     * 出品画面表示
     */
    public function create()
    {
        $categories = Category::all(); // ← DB から全部取得
        return view('sell.create', ['categories' => $categories,]);
    }

    /**
     * 出品処理
     */
    public function store(ExhibitionRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('item_images', 'public');
        }


        $item = Item::create([
            'user_id'     => Auth::id(),
            'image_path'  => $imagePath,
            'condition'   => $request->condition,
            'title'       => $request->title,
            'brand'       => $request->brand,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => '出品中',
        ]);

        // 中間テーブルへカテゴリー登録
        if ($request->categories) {
            $item->categories()->sync($request->categories);
        }

        return redirect('/mypage')->with('success', '商品を出品しました！');
    }
}

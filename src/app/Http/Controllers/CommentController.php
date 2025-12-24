<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Item;

class CommentController extends Controller
{
    /**
     * コメント投稿
     */
    public function store(CommentRequest $request, Item $item)
    {
        $item->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->route('item.show', $item->id);
    }
}

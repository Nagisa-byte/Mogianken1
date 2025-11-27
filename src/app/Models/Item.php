<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'title',
        'brand',
        'description',
        'price',
        'status',
        'condition',
    ];

    // 出品者（1対多の逆）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // お気に入り（1対多）
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // コメント（1対多）
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 購入情報（1対1 or 1対多）→ 1商品につき1購入とする
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    // 多対多カテゴリー（item_category）
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category', 'item_id', 'category_id');
    }

    // ユーザーがお気に入り済みかチェック
    public function isFavoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

}

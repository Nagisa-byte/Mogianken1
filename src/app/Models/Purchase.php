<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'postal_code',
        'address',
        'building',
        'payment_method',
    ];

    // 購入者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 購入した商品
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

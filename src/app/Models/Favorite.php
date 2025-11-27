<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
    ];

    // Userと紐づく
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Itemと紐づく
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    // 多対多 item_category
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_category', 'category_id', 'item_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'postal_code',
        'address',
        'building',
        'profile_image',
    ];

    // Userと1対1（逆）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'is_published'
    ];

    // Relasi: Artikel dimiliki oleh satu User
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Artikel memiliki banyak Likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Helper: Cek apakah user sedang login sudah like artikel ini
    public function isLikedByAuthUser()
    {
        if (!Auth::check()) return false;
        return $this->likes()->where('user_id', Auth::id())->exists();
    }
}

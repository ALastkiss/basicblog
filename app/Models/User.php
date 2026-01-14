<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // --- TAMBAHAN KHUSUS UAS ---
        'role',      // Untuk membedakan admin dan user biasa
        'instagram', // Fitur tambahan: link sosmed penulis
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- RELASI (RELATIONSHIPS) ---

    // Satu User bisa menulis BANYAK Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Satu User bisa memberikan BANYAK Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
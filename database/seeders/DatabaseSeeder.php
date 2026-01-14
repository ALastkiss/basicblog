<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        $admin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@blog.com',
            'password' => bcrypt('password'), // password default
            'role' => 'admin',
            'instagram' => 'https://instagram.com/admin_umtas',
        ]);

        // 2. Buat Akun Penulis Biasa
        $author = User::create([
            'name' => 'Mahasiswa UMTAS',
            'email' => 'user@blog.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'instagram' => 'https://instagram.com/mahasiswa_ti',
        ]);

        // 3. Buat Dummy Artikel (Milik Admin)
        Post::create([
            'user_id' => $admin->id,
            'title' => 'Selamat Datang di Blog UMTAS',
            'slug' => 'selamat-datang-di-blog-umtas',
            'content' => 'Ini adalah artikel pertama yang dibuat otomatis oleh seeder. Blog ini menggunakan Laravel versi terbaru dengan arsitektur MVC.',
            'image' => null, // Nanti kita atur upload gambar
            'is_published' => true,
        ]);

        // 4. Buat Dummy Artikel (Milik User)
        Post::create([
            'user_id' => $author->id,
            'title' => 'Tutorial Laravel untuk Pemula',
            'slug' => 'tutorial-laravel-untuk-pemula',
            'content' => 'Laravel adalah framework PHP yang sangat populer. Fitur Blade Template memudahkan kita membuat tampilan yang rapi.',
            'image' => null,
            'is_published' => true,
        ]);
    }
}
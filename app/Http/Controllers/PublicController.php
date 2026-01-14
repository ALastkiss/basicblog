<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    // Halaman Depan (Semua Artikel)
    public function index()
    {
        // Eager loading 'author' agar query ringan
        $posts = Post::with('author')->where('is_published', true)->latest()->get();
        return view('welcome', compact('posts'));
    }

    // Halaman Detail Artikel
    public function show($slug)
    {
        $post = Post::with(['author', 'likes'])->where('slug', $slug)->firstOrFail();
        return view('post-detail', compact('post'));
    }

    // Fitur Tambahan: Like Artikel (Toggle)
    public function toggleLike($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Login untuk menyukai artikel!');
        }

        $post = Post::findOrFail($id);
        $userId = Auth::id();

        // Cek apakah sudah like?
        $existingLike = Like::where('post_id', $id)->where('user_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete(); // Kalau sudah, hapus (Unlike)
            $status = 'unliked';
        } else {
            Like::create(['post_id' => $id, 'user_id' => $userId]); // Kalau belum, buat (Like)
            $status = 'liked';
        }

        return back(); // Kembali ke halaman sebelumnya
    }
}
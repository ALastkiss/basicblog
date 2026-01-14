<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Menampilkan daftar artikel (Admin Dashboard)
    public function index()
    {
        // Ambil artikel milik user yang sedang login saja (atau semua jika admin ingin melihat semua)
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    // Form Tambah Artikel
    public function create()
    {
        return view('admin.posts.create');
    }

    // Simpan Artikel Baru (Logic Manual)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5), // Slug unik
            'content' => $request->content,
            'image' => $imagePath,
            'is_published' => true, // Default publish
        ]);

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil dibuat!');
    }

    // Form Edit
    public function edit(Post $post)
    {
        // Pastikan hanya pemilik yang bisa edit
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        return view('admin.posts.edit', compact('post'));
    }

    // Update Artikel
    public function update(Request $request, Post $post)
    {
        // Validasi kepemilikan
        if ($post->user_id !== Auth::id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        // Jika ada gambar baru, hapus yang lama & upload baru
        if ($request->hasFile('image')) {
            if ($post->image) Storage::disk('public')->delete($post->image);
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Hapus Artikel
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) abort(403);

        if ($post->image) Storage::disk('public')->delete($post->image);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Artikel dihapus!');
    }
}
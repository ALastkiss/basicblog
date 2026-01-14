<?php
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// --- HALAMAN PUBLIK ---
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/read/{slug}', [PublicController::class, 'show'])->name('posts.show.public');

// Fitur Like (Hanya untuk user yang login)
Route::post('/post/{id}/like', [PublicController::class, 'toggleLike'])
    ->middleware('auth')
    ->name('posts.like');


// --- HALAMAN DASHBOARD / ADMIN ---
// Semua route di dalam grup ini butuh Login & Verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard default Breeze
    Route::get('/dashboard', function () {
        $userId = Auth::id();
        
        // Hitung total artikel milik user
        $totalArticles = Post::where('user_id', $userId)->count();
        
        // Ambil 3 artikel terakhir untuk ditampilkan di dashboard
        $recentArticles = Post::where('user_id', $userId)->latest()->take(3)->get();

        return view('dashboard', compact('totalArticles', 'recentArticles'));
    })->name('dashboard');

    // Route untuk CRUD Artikel (Otomatis buat index, create, store, edit, update, destroy)
    Route::resource('posts', PostController::class)->except(['show']);
    
    // Profil User (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
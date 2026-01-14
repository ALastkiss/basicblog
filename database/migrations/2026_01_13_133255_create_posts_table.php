<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('posts', function (Blueprint $table) {
        $table->id();
        // Relasi ke penulis (users)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->string('slug')->unique(); // Untuk URL ramah SEO
        $table->string('image')->nullable(); // Thumbnail artikel [cite: 20]
        $table->text('content'); // Isi artikel
        $table->boolean('is_published')->default(true);
        $table->timestamps(); // Mencakup tanggal publikasi (created_at)
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

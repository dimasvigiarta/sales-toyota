<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('slug')->unique();
            $table->enum('kategori', ['SUV', 'MPV', 'Hatchback', 'Sedan', 'Pickup', 'Sport']);
            $table->bigInteger('harga_mulai');
            $table->text('deskripsi')->nullable();
            $table->json('spesifikasi')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
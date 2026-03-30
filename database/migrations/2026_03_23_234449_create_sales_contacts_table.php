<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sales');
            $table->enum('wilayah', ['Utara', 'Selatan', 'Barat', 'Timur', 'Pusat']);
            $table->string('nomor_wa');
            $table->text('pesan_default')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_contacts');
    }
};
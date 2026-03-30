<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->json('highlights')->nullable()->after('warna_tersedia');
            // Format JSON:
            // [
            //   {
            //     "judul": "Eksterior Memukau",
            //     "deskripsi": "Desain modern yang aerodinamis...",
            //     "gambar": "cars/1/highlights/eksterior.jpg"
            //   },
            //   ...
            // ]
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('highlights');
        });
    }
};
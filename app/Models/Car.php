<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Car extends Model
{
    protected $fillable = [
        'nama_mobil', 'slug', 'kategori', 'harga_mulai',
        'deskripsi', 'spesifikasi', 'warna_tersedia', 'highlights', 'is_featured', 'is_active',
    ];

    protected $casts = [
        'spesifikasi'    => 'array',
        'warna_tersedia' => 'array',
        'highlights'     => 'array',
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
        'harga_mulai'    => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Car $car) {
            $car->slug = Str::slug($car->nama_mobil);
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class)->orderBy('urutan');
    }

    public function galleryImages(): HasMany
    {
        return $this->hasMany(CarImage::class)
                    ->where('tipe_gambar', 'galeri')
                    ->orderBy('urutan');
    }

    public function threeSixtyImages(): HasMany
    {
        return $this->hasMany(CarImage::class)
                    ->where('tipe_gambar', '360_degree')
                    ->orderBy('urutan');
    }

    public function imagesByWarna(string $warna): HasMany
    {
        return $this->hasMany(CarImage::class)
                    ->where('tipe_gambar', 'galeri')
                    ->where('warna_nama', $warna)
                    ->orderBy('urutan');
    }

    public function galleryImagesNoWarna(): HasMany
    {
        return $this->hasMany(CarImage::class)
                    ->where('tipe_gambar', 'galeri')
                    ->whereNull('warna_nama')
                    ->orderBy('urutan');
    }

    public function getThumbnailAttribute(): string
    {
        // Prioritas 1: foto per warna
        $warnaPhoto = $this->galleryImages()
            ->whereNotNull('warna_nama')
            ->orderBy('urutan')
            ->first();

        if ($warnaPhoto) {
            return asset('storage/' . $warnaPhoto->path_gambar);
        }

        // Prioritas 2: foto umum (warna_nama null)
        $umumPhoto = $this->galleryImages()
            ->whereNull('warna_nama')
            ->orderBy('urutan')
            ->first();

        if ($umumPhoto) {
            return asset('storage/' . $umumPhoto->path_gambar);
        }

        // Placeholder
        $nama = urlencode($this->nama_mobil);
        return "https://placehold.co/800x500/1a1a1a/eb0a1e?text={$nama}&font=raleway";
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_mulai, 0, ',', '.');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesContact extends Model
{
    protected $fillable = [
        'nama_sales', 'wilayah', 'nomor_wa',
        'pesan_default', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function getWaLinkAttribute(): string
    {
        $pesan = urlencode($this->pesan_default ?? 'Halo, saya ingin info Toyota terbaru.');
        return "https://wa.me/{$this->nomor_wa}?text={$pesan}";
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
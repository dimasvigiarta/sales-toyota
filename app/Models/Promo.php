<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promo extends Model
{
    protected $fillable = [
        'judul_promo', 'slug', 'gambar_banner',
        'konten', 'tanggal_berakhir', 'is_active',
    ];

    protected $casts = [
        'tanggal_berakhir' => 'date',
        'is_active'        => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Promo $p) {
            $p->slug = Str::slug($p->judul_promo);
        });
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->tanggal_berakhir && $this->tanggal_berakhir->isPast();
    }

    public function getSisaHariAttribute(): ?int
    {
        if (!$this->tanggal_berakhir) return null;
        return max(0, now()->diffInDays($this->tanggal_berakhir, false));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where(function ($q) {
                         $q->whereNull('tanggal_berakhir')
                           ->orWhere('tanggal_berakhir', '>=', now()->toDateString());
                     });
    }
}
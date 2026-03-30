@extends('layouts.app')
@section('title', 'Promo Toyota – Rama Toyota Jember')

@section('content')
<div class="pt-16 lg:pt-20">

  {{-- CSS UNTUK ANIMASI RUNNING TEXT --}}
  <style>
    @keyframes marquee {
      0% { transform: translateX(0%); }
      100% { transform: translateX(-50%); }
    }
    .animate-marquee {
      animation: marquee 45s linear infinite; 
    }
    .animate-marquee:hover {
      animation-play-state: paused; 
    }
  </style>

  {{-- HERO SECTION (Sudah diperbaiki: menempel ke navbar) --}}
  <div class="relative w-full bg-black overflow-hidden pt-24 lg:pt-32 pb-12 lg:pb-16">
    
    {{-- Gambar Latar --}}
    <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=2000&auto=format&fit=crop" 
         alt="Background Promo Toyota" 
         class="absolute inset-0 w-full h-full object-cover object-center opacity-30 mix-blend-luminosity">
         
    {{-- Gradien Gelap agar teks terbaca jelas --}}
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#000000]"></div>

    {{-- Konten Hero (Tengah, Rapi, Minimalis) --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p class="text-red-600 font-bold tracking-[0.3em] text-[10px] sm:text-xs uppercase mb-3">
        Penawaran Eksklusif
      </p>
      <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight mb-4">
        Promo Spesial
      </h1>
      <p class="text-slate-300 max-w-2xl mx-auto text-sm md:text-base font-light leading-relaxed">
        Wujudkan mobil Toyota impian Anda bulan ini. Temukan berbagai kemudahan, DP ringan, dan bonus aksesoris khusus untuk pelanggan setia Rama Toyota.
      </p>
    </div>
  </div>

  {{-- PITA RUNNING TEXT --}}
  <div class="w-full bg-black border-y border-slate-800/80 overflow-hidden flex items-center h-14 relative shadow-md">
    
    {{-- PENYESUAIAN DI SINI: font-semibold, text-slate-300, text-xs/sm, dan tracking-widest --}}
    <div class="whitespace-nowrap flex w-max animate-marquee items-center text-slate-300 text-xs sm:text-sm font-semibold tracking-widest uppercase">
      
      {{-- KELOMPOK TEKS 1 --}}
      <span class="mx-8 text-white font-bold tracking-[0.25em]">Rama Toyota Jember</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">Bunga 0% Tenor 1 Tahun</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">DP Ringan Mulai 10%</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">Gratis Servis Berkala & Suku Cadang</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">Tukar Tambah Harga Terbaik</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>

      {{-- KELOMPOK TEKS 2 (Duplikat untuk Looping Mulus) --}}
      <span class="mx-8 text-white font-bold tracking-[0.25em]">Rama Toyota Jember</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">Bunga 0% Tenor 1 Tahun</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">DP Ringan Mulai 10%</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">Gratis Servis Berkala & Suku Cadang</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      <span class="mx-8 hover:text-white transition-colors cursor-default">Tukar Tambah Harga Terbaik</span>
      <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
      
    </div>
  </div>

 {{-- GRID PROMO (GAYA OTOMOTIF ELEGAN & PREMIUM) --}}
  <section class="py-16 md:py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      @if($promos->isEmpty())
      {{-- Empty State --}}
      <div class="text-center py-24 flex flex-col items-center justify-center bg-white border border-slate-200 shadow-sm rounded-lg">
        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
          <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Promo Saat Ini</h3>
        <p class="text-slate-500">Nantikan penawaran eksklusif dan menarik dari Rama Toyota selanjutnya.</p>
      </div>
      @else
      
      {{-- Grid Card --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($promos as $promo)
        <a href="{{ route('promos.show', $promo->slug) }}"
           class="group block bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-slate-200">
          
          {{-- Gambar Container (Rasio lebih lebar, ujung tajam di atas) --}}
          <div class="relative w-full aspect-[16/9] bg-slate-200 overflow-hidden">
            @if($promo->gambar_banner)
            <img src="{{ asset('storage/' . $promo->gambar_banner) }}"
                 alt="{{ $promo->judul_promo }}"
                 class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
            @else
            {{-- Fallback Gambar Kosong --}}
            <div class="absolute inset-0 flex items-center justify-center bg-slate-100">
               <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
               </svg>
            </div>
            @endif
            
            {{-- Overlay Gelap Halus saat di-hover --}}
            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-300"></div>

            {{-- Label Sisa Hari (Tegas & Kotak) --}}
            @if($promo->sisa_hari !== null)
            <div class="absolute top-4 left-4">
              <span class="inline-flex items-center gap-1.5 bg-black/80 backdrop-blur-sm text-white font-bold text-xs uppercase tracking-wider px-3 py-1.5 rounded shadow-sm border border-white/10">
                @if($promo->sisa_hari === 0)
                  <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                  <span class="text-red-400">Hari Terakhir</span>
                @else
                  <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                  Sisa {{ $promo->sisa_hari }} Hari
                @endif
              </span>
            </div>
            @endif
          </div>

          {{-- Konten Text --}}
          <div class="p-6">
            {{-- Kategori / Label --}}
            <p class="text-red-600 font-bold text-[10px] tracking-[0.2em] uppercase mb-3">Penawaran Eksklusif</p>
            
            {{-- Judul Promo --}}
            <h3 class="font-bold text-lg md:text-xl text-slate-900 leading-tight mb-4 group-hover:text-red-600 transition-colors line-clamp-2 min-h-[3rem]">
              {{ $promo->judul_promo }}
            </h3>
            
            {{-- Garis Pemisah Tipis --}}
            <div class="w-full h-px bg-slate-100 mb-4"></div>
            
            {{-- Footer Card (Batas Waktu & Tombol Aksi) --}}
            <div class="flex items-center justify-between">
              <div class="flex flex-col">
                <span class="text-slate-500 text-[11px] font-semibold uppercase tracking-wider mb-1">Berlaku Hingga</span>
                <span class="text-sm font-bold text-slate-800">
                  @if($promo->tanggal_berakhir)
                    {{ $promo->tanggal_berakhir->format('d M Y') }}
                  @else
                    Tanpa Batas Waktu
                  @endif
                </span>
              </div>

              {{-- Tombol Aksi Teks (Lebih profesional daripada icon bulat) --}}
              <div class="flex items-center text-red-600 font-bold text-sm group-hover:text-red-700 transition-colors">
                Lihat Detail
                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>

      {{-- PAGINATION --}}
      <div class="mt-16 flex justify-center">
        {{ $promos->links() }}
      </div>
      @endif
      
    </div>
  </section>

</div>
@endsection
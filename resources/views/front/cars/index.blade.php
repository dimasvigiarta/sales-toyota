@extends('layouts.app')
@section('title', 'Daftar Mobil Toyota – Dimas Toyota Jember')

@section('content')
<div class="pt-16 lg:pt-20">
{{-- HEADER DAFTAR MOBIL (LEBIH PENDEK + TEKS PENARIK) --}}
  <div class="bg-[#0f172a] pt-24 pb-6 lg:pt-28 lg:pb-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      {{-- Teks Aksen --}}
      <p class="text-red-600 font-bold tracking-[0.2em] text-xs sm:text-sm uppercase mb-2">
        Daftar Kendaraan
      </p>
      
      {{-- Judul Utama --}}
      <h1 class="font-bold text-3xl md:text-4xl text-white uppercase tracking-tight mb-3">
        Temukan Mobil Impianmu Di Sini
      </h1>
      
      {{-- Kalimat Penarik Pelanggan (Soft-Selling) --}}
      <p class="text-slate-400 text-sm max-w-2xl font-light leading-relaxed">
        Jelajahi lini mobil Toyota terbaru kami. Dapatkan penawaran harga terbaik, promo DP ringan, serta kemudahan proses cicilan khusus untuk Anda bulan ini.
      </p>
      
    </div>
  </div>

  {{-- FILTER --}}
  <div class="bg-white border-b border-gray-200 sticky top-16 lg:top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <form method="GET" action="{{ route('cars.index') }}" class="flex flex-wrap gap-3 items-center">
        <div class="relative flex-1 min-w-[200px]">
          <input type="text" name="search" value="{{ request('search') }}"
                 placeholder="Temukan Mobil Impianmu..."
                 class="w-full border border-gray-200 px-4 py-2.5 text-sm
                        focus:outline-none focus:border-red-600 transition-colors">
        </div>
        <select name="kategori" onchange="this.form.submit()"
                class="border border-gray-200 px-4 py-2.5 text-sm
                       focus:outline-none focus:border-red-600">
          <option value="">Semua Kategori</option>
          @foreach($categories as $cat)
          <option value="{{ $cat }}" {{ request('kategori') === $cat ? 'selected' : '' }}>
            {{ $cat }}
          </option>
          @endforeach
        </select>
        <select name="sort" onchange="this.form.submit()"
                class="border border-gray-200 px-4 py-2.5 text-sm
                       focus:outline-none focus:border-red-600">
          <option value="latest"     {{ request('sort') === 'latest'     ? 'selected' : '' }}>Terbaru</option>
          <option value="harga_asc"  {{ request('sort') === 'harga_asc'  ? 'selected' : '' }}>Harga Terendah</option>
          <option value="harga_desc" {{ request('sort') === 'harga_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
        </select>
        <button type="submit"
                class="bg-red-600 text-white px-6 py-2.5 text-sm font-semibold
                       hover:bg-red-700 transition-colors">
          Cari
        </button>
      </form>
    </div>
  </div>

 {{-- GRID MOBIL --}}
  <section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if($cars->isEmpty())
      <div class="text-center py-20">
        <div class="text-6xl mb-4 text-gray-300">🚗</div>
        <p class="font-medium text-lg text-gray-500">Belum ada model mobil yang tersedia.</p>
      </div>
      @else
      
      <div class="flex justify-between items-end mb-8">
        <p class="text-gray-500 text-sm">
          Menampilkan <strong class="text-gray-900">{{ $cars->total() }}</strong> model
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($cars as $car)
        <a href="{{ route('cars.show', $car->slug) }}"
           class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg
                  hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

          {{-- Gambar Container --}}
          <div class="relative overflow-hidden aspect-[4/3] p-6 flex items-center justify-center bg-gray-50/50">
            
            <img src="{{ $car->thumbnail }}" alt="{{ $car->nama_mobil }}"
                 class="max-h-full max-w-full object-contain mix-blend-multiply
                        group-hover:scale-105 transition-transform duration-700 ease-in-out">
            
            {{-- Badge Unggulan (Kiri Atas & Mencolok Merah) --}}
            @if($car->is_featured)
            <span class="absolute top-4 left-4 bg-red-600 text-white shadow-md
                         font-bold text-[10px] uppercase tracking-widest px-3 py-1.5 rounded-sm">
              Unggulan
            </span>
            @endif
          </div>

          {{-- Info Container --}}
          <div class="p-5 flex flex-col flex-grow">
            
            {{-- Header Area (Nama & Kategori Sejajar) --}}
            <div class="mb-4 flex items-start justify-between gap-2">
              <h3 class="font-extrabold uppercase text-lg text-gray-900 tracking-tight leading-tight">
                {{ $car->nama_mobil }}
              </h3>
              
              {{-- Badge Kategori (Di samping kanan nama mobil) --}}
              <span class="shrink-0 inline-block bg-gray-100 text-gray-600 
                           font-semibold text-[10px] uppercase tracking-wider px-2 py-1 rounded-sm mt-0.5">
                {{ $car->kategori }}
              </span>
            </div>
            
            {{-- Harga --}}
            <div class="mt-auto">
              <p class="text-gray-400 text-[10px] uppercase tracking-widest font-medium mb-1">Mulai Dari</p>
              <p class="font-black text-xl text-gray-900 mb-1">{{ $car->harga_format }}</p>
              <p class="text-gray-400 text-[10px] italic">*Harga OTR Jember</p>
            </div>

            {{-- Action Link --}}
            <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
              <span class="text-xs font-bold text-gray-500 uppercase tracking-wider group-hover:text-red-600 transition-colors">
                Lihat Detail
              </span>
              <div class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400
                          group-hover:border-red-600 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>

      {{-- PAGINATION --}}
      <div class="mt-14 flex justify-center">
        {{ $cars->links() }}
      </div>
      @endif
    </div>
  </section>

</div>
@endsection
@extends('layouts.app')

{{-- Judul yang lebih disukai Google (memasukkan kata Promo & Tahun) --}}
@section('title', 'Promo Toyota Jember & Harga OTR Terbaru 2026 | Rama Toyota')

{{-- Tambahkan baris ini untuk mendeskripsikan isi beranda di hasil pencarian Google --}}
@section('meta_desc', 'Dapatkan promo diskon DP ringan, cicilan mudah, dan harga OTR termurah untuk Avanza, Veloz, Raize di Jember. Hubungi dealer resmi Rama Toyota sekarang!')

@section('content')

{{-- DATA SLIDES --}}
@php
$slides = [
  ['img' => 'hero1.png', 'alt' => 'Promo Toyota Jember Terbaru 2026'],
  ['img' => 'hero2.jpg', 'alt' => 'Kredit Mobil Toyota DP Ringan Jember'],
  ['img' => 'hero3.jpg', 'alt' => 'Dealer Resmi Rama Toyota Jember'],
  ['img' => 'hero4.png', 'alt' => 'Harga OTR Toyota Avanza Veloz Jember'],
];
@endphp

{{-- HERO SLIDER --}}
<section class="relative overflow-hidden" style="height: 60vw; min-height: 420px; max-height: 900px;"
         x-data="{
           slides: @js($slides),
           current: 0,
           total: {{ count($slides) }},
           isTransitioning: true,
           timer: null,
           
           get activeIndex() {
             return this.current === this.total ? 0 : this.current;
           },

           next() {
             if (this.current >= this.total) return;
             this.isTransitioning = true;
             this.current++;
             
             if (this.current === this.total) {
               setTimeout(() => {
                 this.isTransitioning = false;
                 this.current = 0;
               }, 700); 
             }
           },

           prev() {
             if (this.current === 0) {
               this.isTransitioning = false;
               this.current = this.total;
               setTimeout(() => {
                 this.isTransitioning = true;
                 this.current--;
               }, 50);
             } else {
               this.isTransitioning = true;
               this.current--;
             }
           },

           go(i) { 
             this.isTransitioning = true;
             this.current = i;
           },

           startTimer() {
             this.stopTimer();
             this.timer = setInterval(() => this.next(), 4500);
           },

           stopTimer() {
             if (this.timer) { clearInterval(this.timer); this.timer = null; }
           }
         }"
         x-init="startTimer()"
         x-intersect:enter="startTimer()"
         x-intersect:leave="stopTimer()">

  {{-- TRACK GAMBAR --}}
  <div class="flex h-full w-full"
       :class="isTransitioning ? 'transition-transform duration-700 ease-in-out' : ''"
       :style="`transform: translateX(-${current * 100}%);`">
    
    @foreach($slides as $slide)
    <div class="relative flex-shrink-0 w-full h-full">
      <img src="{{ asset('images/' . $slide['img']) }}" alt="Toyota" class="w-full h-full object-cover object-center">
      <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-black/20"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
    </div>
    @endforeach

    {{-- Slide Kloningan --}}
    <div class="relative flex-shrink-0 w-full h-full">
      <img src="{{ asset('images/' . $slides[0]['img']) }}" alt="Toyota" class="w-full h-full object-cover object-center">
      <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-black/20"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
    </div>

  </div>

  --}}

  {{-- PANAH NAVIGASI --}}
  <button @click="prev()" class="absolute left-4 lg:left-6 top-1/2 -translate-y-1/2 z-20 w-9 h-9 bg-white/10 backdrop-blur-sm border border-white/15 text-white hover:bg-white/20 transition-all duration-200 flex items-center justify-center pointer-events-auto">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
  </button>
  <button @click="next()" class="absolute right-4 lg:right-6 top-1/2 -translate-y-1/2 z-20 w-9 h-9 bg-white/10 backdrop-blur-sm border border-white/15 text-white hover:bg-white/20 transition-all duration-200 flex items-center justify-center pointer-events-auto">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
  </button>

  {{-- DOTS NAVIGASI (Dinaikkan posisinya: bottom-24 sm:bottom-20) --}}
  <div class="absolute bottom-24 sm:bottom-20 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2 pointer-events-auto">
    @foreach($slides as $i => $slide)
    <button @click="go({{ $i }})"
            class="transition-all duration-300 rounded-sm"
            :class="activeIndex === {{ $i }} ? 'w-6 h-1.5 bg-red-600' : 'w-1.5 h-1.5 rounded-full bg-white/30 hover:bg-white/60'">
    </button>
    @endforeach
  </div>

  {{-- STATS BAR BAWAH --}}
  <div class="absolute bottom-0 inset-x-0 z-20 bg-black/50 backdrop-blur-sm border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-3 divide-x divide-white/10">
        @foreach([['50+', 'Model Tersedia'], ['14+', 'Tahun Pengalaman'], ['5.000+', 'Pelanggan Puas']] as $stat)
        <div class="px-4 py-3 text-center">
          <p class="font-black text-lg text-white leading-none">{{ $stat[0] }}</p>
          <p class="text-white/40 text-[9px] uppercase tracking-[0.15em] mt-0.5">{{ $stat[1] }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</section>

{{-- EXPLORE VEHICLES --}}
<section class="bg-white py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900">Jelajahi Kendaraan</h2>
      <p class="text-gray-400 text-sm mt-2">Harga OTR Jember</p>
    </div>

    {{-- Tab Filter --}}
    <div x-data="{ tab: 'Semua' }" class="w-full">
      <div class="flex items-center border-b border-gray-200 mb-8 overflow-x-auto scrollbar-hide">
        @php $tabs = ['Semua', 'SUV', 'MPV', 'Hatchback', 'Sedan', 'Pickup']; @endphp
        @foreach($tabs as $t)
        <button @click="tab = '{{ $t }}'"
                :class="tab === '{{ $t }}'
                  ? 'text-red-600 font-bold'
                  : 'text-gray-500 hover:text-gray-800'"
                class="flex-shrink-0 px-6 py-3 text-sm font-semibold
                       uppercase tracking-wide transition-colors duration-200">
          {{ $t }}
        </button>
        @endforeach
      </div>

      {{-- Grid Mobil --}}
      @foreach($tabs as $t)
      <div x-show="tab === '{{ $t }}'"
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100">
        @php
          $filtered = $t === 'Semua'
            ? $featuredCars
            : $featuredCars->filter(fn($c) => $c->kategori === $t);
        @endphp

        @if($filtered->isEmpty())
        <div class="text-center py-12 text-gray-400">
          <p class="text-sm">Belum ada model untuk kategori ini.</p>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($filtered as $car)
          <a href="{{ route('cars.show', $car->slug) }}"
             class="group block border border-gray-100 hover:border-gray-200
                    hover:shadow-lg transition-all duration-300">
            {{-- Gambar --}}
            <div class="relative bg-gray-50 overflow-hidden" style="aspect-ratio: 16/10">
              <img src="{{ $car->thumbnail }}"
                  {{-- UPDATE BAGIAN ALT INI: Tambahkan kata kunci penting di sekitar nama mobil --}}
                  alt="Promo Harga OTR {{ $car->nama_mobil }} Jember Terbaru 2026 - Dealer Rama Toyota"
                  class="w-full h-full object-cover
                          group-hover:scale-105 transition-transform duration-500">
              
              @if($car->is_featured)
              <span class="absolute top-3 left-3 bg-red-600 text-white
                          text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">
                  Unggulan
              </span>
              @endif
            </div>
            {{-- Info --}}
            <div class="p-5">
              <div class="flex items-start justify-between">
                <div>
                  <span class="text-[10px] text-gray-400 uppercase tracking-wider
                               font-semibold border border-gray-200 px-2 py-0.5">
                    {{ $car->kategori }}
                  </span>
                  <h3 class="font-bold text-gray-900 text-base mt-2
                             group-hover:text-red-600 transition-colors">
                    {{ $car->nama_mobil }}
                  </h3>
                  <p class="text-red-600 font-bold text-sm mt-1">
                    {{ $car->harga_format }}
                  </p>
                </div>
                <div class="w-8 h-8 border border-gray-200 flex items-center
                            justify-center flex-shrink-0 mt-1
                            group-hover:bg-red-600 group-hover:border-red-600
                            transition-all duration-200">
                  <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-white transition-colors"
                       fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                </div>
              </div>
              @if(!empty($car->spesifikasi))
              <div class="flex items-center gap-4 mt-4 pt-4 border-t border-gray-100">
                @if(isset($car->spesifikasi['mesin']['kapasitas']))
                <div class="text-center">
                  <p class="font-bold text-xs text-gray-900">{{ $car->spesifikasi['mesin']['kapasitas'] }}</p>
                  <p class="text-[10px] text-gray-400 mt-0.5">Mesin</p>
                </div>
                <div class="w-px h-6 bg-gray-200"></div>
                @endif
                @if(isset($car->spesifikasi['transmisi']))
                <div class="text-center">
                  <p class="font-bold text-xs text-gray-900">{{ $car->spesifikasi['transmisi'] }}</p>
                  <p class="text-[10px] text-gray-400 mt-0.5">Transmisi</p>
                </div>
                <div class="w-px h-6 bg-gray-200"></div>
                @endif
                @if(isset($car->spesifikasi['interior']['kapasitas_penumpang']))
                <div class="text-center">
                  <p class="font-bold text-xs text-gray-900">{{ $car->spesifikasi['interior']['kapasitas_penumpang'] }} Orang</p>
                  <p class="text-[10px] text-gray-400 mt-0.5">Kapasitas</p>
                </div>
                @endif
              </div>
              @endif
            </div>
          </a>
          @endforeach
        </div>
        @endif
      </div>
      @endforeach

      <div class="text-center mt-10">
        <a href="{{ route('cars.index') }}"
           class="inline-flex items-center gap-2 border border-gray-300 text-gray-700
                  font-semibold text-xs uppercase tracking-wider px-8 py-3
                  hover:border-red-600 hover:text-red-600 transition-all duration-200">
          Lihat Semua Model
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

{{-- LAYANAN --}}
<section class="bg-gray-50 py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
      <p class="text-gray-400 text-sm mt-2">Kami hadir untuk memudahkan perjalanan Anda</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
      @foreach([
        ['Test Drive',    'M12 19l9 2-9-18-9 18 9-2zm0 0v-8'],
        ['Simulasi Kredit','M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M12 7h.01M15 7h3a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h3'],
        ['Tukar Tambah',  'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
        ['After Sales',   'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z'],
        ['Book Service',  'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['Hubungi Kami',  'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
      ] as $layanan)
      <a href="#"
         class="flex flex-col items-center gap-3 p-5 bg-white border border-gray-100
                hover:border-red-200 hover:shadow-md hover:-translate-y-0.5
                transition-all duration-300 text-center group">
        <div class="w-12 h-12 bg-gray-50 group-hover:bg-red-50
                    flex items-center justify-center transition-colors duration-300">
          <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="{{ $layanan[1] }}"/>
          </svg>
        </div>
        <span class="text-xs font-semibold text-gray-700 group-hover:text-red-600
                     transition-colors leading-tight">
          {{ $layanan[0] }}
        </span>
      </a>
      @endforeach
    </div>
  </div>
</section>

{{-- PROMO --}}
@if($activePromos->isNotEmpty())
<section class="bg-white py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-10">
      <div>
        <h2 class="text-3xl font-bold text-gray-900">Promo Terkini</h2>
        <p class="text-gray-400 text-sm mt-1">Penawaran terbatas untuk Anda</p>
      </div>
      <a href="{{ route('promos.index') }}"
         class="hidden sm:flex items-center gap-2 text-red-600 font-semibold
                text-xs uppercase tracking-wider hover:gap-3 transition-all group">
        Lihat Semua
        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach($activePromos as $promo)
      <a href="{{ route('promos.show', $promo->slug) }}"
         class="group block overflow-hidden border border-gray-100
                hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
        <div class="relative overflow-hidden bg-gray-100" style="aspect-ratio: 16/9">
          @if($promo->gambar_banner)
          <img src="{{ asset('storage/' . $promo->gambar_banner) }}"
               alt="Promo Diskon Toyota Jember 2026 - {{ $promo->judul_promo }}"
               class="w-full h-full object-cover
                      group-hover:scale-105 transition-transform duration-500">
          @else
          <div class="w-full h-full bg-gradient-to-br from-red-600 to-red-800
                      flex items-center justify-center">
            <span class="text-white font-black text-4xl opacity-20">%</span>
          </div>
          @endif
          @if($promo->sisa_hari !== null)
          <div class="absolute top-3 left-3">
            <span class="bg-red-600 text-white text-[10px] font-bold
                        uppercase tracking-wider px-2.5 py-1 rounded-full">
            @if($promo->sisa_hari === 0) Hari Ini @else Sisa {{ $promo->sisa_hari }} Hari @endif
            </span>
          </div>
          @endif
        </div>
        <div class="p-5 bg-white">
          <h3 class="font-bold text-gray-900 text-sm group-hover:text-red-600
                     transition-colors leading-snug">
            {{ $promo->judul_promo }}
          </h3>
          @if($promo->tanggal_berakhir)
          <p class="text-gray-400 text-xs mt-1.5">
            Berlaku hingga {{ $promo->tanggal_berakhir->format('d M Y') }}
          </p>
          @endif
          <div class="flex items-center gap-1 mt-3 text-red-600 font-semibold text-xs">
            Lihat Detail
            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif


{{-- WHY US --}}
<section id="tentang" class="bg-gray-50 py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <p class="text-red-600 text-xs font-semibold uppercase tracking-[0.2em] mb-3">
          Mengapa Rama Toyota
        </p>
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-6">
          Pengalaman Terbaik<br>Bersama Toyota
        </h2>
        <p class="text-gray-500 leading-relaxed mb-8 text-sm font-light">
          Hadir sejak 2010, kami berkomitmen memberikan pengalaman membeli
          mobil yang mudah, transparan, dan menyenangkan bagi masyarakat Jember.
        </p>
        <a href="{{ route('tentang') }}"
           class="inline-flex items-center gap-2 border border-gray-300 text-gray-700
                  font-semibold text-xs uppercase tracking-wider px-6 py-3
                  hover:border-red-600 hover:text-red-600 transition-all duration-200 group">
          Tentang Kami
          <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>

      <div class="grid grid-cols-2 gap-3">
        @foreach([
          ['Dealer Terpercaya', 'Dealer resmi Toyota sejak 2010 dengan ribuan pelanggan puas'],
          ['Harga Transparan',  'Harga OTR jelas dan kompetitif tanpa biaya tersembunyi'],
          ['Test Drive Gratis', 'Coba kendaraan impian Anda sebelum memutuskan membeli'],
          ['After Sales Prima', 'Bengkel resmi Toyota dengan teknisi bersertifikat'],
        ] as $item)
        <div class="bg-white border border-gray-100 p-5
                    hover:border-red-200 hover:shadow-sm
                    transition-all duration-300 group">
          <div class="w-5 h-0.5 bg-red-600 mb-4
                      group-hover:w-10 transition-all duration-300"></div>
          <h4 class="font-bold text-sm text-gray-900 mb-2">{{ $item[0] }}</h4>
          <p class="text-gray-400 text-xs leading-relaxed">{{ $item[1] }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>


{{-- VIDEO CINEMATIC SECTION --}}
<section class="bg-gray-900 py-16 relative overflow-hidden">
  {{-- Background pattern tipis (opsional) --}}
  <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ef4444 1px, transparent 1px); background-size: 32px 32px;"></div>
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

    {{-- Video Container (Rasio 16:9) - Opsi dengan Suara --}}
      <div class="relative w-full max-w-5xl mx-auto rounded-2xl overflow-hidden shadow-2xl border border-gray-800 bg-black aspect-video">
        
        {{-- iframe diubah: pointer-events-none Dihapus, mute=0, controls=1 --}}
        <iframe 
          class="absolute top-0 left-0 w-full h-full" 
          src="https://www.youtube.com/embed/c992zr2bFcM?autoplay=0&mute=0&loop=1&playlist=c992zr2bFcM&controls=1&rel=0" 
          frameborder="0" 
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
          allowfullscreen>
        </iframe>
        
      </div>
  </div>
</section>

{{-- BANNER CTA --}}
<section class="bg-gray-900 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-10 items-center">

      {{-- Kiri --}}
      <div>
        <div class="flex items-center gap-3 mb-4">
          <div class="w-6 h-px bg-red-600"></div>
          <span class="text-red-500 text-xs font-semibold uppercase tracking-[0.2em]">
            Penawaran Terbatas
          </span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight mb-4">
          Dapatkan Penawaran<br>Terbaik Hari Ini
        </h2>
        <p class="text-gray-400 text-sm leading-relaxed mb-8 font-light">
          DP ringan mulai 20 juta, bunga kompetitif, dan proses kredit cepat.
          Wujudkan Toyota impian Anda sekarang bersama kami.
        </p>
        <div class="flex flex-wrap gap-3">
          <button onclick="document.querySelector('[x-data*=fetchContacts]').__x.$data.fetchContacts()"
                  class="bg-red-600 text-white font-bold uppercase text-xs
                         tracking-[0.15em] px-7 py-3
                         hover:bg-red-700 transition-colors">
            Hubungi Sales
          </button>
          <a href="{{ route('promos.index') }}"
             class="border border-gray-600 text-gray-300 font-bold uppercase text-xs
                    tracking-[0.15em] px-7 py-3
                    hover:border-gray-400 hover:text-white transition-all">
            Lihat Promo
          </a>
        </div>
      </div>

      {{-- Kanan: Stats --}}
      <div class="grid grid-cols-2 gap-4">
        @foreach([
          ['Rp 20 Juta',      'DP Mulai'],
          ['60 Bulan',        'Tenor Maksimal'],
          ['Cepat & Mudah',   'Proses Kredit'],
          ['Kompetitif',      'Bunga'],
        ] as $item)
        <div class="border border-gray-800 p-5 hover:border-gray-600 transition-colors">
          <p class="font-bold text-white text-lg leading-none">{{ $item[0] }}</p>
          <p class="text-gray-500 text-xs mt-2 uppercase tracking-wider">{{ $item[1] }}</p>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</section>


{{-- FAQ SECTION (SEO BOOSTER) --}}
<section class="bg-white py-20 border-t border-gray-100">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mb-4">Pertanyaan yang Sering Diajukan</h2>
      <p class="text-gray-500">Temukan jawaban untuk pertanyaan umum seputar pembelian mobil Toyota di dealer kami.</p>
    </div>

    <div class="space-y-4" x-data="{ activeAccordion: null }">
      
      @php
        $faqs = [
          [
            'q' => 'Apa saja syarat untuk pengajuan kredit mobil Toyota?',
            'a' => 'Syarat umum untuk perorangan meliputi: KTP Suami & Istri, Kartu Keluarga, NPWP, PBB/Bukti Kepemilikan Rumah, Slip Gaji/Buku Tabungan 3 bulan terakhir. Tim sales kami akan membantu proses pendataan hingga disetujui (*Approved*).'
          ],
          [
            'q' => 'Apakah melayani pembelian dari luar kota/daerah?',
            'a' => 'Tentu! Kami melayani pembelian mobil Toyota untuk wilayah kota ini dan sekitarnya, serta siap membantu proses pengiriman unit kendaraan langsung ke garasi rumah Anda dengan aman.'
          ],
          [
            'q' => 'Apakah dealer ini melayani tukar tambah (Trade-In)?',
            'a' => 'Ya, kami melayani tukar tambah mobil lama Anda (segala merek) dengan mobil Toyota terbaru. Kami akan memberikan estimasi harga mobil lama Anda dengan nilai terbaik dan proses yang transparan.'
          ],
          [
            'q' => 'Berapa lama proses pembuatan STNK dan BPKB?',
            'a' => 'Untuk unit *Ready Stock*, proses STNK umumnya memakan waktu 14 hari kerja setelah pelunasan/akad kredit. Sedangkan BPKB untuk pembelian tunai selesai dalam 2-3 bulan, dan untuk kredit akan disimpan oleh pihak Leasing.'
          ]
        ];
      @endphp

      @foreach($faqs as $index => $faq)
      <div class="bg-gray-50 border border-gray-100 rounded-xl overflow-hidden transition-all duration-300"
           :class="activeAccordion === {{ $index }} ? 'shadow-md border-red-100' : 'hover:border-gray-200'">
        <button 
          @click="activeAccordion = activeAccordion === {{ $index }} ? null : {{ $index }}" 
          class="w-full flex items-center justify-between p-6 text-left focus:outline-none">
          <span class="font-bold text-gray-900 text-sm sm:text-base pr-4" 
                :class="activeAccordion === {{ $index }} ? 'text-red-600' : ''">
            {{ $faq['q'] }}
          </span>
          <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center transition-colors"
               :class="activeAccordion === {{ $index }} ? 'border-red-600 bg-red-50 text-red-600' : 'text-gray-400'">
            <svg class="w-5 h-5 transition-transform duration-300" 
                 :class="activeAccordion === {{ $index }} ? 'rotate-180' : ''" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </button>
        
        <div x-show="activeAccordion === {{ $index }}" 
             x-collapse 
             x-transition:enter="transition ease-out duration-300"
             x-transition:leave="transition ease-in duration-200"
             class="px-6 pb-6 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
          {{ $faq['a'] }}
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>

{{-- TESTIMONI --}}
<section class="bg-white py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900">Kata Pelanggan Kami</h2>
      <p class="text-gray-400 text-sm mt-2">
        Lebih dari 5.000 keluarga mempercayakan kendaraan mereka kepada kami
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach([
        ['nama' => 'Hendra S.',  'kota' => 'Jember Kota',       'mobil' => 'Innova',   'rating' => 5, 'pesan' => 'Pelayanan sangat memuaskan! Proses kredit cepat, dalam 3 hari mobil sudah bisa dibawa pulang.'],
        ['nama' => 'Ratna W.',   'kota' => 'Ambulu, Jember',    'mobil' => 'Hilux',     'rating' => 5, 'pesan' => 'Sudah 2 kali beli mobil di sini. Harga transparan, tidak ada biaya tersembunyi sama sekali.'],
        ['nama' => 'Doni P.',    'kota' => 'Kaliwates, Jember', 'mobil' => 'Fortuner Legender',    'rating' => 5, 'pesan' => 'Setelah test drive langsung jatuh cinta. Prosesnya mudah dan salesnya tidak memaksa sama sekali.'],
        ['nama' => 'Agus M.',    'kota' => 'Bondowoso',         'mobil' => 'Fortuner GR', 'rating' => 5, 'pesan' => 'Walaupun dari Bondowoso, tetap pilih Rama Toyota Jember karena pelayanannya jauh lebih baik.'],
        ['nama' => 'Sinta L.',   'kota' => 'Sumbersari, Jember','mobil' => 'Veloz',    'rating' => 5, 'pesan' => 'Salesnya bantu pilihkan mobil sesuai budget keluarga. After sales juga bagus dan mudah.'],
        ['nama' => 'Rizky F.',   'kota' => 'Patrang, Jember',   'mobil' => 'Calya',    'rating' => 5, 'pesan' => 'Beli untuk usaha travel. Harga oke, DP ringan, dan mobil langsung ready. Sangat profesional!'],
      ] as $t)
      <div class="p-6 border border-gray-100 hover:border-gray-200 hover:shadow-md
                  transition-all duration-300">
        <div class="flex gap-0.5 mb-4">
          @for($r = 0; $r < $t['rating']; $r++)
          <svg class="w-3.5 h-3.5 fill-yellow-400" viewBox="0 0 24 24">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
          </svg>
          @endfor
        </div>
        <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">
          "{{ $t['pesan'] }}"
        </p>
        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
          <div class="w-8 h-8 bg-red-600 rounded-full flex items-center
                      justify-center font-bold text-white text-xs flex-shrink-0">
            {{ strtoupper(substr($t['nama'], 0, 1)) }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-bold text-xs text-gray-900">{{ $t['nama'] }}</p>
            <p class="text-[10px] text-gray-400">{{ $t['kota'] }}</p>
          </div>
          <span class="text-[10px] text-gray-500 font-semibold border border-gray-200
                       px-2 py-0.5 flex-shrink-0">
            {{ $t['mobil'] }}
          </span>
        </div>
      </div>
      @endforeach
    </div>

    <div class="mt-10 flex justify-center">
      <div class="flex items-center gap-5 border border-gray-200 px-8 py-4">
        <div class="text-center">
          <p class="font-black text-2xl text-gray-900 leading-none">4.9</p>
          <div class="flex gap-0.5 mt-1 justify-center">
            @for($r = 0; $r < 5; $r++)
            <svg class="w-3 h-3 fill-yellow-400" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            @endfor
          </div>
        </div>
        <div class="w-px h-8 bg-gray-200"></div>
        <div>
          <p class="font-bold text-xs text-gray-900">Rating Google</p>
          <p class="text-[10px] text-gray-400 mt-0.5">Berdasarkan 500+ ulasan</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
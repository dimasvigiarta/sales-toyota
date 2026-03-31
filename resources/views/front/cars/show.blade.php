@extends('layouts.app')

@section('title', $car->nama_mobil . ' – Rama Toyota Jember')

@php
  $specs      = $car->spesifikasi ?? [];
  $firstImage = $car->galleryImages->first()?->url
                ?? asset('images/no-image.png');
@endphp

@section('content')

{{-- HERO BANNER --}}
<section class="relative w-full overflow-hidden bg-gray-950"
         style="min-height: 45vh;">

  {{-- Background gambar pertama --}}
  <div class="absolute inset-0">
    <img src="{{ $firstImage }}"
         alt="{{ $car->nama_mobil }}"
         class="w-full h-full object-cover opacity-60">
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
  </div>

  {{-- Content --}}
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
              flex flex-col justify-end pb-8 pt-24 sm:pb-20 sm:pt-32 lg:pt-40"
       style="min-height: 45vh;">
    <div class="max-w-2xl">

      {{-- Nama Mobil (Ukuran 3/5 dari asli) --}}
      <h1 class="font-black text-white uppercase leading-none tracking-tight
                 text-2xl sm:text-5xl lg:text-6xl xl:text-7xl mb-3">
        {{ $car->nama_mobil }}
      </h1>

      {{-- Deskripsi --}}
      <p class="text-white/60 text-xs sm:text-base leading-relaxed mb-4 sm:mb-8
                max-w-lg font-light">
        {{ $car->deskripsi }}
      </p>

      {{-- Harga + CTA --}}
      <div class="flex flex-col sm:flex-row sm:items-center gap-6">
        <div>
          <p class="text-white/40 text-[10px] uppercase tracking-[0.2em] mb-1">
            Harga OTR Mulai
          </p>
          <p class="font-black text-lg sm:text-3xl text-red-500">
            {{ $car->harga_format }}
          </p>
        </div>
        <div class="flex flex-wrap gap-3 mt-2 sm:mt-0">
          <button onclick="document.querySelector('[x-data*=fetchContacts]').__x.$data.fetchContacts()"
                  class="bg-red-600 text-white font-bold uppercase text-[10px] sm:text-xs
                         tracking-[0.15em] px-5 sm:px-6 py-2.5 sm:py-3
                         hover:bg-red-700 transition-colors w-full sm:w-auto text-center">
            Tanya Promo
          </button>
          <button class="border border-white/30 text-white font-bold uppercase
                         text-[10px] sm:text-xs tracking-[0.15em] px-5 sm:px-6 py-2.5 sm:py-3
                         hover:border-white hover:bg-white/5 transition-all w-full sm:w-auto text-center">
            Test Drive
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- STICKY SUB-NAVBAR --}}
<div class="sticky top-16 lg:top-20 z-40 bg-white/95 backdrop-blur-md border-y border-gray-200 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between min-h-[50px]"> {{-- Menjaga agar tetap ramping --}}

      {{-- Tab navigasi --}}
      <div class="flex items-center overflow-x-auto scrollbar-hide">
        @foreach([
          ['id' => 'overview',  'label' => 'Overview'],
          ['id' => 'warna',     'label' => 'Pilihan Warna'],
          ['id' => 'viewer360', 'label' => '360°'],
          ['id' => 'spesifikasi','label'=> 'Spesifikasi'],
          ['id' => 'galeri',    'label' => 'Galeri'],
        ] as $tab)
        <a href="#{{ $tab['id'] }}"
           class="flex-shrink-0 px-4 sm:px-5 py-3 font-bold text-[10px] uppercase
                  tracking-[0.1em] border-b-2 border-transparent
                  text-gray-500 hover:text-gray-900 hover:border-red-600
                  transition-all duration-300">
          {{ $tab['label'] }}
        </a>
        @endforeach
      </div>

      {{-- Harga & CTA di sub-navbar --}}
      <div class="hidden md:flex items-center gap-5 flex-shrink-0 pl-4 border-l border-gray-200 ml-2">
        <div class="text-right flex flex-col justify-center">
          <p class="text-[8px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-0.5">Mulai dari</p>
          <p class="font-black text-sm text-gray-900 tracking-tight leading-none">{{ $car->harga_format }}</p>
        </div>
        
        {{-- Tombol Hitam Elegan (Tidak tabrakan dengan merah di navbar utama) --}}
        <button onclick="document.querySelector('[x-data*=fetchContacts]').__x.$data.fetchContacts()"
                class="bg-gray-900 text-white font-bold uppercase text-[10px]
                       tracking-[0.1em] px-5 py-2 rounded-sm shadow-sm
                       hover:bg-red-600 hover:shadow-md transition-all duration-300 whitespace-nowrap flex items-center gap-2">
          <span>Hubungi Sales</span>
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </button>
      </div>
      
    </div>
  </div>
</div>

{{-- OVERVIEW --}}
<section id="overview" class="bg-white py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <p class="text-red-600 text-xs font-semibold uppercase tracking-[0.2em] mb-2">
        Kenali Lebih Dekat
      </p>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">
        {{ $car->nama_mobil }}
      </h2>
    </div>

    {{-- Quick Specs Grid --}}
    @if(!empty($specs))
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-16">
      
      {{-- Kapasitas Mesin --}}
      @if(isset($specs['mesin']['kapasitas']))
      <div class="group text-center p-6 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-red-100 hover:-translate-y-1 transition-all duration-300">
        <div class="w-12 h-12 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-red-50 transition-colors duration-300">
          <svg class="w-6 h-6 text-gray-400 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
          </svg>
        </div>
        <p class="font-black text-2xl text-gray-900 tracking-tight">{{ $specs['mesin']['kapasitas'] }}</p>
        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-[0.15em] mt-2">Kapasitas Mesin</p>
      </div>
      @endif

      {{-- Tenaga Maksimum --}}
      @if(isset($specs['mesin']['tenaga']))
      <div class="group text-center p-6 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-red-100 hover:-translate-y-1 transition-all duration-300">
        <div class="w-12 h-12 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-red-50 transition-colors duration-300">
          <svg class="w-6 h-6 text-gray-400 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
          </svg>
        </div>
        <p class="font-black text-2xl text-gray-900 tracking-tight">{{ $specs['mesin']['tenaga'] }}</p>
        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-[0.15em] mt-2">Tenaga Maksimum</p>
      </div>
      @endif

      {{-- Transmisi --}}
      @if(isset($specs['transmisi']))
      <div class="group text-center p-6 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-red-100 hover:-translate-y-1 transition-all duration-300">
        <div class="w-12 h-12 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-red-50 transition-colors duration-300">
          <svg class="w-6 h-6 text-gray-400 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <p class="font-black text-2xl text-gray-900 tracking-tight">{{ $specs['transmisi'] }}</p>
        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-[0.15em] mt-2">Transmisi</p>
      </div>
      @endif

      {{-- Kapasitas Penumpang --}}
      @if(isset($specs['interior']['kapasitas_penumpang']))
      <div class="group text-center p-6 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-red-100 hover:-translate-y-1 transition-all duration-300">
        <div class="w-12 h-12 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-red-50 transition-colors duration-300">
          <svg class="w-6 h-6 text-gray-400 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <p class="font-black text-2xl text-gray-900 tracking-tight">
          {{ $specs['interior']['kapasitas_penumpang'] }} <span class="text-base font-bold text-gray-500">Orang</span>
        </p>
        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-[0.15em] mt-2">Kapasitas</p>
      </div>
      @endif

    </div>
    @endif

    {{-- Fitur Unggulan --}}
    @if(!empty($specs['fitur']))
    <div class="border-t border-gray-100 pt-16 mt-16">
      <div class="text-center mb-10">
        <h3 class="text-2xl font-black text-gray-900 tracking-tight">Fitur Unggulan</h3>
        <p class="text-gray-500 text-sm mt-2">Teknologi dan kenyamanan terbaik di kelasnya</p>
      </div>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($specs['fitur'] as $fitur)
        <div class="group bg-white flex items-center gap-4 p-5 rounded-lg border border-gray-100 shadow-sm 
                    hover:shadow-md hover:border-red-100 hover:-translate-y-0.5 transition-all duration-300">
          
          {{-- Ikon Checkmark Merah Elegan --}}
          <div class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0 group-hover:bg-red-600 transition-colors duration-300">
            <svg class="w-4 h-4 text-red-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          
          <span class="text-sm text-gray-800 font-semibold tracking-wide">{{ $fitur }}</span>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>


{{-- COLOR OPTIONS --}}
@if(!empty($car->warna_tersedia))
<section id="warna" class="bg-gray-50 py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <p class="text-red-600 text-xs font-semibold uppercase tracking-[0.2em] mb-2">
        Temukan Yang Sesuai
      </p>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Pilihan Warna</h2>
    </div>

    <div x-data="{
      warnaAktif: '{{ $car->warna_tersedia[0]['nama'] ?? '' }}',
      warnas: {{ json_encode($car->warna_tersedia) }},
      allImages: {{ json_encode(
        $car->galleryImages->groupBy(fn($img) => $img->warna_nama ?? '__umum__')
          ->map(fn($imgs) => $imgs->pluck('url')->values())
      ) }},
      getImage(nama) {
        if (this.allImages[nama] && this.allImages[nama].length > 0) {
          return this.allImages[nama][0];
        }
        if (this.allImages['__umum__'] && this.allImages['__umum__'].length > 0) {
          return this.allImages['__umum__'][0];
        }
        return '{{ $firstImage }}';
      }
    }">
      {{-- Gambar Mobil Besar --}}
      <div class="relative bg-gradient-to-b from-gray-100 to-gray-200
                  flex items-center justify-center mb-8 overflow-hidden"
           style="min-height: 400px;">
        {{-- Pattern background seperti Toyota Astra --}}
        <div class="absolute inset-0 opacity-5"
             style="background-image: repeating-linear-gradient(
               45deg, transparent, transparent 20px,
               #000 20px, #000 21px)">
        </div>
        
        {{-- Gambar Mobil dengan Transisi --}}
        <img :src="getImage(warnaAktif)"
             :alt="warnaAktif"
             class="relative z-10 max-h-80 w-full object-contain
                    transition-opacity duration-300 ease-in-out drop-shadow-2xl px-8"
             {{-- Opsional: Tambahkan efek fade in/out saat ganti gambar --}}
             x-transition:enter="transition-opacity duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">
      </div>

      {{-- Nama warna aktif --}}
      <div class="text-center mb-6 h-12"> {{-- Fixed height agar layout tidak lompat --}}
        <p class="font-bold text-lg text-gray-900 transition-all duration-300" x-text="warnaAktif"></p>
        <p class="text-gray-400 text-xs mt-1">Warna Tersedia</p>
      </div>

      {{-- Dots warna --}}
      <div class="flex items-center justify-center gap-4 flex-wrap">
        <template x-for="warna in warnas" :key="warna.nama">
          <button type="button"
                  @click="warnaAktif = warna.nama"
                  :title="warna.nama"
                  class="relative group focus:outline-none">
            
            {{-- Dot Background (Lingkaran Warna) --}}
            {{-- Perbaikan: Memisahkan cincin border luar (ring) dengan warna isi (bg) --}}
            <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200"
                 :class="{ 
                    'ring-2 ring-gray-900 ring-offset-2 scale-110': warnaAktif === warna.nama,
                    'ring-1 ring-transparent hover:ring-gray-300 hover:scale-105': warnaAktif !== warna.nama
                 }">
                <div class="w-8 h-8 rounded-full shadow-inner border border-black/10"
                     :style="`background-color: ${warna.hex}`">
                </div>
            </div>

            {{-- Tooltip --}}
            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3
                        bg-gray-900 text-white text-[10px] px-3 py-1.5 rounded
                        whitespace-nowrap opacity-0 group-hover:opacity-100
                        transition-opacity duration-200 pointer-events-none z-20 shadow-lg">
              <span x-text="warna.nama" class="font-medium tracking-wide"></span>
              <div class="absolute top-full left-1/2 -translate-x-1/2
                          border-[5px] border-transparent border-t-gray-900"></div>
            </div>
          </button>
        </template>
      </div>
    </div>
  </div>
</section>
@endif

{{-- 360 VIEWER --}}
@if($car->threeSixtyImages->count() === 8)
<section id="viewer360" class="bg-white py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <p class="text-red-600 text-xs font-semibold uppercase tracking-[0.2em] mb-2">
        Eksplorasi Visual
      </p>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">360° Visualisasi</h2>
      <p class="text-gray-400 text-sm mt-2">Geser untuk memutar tampilan eksterior</p>
    </div>

    <div x-data="{
           frames: {{ json_encode($car->threeSixtyImages->pluck('url')) }},
           currentFrame: 0,
           show360Hint: true,
           isDragging: false,
           startX: 0,
           sensitivity: 40,
           startDrag(e) {
             this.isDragging = true;
             this.startX = e.clientX;
             this.show360Hint = false;
           },
           onDrag(e) {
             if (!this.isDragging) return;
             const delta = e.clientX - this.startX;
             if (Math.abs(delta) >= this.sensitivity) {
               const dir = delta > 0 ? -1 : 1;
               this.currentFrame = (this.currentFrame + dir + this.frames.length) % this.frames.length;
               this.startX = e.clientX;
             }
           },
           endDrag() { this.isDragging = false; },
           startTouch(e) {
             this.isDragging = true;
             this.startX = e.touches[0].clientX;
             this.show360Hint = false;
           },
           onTouch(e) {
             if (!this.isDragging) return;
             const delta = e.touches[0].clientX - this.startX;
             if (Math.abs(delta) >= this.sensitivity) {
               const dir = delta > 0 ? -1 : 1;
               this.currentFrame = (this.currentFrame + dir + this.frames.length) % this.frames.length;
               this.startX = e.touches[0].clientX;
             }
           }
         }"
         class="relative bg-gradient-to-b from-gray-50 to-gray-100 overflow-hidden select-none
                cursor-grab active:cursor-grabbing"
         style="aspect-ratio: 16/7;"
         @mousedown="startDrag($event)"
         @mousemove="onDrag($event)"
         @mouseup="endDrag"
         @mouseleave="endDrag"
         @touchstart.prevent="startTouch($event)"
         @touchmove.prevent="onTouch($event)"
         @touchend="endDrag">

      <img :src="frames[currentFrame]"
           alt="360 View"
           class="w-full h-full object-contain"
           draggable="false">

      {{-- Hint overlay --}}
      <div x-show="show360Hint"
           x-transition:leave="transition ease-in duration-500"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           class="absolute inset-0 flex items-center justify-center
                  bg-black/20 pointer-events-none">
        <div class="bg-white/90 px-6 py-4 text-center shadow-lg rounded-lg">
          <p class="text-2xl mb-1 text-gray-800">&#8596;</p>
          <p class="font-semibold text-xs uppercase tracking-wider text-gray-700">
            Geser untuk Memutar
          </p>
        </div>
      </div>

      {{-- Frame counter (Hanya Menampilkan 360°) --}}
      <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-md rounded-md
                  text-gray-800 font-bold text-sm px-4 py-2 shadow-md border border-gray-100">
        360°
      </div>

    </div>
  </div>
</section>
@endif


{{-- HIGHLIGHTS --}}
@if(!empty($car->highlights))
@foreach($car->highlights as $i => $highlight)
<section class="border-t border-gray-100 {{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">

  {{-- Header Section --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
      <div class="flex items-center justify-center gap-3 mb-3">
        <div class="w-8 h-px bg-red-600"></div>
        <span class="text-red-600 font-semibold text-xs uppercase tracking-[0.2em]">
          {{ $car->nama_mobil }}
        </span>
        <div class="w-8 h-px bg-red-600"></div>
      </div>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">
        {{ $highlight['judul'] }}
      </h2>
      @if(!empty($highlight['deskripsi']))
      <p class="text-gray-400 mt-3 text-base font-light max-w-2xl mx-auto">
        {{ $highlight['deskripsi'] }}
      </p>
      @endif
    </div>

    {{-- Gambar Hero --}}
    @if(!empty($highlight['gambar_hero']))
    <div class="w-full overflow-hidden mb-6">
      <img src="{{ asset('storage/' . $highlight['gambar_hero']) }}"
           alt="{{ $highlight['judul'] }}"
           class="w-full object-cover hover:scale-105 transition-transform duration-700"
           style="max-height: 560px;">
    </div>
    @endif

    {{-- Sub Items --}}
    @if(!empty($highlight['sub_items']))
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
      @foreach($highlight['sub_items'] as $sub)
      @if(!empty($sub['gambar']))
      <div class="group">
        <div class="overflow-hidden bg-gray-100 mb-4">
          <img src="{{ asset('storage/' . $sub['gambar']) }}"
               alt="{{ $sub['caption'] ?? '' }}"
               class="w-full object-cover group-hover:scale-105
                      transition-transform duration-500"
               style="aspect-ratio: 16/10;">
        </div>
        @if(!empty($sub['caption']))
        <h4 class="font-bold text-gray-900 text-base mb-1">
          {{ $sub['caption'] }}
        </h4>
        @endif
        @if(!empty($sub['deskripsi']))
        <p class="text-gray-400 text-sm leading-relaxed font-light">
          {{ $sub['deskripsi'] }}
        </p>
        @endif
      </div>
      @endif
      @endforeach
    </div>
    @endif

  </div>
</section>
@endforeach
@endif

{{-- SPESIFIKASI (DARK THEME) --}}
@if(!empty($specs))
<section id="spesifikasi" class="bg-gray-900 py-20 border-t border-gray-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- Section Header --}}
    <div class="text-center mb-16">
      <p class="text-red-500 text-xs font-bold uppercase tracking-[0.25em] mb-3">
        Detail Teknis
      </p>
      <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Spesifikasi</h2>
      <div class="w-12 h-1 bg-red-600 mx-auto mt-6 rounded-full"></div>
    </div>

    {{-- Accordion Container --}}
    <div class="max-w-3xl mx-auto" x-data="{ open: 'mesin' }">
      @foreach([
        ['key' => 'mesin',    'label' => 'Mesin & Performa'],
        ['key' => 'dimensi',  'label' => 'Dimensi Kendaraan'],
        ['key' => 'interior', 'label' => 'Interior & Kapasitas'],
        ['key' => 'fitur',    'label' => 'Fitur & Teknologi'],
      ] as $section)
      
      @if(isset($specs[$section['key']]))
      <div class="mb-3 bg-gray-800/50 rounded-lg border border-gray-700/50 overflow-hidden backdrop-blur-sm transition-all duration-300"
           :class="open === '{{ $section['key'] }}' ? 'border-gray-600 shadow-lg' : 'hover:border-gray-600'">
        
        {{-- Header accordion --}}
        <button @click="open = open === '{{ $section['key'] }}' ? null : '{{ $section['key'] }}'"
                class="w-full flex items-center justify-between px-6 py-5
                       text-left transition-colors group"
                :class="open === '{{ $section['key'] }}' ? 'bg-gray-800' : 'hover:bg-gray-800'">
          <span class="font-bold text-[13px] text-gray-200 uppercase tracking-widest group-hover:text-white transition-colors">
            {{ $section['label'] }}
          </span>
          
          {{-- Animated Plus/Minus Icon --}}
          <div class="relative w-5 h-5 flex items-center justify-center">
             <span class="absolute w-full h-[2px] bg-gray-400 group-hover:bg-white transition-colors duration-300"></span>
             <span class="absolute h-full w-[2px] bg-gray-400 group-hover:bg-white transition-all duration-300"
                   :class="open === '{{ $section['key'] }}' ? 'rotate-90 opacity-0' : 'rotate-0 opacity-100'"></span>
          </div>
        </button>

        {{-- Content accordion --}}
        <div x-show="open === '{{ $section['key'] }}'"
             x-collapse
             x-transition:enter="transition ease-out duration-300"
             x-transition:leave="transition ease-in duration-200"
             class="border-t border-gray-700/50 bg-gray-900/30">
          
          @if($section['key'] === 'fitur' && is_array($specs['fitur']))
          <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6">
            @foreach($specs['fitur'] as $fitur)
            <div class="flex items-start gap-3 py-1.5 group">
              <svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-sm text-gray-300 group-hover:text-white transition-colors">{{ $fitur }}</span>
            </div>
            @endforeach
          </div>
          
          @else
          <div class="divide-y divide-gray-700/30">
            @foreach($specs[$section['key']] as $key => $val)
            <div class="flex items-center justify-between px-6 py-4 group hover:bg-gray-800/30 transition-colors">
              <span class="text-[11px] text-gray-500 font-semibold uppercase tracking-[0.15em]">
                {{ ucfirst(str_replace('_', ' ', $key)) }}
              </span>
              <span class="font-bold text-sm text-gray-200 text-right group-hover:text-white transition-colors">{{ $val }}</span>
            </div>
            @endforeach
            
            @if($section['key'] === 'mesin' && isset($specs['transmisi']))
            <div class="flex items-center justify-between px-6 py-4 group hover:bg-gray-800/30 transition-colors">
              <span class="text-[11px] text-gray-500 font-semibold uppercase tracking-[0.15em]">Transmisi</span>
              <span class="font-bold text-sm text-gray-200 text-right group-hover:text-white transition-colors">{{ $specs['transmisi'] }}</span>
            </div>
            @endif
            
            @if($section['key'] === 'mesin' && isset($specs['bahan_bakar']))
            <div class="flex items-center justify-between px-6 py-4 group hover:bg-gray-800/30 transition-colors">
              <span class="text-[11px] text-gray-500 font-semibold uppercase tracking-[0.15em]">Bahan Bakar</span>
              <span class="font-bold text-sm text-gray-200 text-right group-hover:text-white transition-colors">{{ $specs['bahan_bakar'] }}</span>
            </div>
            @endif
          </div>
          @endif
          
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- GALERI --}}
@if($car->galleryImagesNoWarna->isNotEmpty())
<section id="galeri" class="bg-white py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <p class="text-red-600 text-xs font-semibold uppercase tracking-[0.2em] mb-2">
        Penyerahan Unit Ke Pelanggan
      </p>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Galeri</h2>
    </div>

    <div x-data="{
           images: {{ json_encode($car->galleryImagesNoWarna->pluck('url')) }},
           current: 0,
           timer: null,
           next() { this.current = (this.current + 1) % Math.ceil(this.images.length / 2) },
           prev() { this.current = (this.current - 1 + Math.ceil(this.images.length / 2)) % Math.ceil(this.images.length / 2) },
           startTimer() { this.timer = setInterval(() => this.next(), 4000) },
           stopTimer()  { clearInterval(this.timer) }
         }"
         x-init="startTimer()"
         @mouseenter="stopTimer()"
         @mouseleave="startTimer()">

      {{-- Slider --}}
      <div class="overflow-hidden">
        <div class="flex transition-transform duration-700 ease-in-out"
             :style="'transform: translateX(-' + (current * 100) + '%)'">

          @php
            $chunks = $car->galleryImagesNoWarna->chunk(2);
          @endphp

          @foreach($chunks as $chunk)
          <div class="flex gap-4 flex-shrink-0 w-full">
            @foreach($chunk as $img)
            <div class="flex-1 overflow-hidden bg-gray-100 rounded-sm"
                 style="aspect-ratio: 4/3;">
              <img src="{{ $img->url }}"
                   alt="{{ $car->nama_mobil }}"
                   class="w-full h-full object-cover hover:scale-105
                          transition-transform duration-500">
            </div>
            @endforeach
            {{-- Jika chunk ganjil, tambah placeholder --}}
            @if($chunk->count() === 1)
            <div class="flex-1"></div>
            @endif
          </div>
          @endforeach

        </div>
      </div>

      {{-- Dots --}}
      @if($chunks->count() > 1)
      <div class="flex justify-center gap-2 mt-6">
        @foreach($chunks as $i => $chunk)
        <button @click="current = {{ $i }}"
                class="transition-all duration-300 rounded-sm"
                :class="{{ $i }} === current
                  ? 'w-6 h-1.5 bg-red-600'
                  : 'w-1.5 h-1.5 rounded-full bg-gray-300 hover:bg-gray-500'">
        </button>
        @endforeach
      </div>
      @endif

    </div>
  </div>
</section>
@endif

{{-- MOBIL TERKAIT --}}
@if($relatedCars->isNotEmpty())
<section class="bg-gray-50 py-16 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-10">
      <h2 class="text-2xl font-bold text-gray-900">Model Terkait</h2>
      <a href="{{ route('cars.index') }}"
         class="text-red-600 font-semibold text-xs uppercase tracking-wider
                hover:underline flex items-center gap-1 group">
        Lihat Semua
        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
      @foreach($relatedCars as $related)
      <a href="{{ route('cars.show', $related->slug) }}"
         class="group block bg-white border border-gray-100
                hover:border-gray-200 hover:shadow-lg
                hover:-translate-y-1 transition-all duration-300">
        <div class="aspect-video overflow-hidden bg-gray-100">
          <img src="{{ $related->thumbnail }}" alt="{{ $related->nama_mobil }}"
               class="w-full h-full object-cover
                      group-hover:scale-105 transition-transform duration-500">
        </div>
        <div class="p-4">
          <span class="text-[10px] text-gray-400 uppercase tracking-wider
                       font-semibold border border-gray-200 px-2 py-0.5">
            {{ $related->kategori }}
          </span>
          <h3 class="font-bold text-gray-900 mt-2
                     group-hover:text-red-600 transition-colors">
            {{ $related->nama_mobil }}
          </h3>
          <p class="text-red-600 font-bold text-sm mt-1">{{ $related->harga_format }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
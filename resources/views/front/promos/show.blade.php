@extends('layouts.app')
@section('title', $promo->judul_promo . ' – Dimas Toyota Jember')

@section('content')
<div class="pt-16 lg:pt-20">

  {{-- HERO HEADER --}}
  <div class="relative bg-gray-950">
    <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-600"></div>
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-10 sm:py-14">

      {{-- Breadcrumb --}}
      <a href="{{ route('promos.index') }}"
         class="inline-flex items-center gap-2 text-gray-500 hover:text-white
                text-xs uppercase tracking-wider transition-colors mb-6 group">
        <svg class="w-3 h-3 group-hover:-translate-x-1 transition-transform"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Semua Promo
      </a>

      {{-- Badge --}}
      @if($promo->sisa_hari !== null)
      <div class="mb-4">
        @if($promo->sisa_hari === 0)
        <span class="inline-flex items-center gap-2 bg-red-600 text-white
                     font-bold text-xs uppercase tracking-widest px-3 py-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
          Berakhir Hari Ini
        </span>
        @elseif($promo->sisa_hari <= 7)
        <span class="inline-flex items-center gap-2 bg-red-600 text-white
                     font-bold text-xs uppercase tracking-widest px-3 py-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
          Sisa {{ $promo->sisa_hari }} Hari
        </span>
        @else
        <span class="inline-flex items-center gap-2 bg-white/10 text-white
                     font-bold text-xs uppercase tracking-widest px-3 py-1.5">
          Sisa {{ $promo->sisa_hari }} Hari
        </span>
        @endif
      </div>
      @endif

      {{-- Judul --}}
      <h1 class="font-black text-white uppercase leading-none tracking-tight
                 text-3xl sm:text-4xl lg:text-5xl mb-4">
        {{ $promo->judul_promo }}
      </h1>

      {{-- Tanggal --}}
      @if($promo->tanggal_berakhir)
      <div class="flex items-center gap-2 text-gray-400 text-sm">
        <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none"
             stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        Berlaku hingga {{ $promo->tanggal_berakhir->format('d F Y') }}
      </div>
      @endif

    </div>
  </div>

  {{-- BANNER --}}
  @if($promo->gambar_banner)
  <div class="bg-gray-50 border-t border-b border-gray-100 py-8 sm:py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <img src="{{ asset('storage/' . $promo->gambar_banner) }}"
           alt="{{ $promo->judul_promo }}"
           class="w-full h-auto object-contain block rounded-sm shadow-md"
           style="max-height: 600px;">
    </div>
  </div>
  @endif

  {{-- KONTEN --}}
  @if(!empty($promo->konten))
  <section class="bg-white border-t border-gray-100 py-10 sm:py-14">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="prose prose-gray max-w-none
                  prose-headings:font-bold prose-headings:text-gray-900
                  prose-p:text-gray-600 prose-p:leading-relaxed
                  prose-li:text-gray-600 prose-strong:text-gray-900
                  prose-a:text-red-600">
        {!! $promo->konten !!}
      </div>
    </div>
  </section>
  @endif

  {{-- CTA SECTION --}}
  <section class="bg-gray-950 py-12 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-8">

        <div>
          <p class="text-red-500 text-xs font-semibold uppercase tracking-widest mb-2">
            Jangan Lewatkan
          </p>
          <h3 class="font-black text-white uppercase text-2xl sm:text-3xl leading-tight mb-2">
            Tertarik dengan<br class="hidden sm:block"> promo ini?
          </h3>
          <p class="text-gray-500 text-sm">
            Hubungi sales kami sebelum penawaran berakhir.
          </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto flex-shrink-0">
          <button onclick="document.querySelector('[x-data*=fetchContacts]').__x.$data.fetchContacts()"
                  class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                         bg-red-600 text-white font-bold uppercase text-xs tracking-wider
                         px-8 py-4 hover:bg-red-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            Hubungi Sales
          </button>

          @if(!empty($promo->file_brosur))
          <a href="{{ asset('storage/' . $promo->file_brosur) }}"
             download target="_blank"
             class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                    border border-white/20 text-white font-bold uppercase
                    text-xs tracking-wider px-8 py-4
                    hover:border-white hover:bg-white/5 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Download Brosur
          </a>
          @endif
        </div>

      </div>
    </div>
  </section>

  {{-- KEMBALI --}}
  <div class="bg-white border-t border-gray-100 py-5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <a href="{{ route('promos.index') }}"
         class="inline-flex items-center gap-2 text-gray-400 text-sm
                hover:text-red-600 transition-colors group">
        <svg class="w-3.5 h-3.5 group-hover:-translate-x-1 transition-transform"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Lihat Promo Lainnya
      </a>
    </div>
  </div>

</div>
@endsection

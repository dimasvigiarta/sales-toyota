@extends('layouts.app')
@section('title', $promo->judul_promo . ' – Rama Toyota Jember')

@section('content')
<div class="pt-16 lg:pt-20">

  {{-- HEADER --}}
  <div class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <a href="{{ route('promos.index') }}"
         class="inline-flex items-center gap-2 text-gray-400 hover:text-white
                text-sm transition-colors mb-6">
        &larr; Kembali ke Promo
      </a>
      @if($promo->sisa_hari !== null)
      <div class="mb-4">
        <span class="bg-red-600 text-white font-bold text-xs uppercase tracking-wider px-3 py-1">
          @if($promo->sisa_hari === 0)
            Berakhir Hari Ini
          @else
            Sisa {{ $promo->sisa_hari }} Hari
          @endif
        </span>
      </div>
      @endif
      <h1 class="font-bold text-4xl lg:text-5xl uppercase leading-tight">
        {{ $promo->judul_promo }}
      </h1>
      @if($promo->tanggal_berakhir)
      <p class="text-gray-400 text-sm mt-4">
        Berlaku hingga: {{ $promo->tanggal_berakhir->format('d F Y') }}
      </p>
      @endif
    </div>
  </div>

  {{-- KONTEN --}}
  <section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- Banner --}}
      @if($promo->gambar_banner)
      <div class="mb-10 overflow-hidden">
        <img src="{{ asset('storage/' . $promo->gambar_banner) }}"
             alt="{{ $promo->judul_promo }}"
             class="w-full object-cover">
      </div>
      @endif

      {{-- Konten HTML --}}
      <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
        {!! $promo->konten !!}
      </div>

      {{-- CTA --}}
      <div class="mt-12 p-8 bg-gray-900 text-white text-center">
        <p class="font-bold text-2xl uppercase mb-2">Tertarik dengan promo ini?</p>
        <p class="text-gray-400 text-sm mb-6">Hubungi sales kami sekarang sebelum kehabisan.</p>
        <button onclick="document.querySelector('[x-data*=fetchContacts]').__x.$data.fetchContacts()"
                class="bg-red-600 text-white font-semibold uppercase text-sm
                       tracking-wide px-8 py-4 hover:bg-red-700 transition-colors">
          Hubungi Sales Sekarang
        </button>
      </div>

      {{-- Kembali --}}
      <div class="mt-8 text-center">
        <a href="{{ route('promos.index') }}"
           class="text-gray-400 text-sm hover:text-red-600 transition-colors">
          &larr; Lihat Promo Lainnya
        </a>
      </div>

    </div>
  </section>

</div>
@endsection
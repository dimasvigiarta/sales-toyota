@extends('layouts.admin')
@section('title', 'Dashboard')

@section('admin_content')

{{-- WELCOME --}}
<div class="mb-8">
  <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Panel Admin</p>
  <h2 class="text-2xl font-black text-gray-900 tracking-tight">Selamat Datang</h2>
  <p class="text-sm text-gray-400 mt-1">
    {{ now()->translatedFormat('l, d F Y') }} &middot; {{ now()->format('H:i') }} WIB
  </p>
</div>

{{-- STAT CARDS --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

  <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm
              hover:shadow-md transition-shadow duration-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
        </svg>
      </div>
      <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
        Model
      </span>
    </div>
    <p class="text-3xl font-black text-gray-900 mb-1">{{ $stats['total_cars'] }}</p>
    <p class="text-xs text-gray-400 uppercase tracking-wide">Total Mobil</p>
  </div>

  <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm
              hover:shadow-md transition-shadow duration-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
      <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">
        Online
      </span>
    </div>
    <p class="text-3xl font-black text-gray-900 mb-1">{{ $stats['active_cars'] }}</p>
    <p class="text-xs text-gray-400 uppercase tracking-wide">Mobil Aktif</p>
  </div>

  <div class="bg-gradient-to-br from-red-600 to-red-700 rounded-2xl p-6 shadow-sm
              hover:shadow-md transition-shadow duration-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M7 7h.01M7 3h5l4.586 4.586a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-4-4a2 2 0 010-2.828L7 3z"/>
        </svg>
      </div>
      <span class="text-xs font-semibold text-white/80 bg-white/20 px-2 py-1 rounded-full">
        Aktif
      </span>
    </div>
    <p class="text-3xl font-black text-white mb-1">{{ $stats['active_promos'] }}</p>
    <p class="text-xs text-red-200 uppercase tracking-wide">Promo Berjalan</p>
  </div>

  <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm
              hover:shadow-md transition-shadow duration-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-yellow-50 flex items-center justify-center">
        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </div>
      <span class="text-xs font-semibold text-yellow-600 bg-yellow-50 px-2 py-1 rounded-full">
        Sales
      </span>
    </div>
    <p class="text-3xl font-black text-gray-900 mb-1">{{ $stats['total_contacts'] }}</p>
    <p class="text-xs text-gray-400 uppercase tracking-wide">Kontak Sales</p>
  </div>

</div>

{{-- TABEL --}}
<div class="grid lg:grid-cols-2 gap-6">

  {{-- MOBIL TERBARU --}}
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50">
      <div>
        <h3 class="font-bold text-sm text-gray-900">Mobil Terbaru</h3>
        <p class="text-xs text-gray-400 mt-0.5">{{ $stats['total_cars'] }} model terdaftar</p>
      </div>
      <a href="{{ route('admin.cars.index') }}"
         class="text-xs text-red-600 font-semibold hover:underline">
        Lihat semua →
      </a>
    </div>

    @if($recentCars->isEmpty())
    <div class="px-6 py-12 text-center">
      <p class="text-gray-400 text-sm">Belum ada data mobil.</p>
      <a href="{{ route('admin.cars.create') }}"
         class="inline-block mt-3 text-xs text-red-600 font-semibold hover:underline">
        Tambah mobil pertama
      </a>
    </div>
    @else
    <div class="divide-y divide-gray-50">
      @foreach($recentCars as $car)
      <div class="px-6 py-3 flex items-center justify-between
                  hover:bg-gray-50/70 transition-colors group">
        <div class="flex items-center gap-3">
          @if($car->thumbnail)
          <img src="{{ $car->thumbnail }}" alt="{{ $car->nama_mobil }}"
               class="w-12 h-8 object-cover rounded-lg bg-gray-100 flex-shrink-0">
          @else
          <div class="w-12 h-8 bg-gray-100 rounded-lg flex-shrink-0"></div>
          @endif
          <div>
            <p class="font-semibold text-sm text-gray-900 group-hover:text-red-600
                      transition-colors leading-tight">{{ $car->nama_mobil }}</p>
            <p class="text-xs text-gray-400 mt-0.5">
              {{ $car->kategori }} &middot; {{ $car->harga_format }}
            </p>
          </div>
        </div>
        <div class="flex items-center gap-3 flex-shrink-0">
          <span class="text-xs font-medium px-2 py-1 rounded-full
                       {{ $car->is_active
                         ? 'text-green-700 bg-green-50'
                         : 'text-gray-400 bg-gray-100' }}">
            {{ $car->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
          <a href="{{ route('admin.cars.edit', $car) }}"
             class="text-xs text-gray-400 hover:text-red-600 font-semibold transition-colors">
            Edit
          </a>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

  {{-- PROMO AKTIF --}}
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50">
      <div>
        <h3 class="font-bold text-sm text-gray-900">Promo Aktif</h3>
        <p class="text-xs text-gray-400 mt-0.5">{{ $stats['active_promos'] }} promo berjalan</p>
      </div>
      <a href="{{ route('admin.promos.index') }}"
         class="text-xs text-red-600 font-semibold hover:underline">
        Lihat semua →
      </a>
    </div>

    @if($activePromos->isEmpty())
    <div class="px-6 py-12 text-center">
      <p class="text-gray-400 text-sm">Belum ada promo aktif.</p>
      <a href="{{ route('admin.promos.create') }}"
         class="inline-block mt-3 text-xs text-red-600 font-semibold hover:underline">
        Buat promo pertama
      </a>
    </div>
    @else
    <div class="divide-y divide-gray-50">
      @foreach($activePromos as $promo)
      <div class="px-6 py-3.5 flex items-center justify-between
                  hover:bg-gray-50/70 transition-colors group">
        <div class="flex-1 min-w-0 mr-4">
          <p class="font-semibold text-sm text-gray-900 group-hover:text-red-600
                    transition-colors truncate">{{ $promo->judul_promo }}</p>
          <p class="text-xs mt-0.5">
            @if($promo->tanggal_berakhir)
              @if($promo->sisa_hari <= 3)
              <span class="text-red-500 font-semibold">Sisa {{ $promo->sisa_hari }} hari</span>
              @elseif($promo->sisa_hari <= 7)
              <span class="text-yellow-600 font-semibold">Sisa {{ $promo->sisa_hari }} hari</span>
              @else
              <span class="text-gray-400">
                Berakhir {{ $promo->tanggal_berakhir->format('d M Y') }}
              </span>
              @endif
            @else
            <span class="text-gray-400">Tidak ada batas waktu</span>
            @endif
          </p>
        </div>
        <a href="{{ route('admin.promos.edit', $promo) }}"
           class="text-xs text-gray-400 hover:text-red-600 font-semibold
                  transition-colors flex-shrink-0">
          Edit
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>

</div>

@endsection

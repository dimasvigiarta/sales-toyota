@extends('layouts.admin')
@section('title', 'Dashboard')

@section('admin_content')

{{-- STAT CARDS --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  <div class="bg-white border-l-4 border-blue-500 p-5 shadow-sm">
    <div class="flex items-center justify-between mb-2">
      <span class="text-gray-400 text-xs uppercase tracking-wide">Total Mobil</span>
      <span class="font-bold text-3xl text-gray-900">{{ $stats['total_cars'] }}</span>
    </div>
    <p class="text-gray-400 text-xs">Semua data mobil</p>
  </div>
  <div class="bg-white border-l-4 border-green-500 p-5 shadow-sm">
    <div class="flex items-center justify-between mb-2">
      <span class="text-gray-400 text-xs uppercase tracking-wide">Mobil Aktif</span>
      <span class="font-bold text-3xl text-gray-900">{{ $stats['active_cars'] }}</span>
    </div>
    <p class="text-gray-400 text-xs">Tampil di website</p>
  </div>
  <div class="bg-white border-l-4 border-red-500 p-5 shadow-sm">
    <div class="flex items-center justify-between mb-2">
      <span class="text-gray-400 text-xs uppercase tracking-wide">Promo Aktif</span>
      <span class="font-bold text-3xl text-gray-900">{{ $stats['active_promos'] }}</span>
    </div>
    <p class="text-gray-400 text-xs">Promo berjalan</p>
  </div>
  <div class="bg-white border-l-4 border-yellow-500 p-5 shadow-sm">
    <div class="flex items-center justify-between mb-2">
      <span class="text-gray-400 text-xs uppercase tracking-wide">Kontak Sales</span>
      <span class="font-bold text-3xl text-gray-900">{{ $stats['total_contacts'] }}</span>
    </div>
    <p class="text-gray-400 text-xs">Sales aktif</p>
  </div>
</div>

{{-- TABEL --}}
<div class="grid lg:grid-cols-2 gap-6">

  {{-- MOBIL TERBARU --}}
  <div class="bg-white shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
      <h3 class="font-bold uppercase text-sm tracking-wide text-gray-900">Mobil Terbaru</h3>
      <a href="{{ route('admin.cars.create') }}"
         class="text-xs bg-red-600 text-white px-3 py-1.5 font-semibold hover:bg-red-700 transition-colors">
        + Tambah
      </a>
    </div>
    @if($recentCars->isEmpty())
    <div class="px-6 py-8 text-center text-gray-400 text-sm">
      Belum ada data mobil.
    </div>
    @else
    <div class="divide-y divide-gray-50">
      @foreach($recentCars as $car)
      <div class="px-6 py-3 flex items-center justify-between">
        <div>
          <p class="font-semibold text-sm text-gray-900">{{ $car->nama_mobil }}</p>
          <p class="text-xs text-gray-400">{{ $car->kategori }} &middot; {{ $car->harga_format }}</p>
        </div>
        <div class="flex items-center gap-3">
          <span class="text-xs px-2 py-0.5
                       {{ $car->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
            {{ $car->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
          <a href="{{ route('admin.cars.edit', $car) }}"
             class="text-xs text-red-600 hover:underline font-semibold">
            Edit
          </a>
        </div>
      </div>
      @endforeach
    </div>
    <div class="px-6 py-3 border-t border-gray-100">
      <a href="{{ route('admin.cars.index') }}"
         class="text-xs text-red-600 hover:underline font-semibold">
        Lihat semua mobil
      </a>
    </div>
    @endif
  </div>

  {{-- PROMO AKTIF --}}
  <div class="bg-white shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
      <h3 class="font-bold uppercase text-sm tracking-wide text-gray-900">Promo Aktif</h3>
      <a href="{{ route('admin.promos.create') }}"
         class="text-xs bg-red-600 text-white px-3 py-1.5 font-semibold hover:bg-red-700 transition-colors">
        + Tambah
      </a>
    </div>
    @if($activePromos->isEmpty())
    <div class="px-6 py-8 text-center text-gray-400 text-sm">
      Belum ada promo aktif.
    </div>
    @else
    <div class="divide-y divide-gray-50">
      @foreach($activePromos as $promo)
      <div class="px-6 py-3 flex items-center justify-between">
        <div>
          <p class="font-semibold text-sm text-gray-900">{{ $promo->judul_promo }}</p>
          <p class="text-xs text-gray-400">
            @if($promo->tanggal_berakhir)
              Berakhir: {{ $promo->tanggal_berakhir->format('d M Y') }}
              @if($promo->sisa_hari <= 3)
              &mdash; <span class="text-red-600 font-semibold">Sisa {{ $promo->sisa_hari }} hari</span>
              @endif
            @else
              Tidak ada batas waktu
            @endif
          </p>
        </div>
        <a href="{{ route('admin.promos.edit', $promo) }}"
           class="text-xs text-red-600 hover:underline font-semibold">
          Edit
        </a>
      </div>
      @endforeach
    </div>
    <div class="px-6 py-3 border-t border-gray-100">
      <a href="{{ route('admin.promos.index') }}"
         class="text-xs text-red-600 hover:underline font-semibold">
        Lihat semua promo
      </a>
    </div>
    @endif
  </div>

</div>
@endsection
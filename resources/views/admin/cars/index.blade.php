@extends('layouts.admin')
@section('title', 'Manajemen Mobil')

@section('admin_content')

{{-- HEADER --}}
<div class="flex items-end justify-between mb-8">
  <div>
    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Daftar Mobil</h2>
    <p class="text-sm text-gray-400 mt-1">{{ $cars->total() }} model terdaftar</p>
  </div>
  <a href="{{ route('admin.cars.create') }}"
     class="inline-flex items-center gap-2 bg-red-600 text-white font-bold
            uppercase text-xs tracking-wider px-5 py-3
            hover:bg-red-700 transition-colors">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>
    Tambah Mobil
  </a>
</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full">
    <thead>
      <tr class="border-b border-gray-100 bg-gray-50">
        <th class="text-left px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
          Mobil
        </th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">
          Kategori
        </th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">
          Harga
        </th>
        <th class="text-center px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden lg:table-cell">
          Foto
        </th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">
          Status
        </th>
        <th class="text-right px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
          Aksi
        </th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      @forelse($cars as $car)
      <tr class="hover:bg-gray-50/70 transition-colors group">

        {{-- Mobil --}}
        <td class="px-6 py-4">
          <div class="flex items-center gap-3">
            @if($car->thumbnail)
            <img src="{{ $car->thumbnail }}" alt="{{ $car->nama_mobil }}"
                 class="w-14 h-10 object-cover rounded-xl bg-gray-100 flex-shrink-0">
            @else
            <div class="w-14 h-10 bg-gray-100 rounded-xl flex-shrink-0
                        flex items-center justify-center">
              <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            @endif
            <div>
              <p class="font-bold text-sm text-gray-900 group-hover:text-red-600
                        transition-colors">{{ $car->nama_mobil }}</p>
              <p class="text-xs text-gray-400 mt-0.5">{{ $car->slug }}</p>
            </div>
          </div>
        </td>

        {{-- Kategori --}}
        <td class="px-4 py-4 hidden md:table-cell">
          <span class="text-xs font-bold text-gray-600 bg-gray-100 px-2.5 py-1 rounded-full">
            {{ $car->kategori }}
          </span>
        </td>

        {{-- Harga --}}
        <td class="px-4 py-4 hidden md:table-cell">
          <p class="text-sm font-bold text-gray-900">{{ $car->harga_format }}</p>
        </td>

        {{-- Foto --}}
        <td class="px-4 py-4 hidden lg:table-cell text-center">
          <span class="text-sm text-gray-500 font-medium">{{ $car->images_count }}</span>
        </td>

        {{-- Status --}}
        <td class="px-4 py-4 hidden md:table-cell">
          <div class="flex flex-col gap-1.5">
            <span class="w-fit text-xs font-semibold px-2.5 py-1 rounded-full
                         {{ $car->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-400' }}">
              {{ $car->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
            @if($car->is_featured)
            <span class="w-fit text-xs font-semibold px-2.5 py-1 rounded-full
                         bg-yellow-50 text-yellow-700">
              Unggulan
            </span>
            @endif
          </div>
        </td>

        {{-- Aksi --}}
        <td class="px-6 py-4">
          <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.cars.edit', $car) }}"
               class="text-xs font-bold text-red-600 hover:text-red-700 transition-colors">
              Edit
            </a>
            <a href="{{ route('cars.show', $car->slug) }}" target="_blank"
               class="text-xs font-semibold text-gray-400 hover:text-gray-700 transition-colors">
              Lihat
            </a>
            <form method="POST" action="{{ route('admin.cars.destroy', $car) }}"
                  onsubmit="return confirm('Hapus mobil ini? Semua foto akan ikut terhapus.')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="text-xs font-semibold text-gray-400 hover:text-red-600 transition-colors">
                Hapus
              </button>
            </form>
          </div>
        </td>

      </tr>
      @empty
      <tr>
        <td colspan="6" class="px-6 py-16 text-center">
          <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
          </div>
          <p class="text-gray-400 text-sm mb-3">Belum ada data mobil.</p>
          <a href="{{ route('admin.cars.create') }}"
             class="text-xs text-red-600 font-bold hover:underline">
            Tambah mobil pertama
          </a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  @if($cars->hasPages())
  <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
    {{ $cars->links() }}
  </div>
  @endif
</div>

@endsection

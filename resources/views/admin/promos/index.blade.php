@extends('layouts.admin')
@section('title', 'Manajemen Promo')

@section('admin_content')

{{-- HEADER --}}
<div class="flex items-end justify-between mb-8">
  <div>
    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Daftar Promo</h2>
    <p class="text-sm text-gray-400 mt-1">{{ $promos->total() }} promo terdaftar</p>
  </div>
  <a href="{{ route('admin.promos.create') }}"
     class="inline-flex items-center gap-2 bg-red-600 text-white font-bold
            uppercase text-xs tracking-wider px-5 py-3
            hover:bg-red-700 transition-colors">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>
    Tambah Promo
  </a>
</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full">
    <thead>
      <tr class="border-b border-gray-100 bg-gray-50">
        <th class="text-left px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
          Promo
        </th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">
          Berakhir
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
      @forelse($promos as $promo)
      <tr class="hover:bg-gray-50/70 transition-colors group">

        {{-- Promo --}}
        <td class="px-6 py-4">
          <div class="flex items-center gap-3">
            @if($promo->gambar_banner)
            <img src="{{ asset('storage/' . $promo->gambar_banner) }}"
                 alt="{{ $promo->judul_promo }}"
                 class="w-14 h-10 object-cover rounded-xl bg-gray-100 flex-shrink-0">
            @else
            <div class="w-14 h-10 bg-gray-100 rounded-xl flex-shrink-0
                        flex items-center justify-center">
              <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M7 7h.01M7 3h5l4.586 4.586a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-4-4a2 2 0 010-2.828L7 3z"/>
              </svg>
            </div>
            @endif
            <div>
              <p class="font-bold text-sm text-gray-900 group-hover:text-red-600
                        transition-colors">{{ $promo->judul_promo }}</p>
              <p class="text-xs text-gray-400 mt-0.5">{{ $promo->slug }}</p>
            </div>
          </div>
        </td>

        {{-- Berakhir --}}
        <td class="px-4 py-4 hidden md:table-cell">
          @if($promo->tanggal_berakhir)
          <p class="text-sm text-gray-700 font-medium">
            {{ $promo->tanggal_berakhir->format('d M Y') }}
          </p>
          @if(!$promo->is_expired)
            @if($promo->sisa_hari <= 3)
            <span class="text-xs text-red-500 font-semibold">Sisa {{ $promo->sisa_hari }} hari</span>
            @elseif($promo->sisa_hari <= 7)
            <span class="text-xs text-yellow-600 font-semibold">Sisa {{ $promo->sisa_hari }} hari</span>
            @endif
          @endif
          @else
          <span class="text-xs text-gray-400">Tidak ada batas</span>
          @endif
        </td>

        {{-- Status --}}
        <td class="px-4 py-4 hidden md:table-cell">
          @if($promo->is_expired)
          <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-red-50 text-red-600">
            Kadaluarsa
          </span>
          @elseif($promo->is_active)
          <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-50 text-green-700">
            Aktif
          </span>
          @else
          <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-400">
            Nonaktif
          </span>
          @endif
        </td>

        {{-- Aksi --}}
        <td class="px-6 py-4">
          <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.promos.edit', $promo) }}"
               class="text-xs font-bold text-red-600 hover:text-red-700 transition-colors">
              Edit
            </a>
            <a href="{{ route('promos.show', $promo->slug) }}" target="_blank"
               class="text-xs font-semibold text-gray-400 hover:text-gray-700 transition-colors">
              Lihat
            </a>
            <form method="POST" action="{{ route('admin.promos.destroy', $promo) }}"
                  onsubmit="return confirm('Hapus promo ini?')">
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
        <td colspan="4" class="px-6 py-16 text-center">
          <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M7 7h.01M7 3h5l4.586 4.586a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-4-4a2 2 0 010-2.828L7 3z"/>
            </svg>
          </div>
          <p class="text-gray-400 text-sm mb-3">Belum ada data promo.</p>
          <a href="{{ route('admin.promos.create') }}"
             class="text-xs text-red-600 font-bold hover:underline">
            Tambah promo pertama
          </a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  @if($promos->hasPages())
  <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
    {{ $promos->links() }}
  </div>
  @endif
</div>

@endsection

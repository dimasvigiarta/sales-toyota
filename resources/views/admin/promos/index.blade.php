@extends('layouts.admin')
@section('title', 'Manajemen Promo')

@section('admin_content')

<div class="flex items-center justify-between mb-6">
  <p class="text-gray-500 text-sm">Total: <strong class="text-gray-900">{{ $promos->total() }}</strong> promo</p>
  <a href="{{ route('admin.promos.create') }}"
     class="bg-red-600 text-white font-semibold text-sm uppercase tracking-wide
            px-5 py-2.5 hover:bg-red-700 transition-colors">
    + Tambah Promo
  </a>
</div>

<div class="bg-white shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-gray-50 border-b border-gray-200">
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Promo</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs hidden md:table-cell">Berakhir</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Status</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @forelse($promos as $promo)
      <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-6 py-4">
          <p class="font-semibold text-gray-900">{{ $promo->judul_promo }}</p>
          <p class="text-xs text-gray-400 mt-0.5">{{ $promo->slug }}</p>
        </td>
        <td class="px-6 py-4 hidden md:table-cell text-gray-500 text-sm">
          @if($promo->tanggal_berakhir)
            {{ $promo->tanggal_berakhir->format('d M Y') }}
            @if($promo->sisa_hari <= 3 && !$promo->is_expired)
            <span class="ml-1 text-xs text-red-600 font-semibold">
              (Sisa {{ $promo->sisa_hari }} hari)
            </span>
            @endif
          @else
            <span class="text-gray-400">Tidak ada batas</span>
          @endif
        </td>
        <td class="px-6 py-4">
          @if($promo->is_expired)
            <span class="text-xs px-2 py-0.5 bg-red-100 text-red-700">Kadaluarsa</span>
          @elseif($promo->is_active)
            <span class="text-xs px-2 py-0.5 bg-green-100 text-green-700">Aktif</span>
          @else
            <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-500">Nonaktif</span>
          @endif
        </td>
        <td class="px-6 py-4">
          <div class="flex items-center gap-3">
            <a href="{{ route('admin.promos.edit', $promo) }}"
               class="text-xs text-red-600 hover:underline font-semibold">
              Edit
            </a>
            <a href="{{ route('promos.show', $promo->slug) }}" target="_blank"
               class="text-xs text-gray-400 hover:text-gray-700 font-semibold">
              Lihat
            </a>
            <form method="POST" action="{{ route('admin.promos.destroy', $promo) }}"
                  onsubmit="return confirm('Hapus promo ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="text-xs text-gray-400 hover:text-red-600 font-semibold transition-colors">
                Hapus
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
          Belum ada data promo.
          <a href="{{ route('admin.promos.create') }}" class="text-red-600 hover:underline ml-1">Tambah sekarang</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  @if($promos->hasPages())
  <div class="px-6 py-4 border-t border-gray-100">
    {{ $promos->links() }}
  </div>
  @endif
</div>

@endsection
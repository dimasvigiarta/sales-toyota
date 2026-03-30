@extends('layouts.admin')
@section('title', 'Manajemen Mobil')

@section('admin_content')

<div class="flex items-center justify-between mb-6">
  <p class="text-gray-500 text-sm">Total: <strong class="text-gray-900">{{ $cars->total() }}</strong> mobil</p>
  <a href="{{ route('admin.cars.create') }}"
     class="bg-red-600 text-white font-semibold text-sm uppercase tracking-wide
            px-5 py-2.5 hover:bg-red-700 transition-colors">
    + Tambah Mobil
  </a>
</div>

<div class="bg-white shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-gray-50 border-b border-gray-200">
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Mobil</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs hidden md:table-cell">Kategori</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs hidden md:table-cell">Harga</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs hidden lg:table-cell">Foto</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Status</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @forelse($cars as $car)
      <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-6 py-4">
          <p class="font-semibold text-gray-900">{{ $car->nama_mobil }}</p>
          <p class="text-xs text-gray-400 mt-0.5">{{ $car->slug }}</p>
        </td>
        <td class="px-6 py-4 hidden md:table-cell">
          <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-2 py-1 uppercase">
            {{ $car->kategori }}
          </span>
        </td>
        <td class="px-6 py-4 hidden md:table-cell text-gray-700 font-semibold">
          {{ $car->harga_format }}
        </td>
        <td class="px-6 py-4 hidden lg:table-cell text-gray-500">
          {{ $car->images_count }} foto
        </td>
        <td class="px-6 py-4">
          <div class="flex flex-col gap-1">
            <span class="text-xs px-2 py-0.5 w-fit
                         {{ $car->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
              {{ $car->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
            @if($car->is_featured)
            <span class="text-xs px-2 py-0.5 w-fit bg-yellow-100 text-yellow-700">
              Unggulan
            </span>
            @endif
          </div>
        </td>
        <td class="px-6 py-4">
          <div class="flex items-center gap-3">
            <a href="{{ route('admin.cars.edit', $car) }}"
               class="text-xs text-red-600 hover:underline font-semibold">
              Edit
            </a>
            <a href="{{ route('cars.show', $car->slug) }}" target="_blank"
               class="text-xs text-gray-400 hover:text-gray-700 font-semibold">
              Lihat
            </a>
            <form method="POST" action="{{ route('admin.cars.destroy', $car) }}"
                  onsubmit="return confirm('Hapus mobil ini? Semua foto akan ikut terhapus.')">
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
        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
          Belum ada data mobil.
          <a href="{{ route('admin.cars.create') }}" class="text-red-600 hover:underline ml-1">Tambah sekarang</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  @if($cars->hasPages())
  <div class="px-6 py-4 border-t border-gray-100">
    {{ $cars->links() }}
  </div>
  @endif
</div>

@endsection
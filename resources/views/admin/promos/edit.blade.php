@extends('layouts.admin')
@section('title', 'Edit Promo – ' . $promo->judul_promo)

@section('admin_content')

<div class="mb-6">
  <a href="{{ route('admin.promos.index') }}"
     class="text-sm text-gray-400 hover:text-gray-700 transition-colors">
    &larr; Kembali ke Daftar Promo
  </a>
</div>

<form method="POST" action="{{ route('admin.promos.update', $promo) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="grid lg:grid-cols-3 gap-6">

    {{-- FORM UTAMA --}}
    <div class="lg:col-span-2 space-y-5">

      <div class="bg-white p-6 shadow-sm space-y-4">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3">
          Informasi Promo
        </h3>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Judul Promo *
          </label>
          <input type="text" name="judul_promo" required
                 value="{{ old('judul_promo', $promo->judul_promo) }}"
                 class="w-full border border-gray-200 px-4 py-2.5 text-sm
                        focus:outline-none focus:border-red-600 transition-colors">
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Tanggal Berakhir
          </label>
          <input type="date" name="tanggal_berakhir"
                 value="{{ old('tanggal_berakhir', $promo->tanggal_berakhir?->format('Y-m-d')) }}"
                 class="w-full border border-gray-200 px-4 py-2.5 text-sm
                        focus:outline-none focus:border-red-600 transition-colors">
        </div>

        {{-- Banner saat ini --}}
        @if($promo->gambar_banner)
        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-2">
            Banner Saat Ini
          </label>
          <img src="{{ asset('storage/' . $promo->gambar_banner) }}"
               alt="{{ $promo->judul_promo }}"
               class="w-full max-h-48 object-cover mb-2">
        </div>
        @endif

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            {{ $promo->gambar_banner ? 'Ganti Gambar Banner' : 'Gambar Banner' }}
          </label>
          <input type="file" name="gambar_banner" accept="image/*"
                 class="w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4 file:border-0
                        file:text-xs file:font-semibold file:uppercase
                        file:bg-gray-900 file:text-white
                        hover:file:bg-gray-700 cursor-pointer">
          <p class="text-xs text-gray-400 mt-1">Maksimal 3MB. Kosongkan jika tidak ingin mengganti.</p>
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Konten Promo *
          </label>
          <textarea name="konten" rows="10" required
                    class="w-full border border-gray-200 px-4 py-2.5 text-sm
                           focus:outline-none focus:border-red-600 transition-colors resize-none">{{ old('konten', $promo->konten) }}</textarea>
          <p class="text-xs text-gray-400 mt-1">Mendukung tag HTML dasar.</p>
        </div>
      </div>

    </div>

    {{-- SIDEBAR --}}
    <div class="space-y-5">

      <div class="bg-white p-6 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
          Publikasi
        </h3>
        <label class="flex items-center gap-3 cursor-pointer mb-6">
          <input type="checkbox" name="is_active" value="1"
                 {{ old('is_active', $promo->is_active) ? 'checked' : '' }}
                 class="w-4 h-4 accent-red-600">
          <div>
            <p class="text-sm font-medium text-gray-900">Aktif</p>
            <p class="text-xs text-gray-400">Tampil di website</p>
          </div>
        </label>

        <div class="space-y-2">
          <button type="submit"
                  class="w-full bg-red-600 text-white font-semibold uppercase text-sm
                         tracking-wide py-3 hover:bg-red-700 transition-colors">
            Simpan Perubahan
          </button>
          <a href="{{ route('admin.promos.index') }}"
             class="block text-center text-sm text-gray-400 hover:text-gray-700 py-2 transition-colors">
            Batal
          </a>
        </div>
      </div>

      {{-- INFO --}}
      <div class="bg-white p-6 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
          Info Promo
        </h3>
        <dl class="space-y-3 text-sm">
          <div>
            <dt class="text-xs text-gray-400 uppercase tracking-wide">Slug</dt>
            <dd class="font-mono text-xs text-gray-700 mt-0.5">{{ $promo->slug }}</dd>
          </div>
          <div>
            <dt class="text-xs text-gray-400 uppercase tracking-wide">Dibuat</dt>
            <dd class="text-gray-700 mt-0.5">{{ $promo->created_at->format('d M Y') }}</dd>
          </div>
          <div>
            <dt class="text-xs text-gray-400 uppercase tracking-wide">Status</dt>
            <dd class="mt-0.5">
              @if($promo->is_expired)
                <span class="text-xs px-2 py-0.5 bg-red-100 text-red-700">Kadaluarsa</span>
              @elseif($promo->is_active)
                <span class="text-xs px-2 py-0.5 bg-green-100 text-green-700">Aktif</span>
              @else
                <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-500">Nonaktif</span>
              @endif
            </dd>
          </div>
        </dl>
        <div class="mt-4 pt-4 border-t border-gray-100">
          <a href="{{ route('promos.show', $promo->slug) }}" target="_blank"
             class="block text-center text-xs font-semibold uppercase tracking-wide
                    border border-gray-200 py-2 text-gray-500
                    hover:border-red-600 hover:text-red-600 transition-colors">
            Lihat di Website
          </a>
        </div>
      </div>

      {{-- HAPUS --}}
      <div class="bg-white p-6 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-wide text-red-600 border-b border-gray-100 pb-3 mb-4">
          Hapus Promo
        </h3>
        <p class="text-xs text-gray-400 mb-4">
          Promo yang dihapus tidak dapat dikembalikan.
        </p>
        <form method="POST" action="{{ route('admin.promos.destroy', $promo) }}"
              onsubmit="return confirm('Hapus promo ini secara permanen?')">
          @csrf
          @method('DELETE')
          <button type="submit"
                  class="w-full border-2 border-red-600 text-red-600 font-semibold
                         uppercase text-xs tracking-wide py-2.5
                         hover:bg-red-600 hover:text-white transition-colors">
            Hapus Promo Ini
          </button>
        </form>
      </div>

    </div>

  </div>

</form>

@endsection
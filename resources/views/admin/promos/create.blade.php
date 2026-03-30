@extends('layouts.admin')
@section('title', 'Tambah Promo Baru')

@section('admin_content')

<div class="mb-6">
  <a href="{{ route('admin.promos.index') }}"
     class="text-sm text-gray-400 hover:text-gray-700 transition-colors">
    &larr; Kembali ke Daftar Promo
  </a>
</div>

<form method="POST" action="{{ route('admin.promos.store') }}" enctype="multipart/form-data">
  @csrf

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
                 value="{{ old('judul_promo') }}"
                 placeholder="Contoh: DP Ringan Mulai 20 Juta"
                 class="w-full border border-gray-200 px-4 py-2.5 text-sm
                        focus:outline-none focus:border-red-600 transition-colors">
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Tanggal Berakhir
          </label>
          <input type="date" name="tanggal_berakhir"
                 value="{{ old('tanggal_berakhir') }}"
                 class="w-full border border-gray-200 px-4 py-2.5 text-sm
                        focus:outline-none focus:border-red-600 transition-colors">
          <p class="text-xs text-gray-400 mt-1">Kosongkan jika promo tidak ada batas waktu.</p>
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Gambar Banner
          </label>
          <input type="file" name="gambar_banner" accept="image/*"
                 class="w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4 file:border-0
                        file:text-xs file:font-semibold file:uppercase
                        file:bg-gray-900 file:text-white
                        hover:file:bg-gray-700 cursor-pointer">
          <p class="text-xs text-gray-400 mt-1">Maksimal 3MB. Format: JPG, PNG, WebP.</p>
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Konten Promo *
          </label>
          <textarea name="konten" rows="10" required
                    placeholder="Tulis detail informasi promo di sini. Mendukung HTML."
                    class="w-full border border-gray-200 px-4 py-2.5 text-sm
                           focus:outline-none focus:border-red-600 transition-colors resize-none">{{ old('konten') }}</textarea>
          <p class="text-xs text-gray-400 mt-1">Mendukung tag HTML dasar seperti &lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt;.</p>
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
                 {{ old('is_active', '1') ? 'checked' : '' }}
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
            Simpan Promo
          </button>
          <a href="{{ route('admin.promos.index') }}"
             class="block text-center text-sm text-gray-400 hover:text-gray-700 py-2 transition-colors">
            Batal
          </a>
        </div>
      </div>
    </div>

  </div>

</form>

@endsection
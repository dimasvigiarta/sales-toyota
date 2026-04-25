@extends('layouts.admin')
@section('title', 'Tambah Promo Baru')

@section('admin_content')

{{-- PAGE HEADER --}}
<div class="flex items-start justify-between mb-6">
  <div>
    <a href="{{ route('admin.promos.index') }}"
       class="inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-gray-400 hover:text-red-600 transition-colors mb-2">
      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
      </svg>
      Kembali ke Daftar Promo
    </a>
    <h1 class="text-2xl font-bold text-gray-900 leading-tight">Tambah Promo Baru</h1>
    <p class="text-sm text-gray-400 mt-0.5">Isi informasi promo yang akan ditampilkan di website.</p>
  </div>
</div>

<form method="POST" action="{{ route('admin.promos.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="grid lg:grid-cols-3 gap-6">

    {{-- KOLOM KIRI --}}
    <div class="lg:col-span-2 space-y-5">

      {{-- Informasi Promo --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Informasi Promo</h3>
        </div>
        <div class="p-6 space-y-5">

          {{-- Judul --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Judul Promo <span class="text-red-500">*</span>
            </label>
            <input type="text" name="judul_promo" required
                   value="{{ old('judul_promo') }}"
                   placeholder="Contoh: DP Ringan Mulai 20 Juta"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
          </div>

          {{-- Tanggal Berakhir --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Tanggal Berakhir
            </label>
            <input type="date" name="tanggal_berakhir"
                   value="{{ old('tanggal_berakhir') }}"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
            <p class="text-xs text-gray-400 mt-1.5">Kosongkan jika promo tidak ada batas waktu.</p>
          </div>

        </div>
      </div>

      {{-- Gambar / Brosur --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Gambar / File Brosur</h3>
        </div>
        <div class="p-6">
          <div class="bg-gray-50 border border-gray-200 p-4 mb-4">
            <div class="flex items-start gap-3">
              <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <p class="text-xs text-gray-600 leading-relaxed">
                Upload 1 file — otomatis ditampilkan sebagai <strong>banner</strong> di halaman promo
                sekaligus bisa <strong>didownload</strong> pengunjung sebagai brosur.
                Format: JPG, PNG. Maksimal 5MB.
              </p>
            </div>
          </div>
          <div class="flex gap-2 items-center">
            <input type="file" name="gambar_banner" accept="image/*"
                   class="flex-1 text-sm text-gray-600 border border-gray-200 bg-white px-3 py-2 cursor-pointer
                          file:mr-3 file:py-1.5 file:px-4 file:border-0 file:rounded-none
                          file:text-xs file:font-bold file:uppercase file:tracking-wide
                          file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
          </div>
        </div>
      </div>

      {{-- Konten Promo --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Konten Promo</h3>
        </div>
        <div class="p-6">
          <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
            Isi Konten <span class="text-red-500">*</span>
          </label>
          <textarea name="konten" rows="12" required
                    placeholder="Tulis detail informasi promo di sini. Mendukung HTML."
                    class="w-full border border-gray-200 px-4 py-3 text-sm
                           focus:outline-none focus:border-red-600 transition-colors resize-none font-mono">{{ old('konten') }}</textarea>
          <p class="text-xs text-gray-400 mt-1.5">
            Mendukung tag HTML dasar seperti
            <code class="bg-gray-100 px-1 py-0.5 text-gray-600">&lt;p&gt;</code>,
            <code class="bg-gray-100 px-1 py-0.5 text-gray-600">&lt;strong&gt;</code>,
            <code class="bg-gray-100 px-1 py-0.5 text-gray-600">&lt;ul&gt;</code>,
            <code class="bg-gray-100 px-1 py-0.5 text-gray-600">&lt;li&gt;</code>.
          </p>
        </div>
      </div>

    </div>

    {{-- SIDEBAR --}}
    <div class="space-y-5">

      {{-- Publikasi --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Publikasi</h3>
        </div>
        <div class="px-6 pt-5 pb-4">
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', '1') ? 'checked' : '' }}
                   class="w-4 h-4 accent-red-600">
            <div>
              <p class="text-sm font-semibold text-gray-900">Aktif</p>
              <p class="text-xs text-gray-400">Tampil di website pengunjung</p>
            </div>
          </label>
        </div>
        <div class="px-6 pb-6 pt-4 border-t border-gray-100 space-y-2">
          <button type="submit"
                  class="w-full bg-red-600 text-white font-bold uppercase text-xs
                         tracking-widest py-3 hover:bg-red-700 transition-colors cursor-pointer">
            Simpan Promo
          </button>
          <a href="{{ route('admin.promos.index') }}"
             class="block w-full text-center border border-gray-200 text-gray-500
                    font-semibold uppercase text-xs tracking-widest py-3
                    hover:bg-gray-50 transition-colors">
            Batal
          </a>
        </div>
      </div>

      {{-- Panduan --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-gray-300 flex-shrink-0"></span>
          <h3 class="font-bold text-xs uppercase tracking-widest text-gray-600">Panduan</h3>
        </div>
        <ul class="px-6 py-5 space-y-3">
          <li class="flex items-start gap-2 text-xs text-gray-600">
            <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
            Judul promo wajib diisi dan akan tampil sebagai heading utama.
          </li>
          <li class="flex items-start gap-2 text-xs text-gray-600">
            <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
            Tanggal berakhir akan menampilkan hitung mundur sisa hari di halaman promo.
          </li>
          <li class="flex items-start gap-2 text-xs text-gray-600">
            <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
            1 file gambar berfungsi sekaligus sebagai banner dan brosur yang bisa didownload.
          </li>
          <li class="flex items-start gap-2 text-xs text-gray-600">
            <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
            Konten mendukung HTML untuk pemformatan teks yang lebih kaya.
          </li>
        </ul>
      </div>

    </div>

  </div>

</form>

@endsection

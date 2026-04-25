@extends('layouts.admin')
@section('title', 'Edit Promo – ' . $promo->judul_promo)

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
    <h1 class="text-2xl font-bold text-gray-900 leading-tight">Edit Promo</h1>
    <p class="text-sm text-gray-400 mt-0.5">{{ $promo->judul_promo }}</p>
  </div>
  <a href="{{ route('promos.show', $promo->slug) }}" target="_blank"
     class="inline-flex items-center gap-2 border border-gray-200 text-gray-500 text-xs font-semibold uppercase tracking-wide px-4 py-2.5 hover:border-red-600 hover:text-red-600 transition-colors mt-1">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
    </svg>
    Lihat di Website
  </a>
</div>

{{-- SUCCESS ALERT --}}
@if(session('success'))
<div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
  <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
  </svg>
  {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('admin.promos.update', $promo) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

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

          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Judul Promo <span class="text-red-500">*</span>
            </label>
            <input type="text" name="judul_promo" required
                   value="{{ old('judul_promo', $promo->judul_promo) }}"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Tanggal Berakhir
            </label>
            <input type="date" name="tanggal_berakhir"
                   value="{{ old('tanggal_berakhir', $promo->tanggal_berakhir?->format('Y-m-d')) }}"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
            <p class="text-xs text-gray-400 mt-1.5">Kosongkan jika promo tidak ada batas waktu.</p>
          </div>

        </div>
      </div>

      {{-- Gambar & Brosur --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Gambar & Brosur</h3>
        </div>
        <div class="p-6 space-y-4">

          <div class="bg-gray-50 border border-gray-200 p-4">
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

          @if($promo->gambar_banner)
          <div>
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Gambar Saat Ini</p>
            <img src="{{ asset('storage/' . $promo->gambar_banner) }}"
                 alt="{{ $promo->judul_promo }}"
                 class="w-full max-h-56 object-cover border border-gray-200">
          </div>
          @endif

          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              {{ $promo->gambar_banner ? 'Ganti Gambar / Brosur' : 'Upload Gambar / Brosur' }}
            </label>
            <div class="flex gap-2 items-center">
              <input type="file" name="gambar_banner" accept="image/*"
                     class="flex-1 text-sm text-gray-600 border border-gray-200 bg-white px-3 py-2 cursor-pointer
                            file:mr-3 file:py-1.5 file:px-4 file:border-0 file:rounded-none
                            file:text-xs file:font-bold file:uppercase file:tracking-wide
                            file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
            </div>
            <p class="text-xs text-gray-400 mt-1.5">Kosongkan jika tidak ingin mengganti.</p>
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
                    class="w-full border border-gray-200 px-4 py-3 text-sm
                           focus:outline-none focus:border-red-600 transition-colors resize-none font-mono">{{ old('konten', $promo->konten) }}</textarea>
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
                   {{ old('is_active', $promo->is_active) ? 'checked' : '' }}
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
            Simpan Perubahan
          </button>
          <a href="{{ route('admin.promos.index') }}"
             class="block w-full text-center border border-gray-200 text-gray-500
                    font-semibold uppercase text-xs tracking-widest py-3
                    hover:bg-gray-50 transition-colors">
            Batal
          </a>
        </div>
      </div>

      {{-- Info Promo --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-gray-300 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-600">Info Promo</h3>
        </div>
        <dl class="px-6 py-5 space-y-3">
          <div>
            <dt class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Slug</dt>
            <dd class="font-mono text-xs text-gray-600 break-all">{{ $promo->slug }}</dd>
          </div>
          <div>
            <dt class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Dibuat</dt>
            <dd class="text-xs text-gray-700">{{ $promo->created_at->format('d M Y') }}</dd>
          </div>
          <div>
            <dt class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Status</dt>
            <dd class="mt-1">
              @if($promo->is_expired)
                <span class="inline-block text-xs font-semibold px-2 py-0.5 bg-red-100 text-red-700 uppercase tracking-wide">Kadaluarsa</span>
              @elseif($promo->is_active)
                <span class="inline-block text-xs font-semibold px-2 py-0.5 bg-green-100 text-green-700 uppercase tracking-wide">Aktif</span>
              @else
                <span class="inline-block text-xs font-semibold px-2 py-0.5 bg-gray-100 text-gray-500 uppercase tracking-wide">Nonaktif</span>
              @endif
            </dd>
          </div>
        </dl>
      </div>

      {{-- Hapus Promo --}}
      <div class="bg-white shadow-sm border border-red-100">
        <div class="px-6 py-4 border-b border-red-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-red-600">Hapus Promo</h3>
        </div>
        <div class="px-6 py-5">
          <p class="text-xs text-gray-400 mb-4 leading-relaxed">
            Promo yang dihapus <strong class="text-gray-600">tidak dapat dikembalikan</strong>.
          </p>
          <button type="submit" form="delete-promo-form"
                  onclick="return confirm('Hapus promo ini secara permanen?')"
                  class="w-full border-2 border-red-600 text-red-600 font-bold uppercase
                         text-xs tracking-widest py-2.5 hover:bg-red-600 hover:text-white
                         transition-colors cursor-pointer">
            Hapus Promo Ini
          </button>
        </div>
      </div>

    </div>
  </div>

</form>

{{-- Form hapus standalone di luar form edit --}}
<form id="delete-promo-form"
      method="POST"
      action="{{ route('admin.promos.destroy', $promo) }}"
      style="display:none">
  @csrf
  @method('DELETE')
</form>

@endsection

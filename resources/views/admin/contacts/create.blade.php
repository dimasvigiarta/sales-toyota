@extends('layouts.admin')
@section('title', 'Tambah Kontak Sales')

@section('admin_content')

{{-- PAGE HEADER --}}
<div class="mb-6">
  <a href="{{ route('admin.contacts.index') }}"
     class="inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-gray-400 hover:text-red-600 transition-colors mb-2">
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
    </svg>
    Kembali ke Daftar Kontak
  </a>
  <h1 class="text-2xl font-bold text-gray-900 leading-tight">Tambah Kontak Sales</h1>
  <p class="text-sm text-gray-400 mt-0.5">Isi data sales yang akan tampil di popup WhatsApp website.</p>
</div>

<div class="grid lg:grid-cols-3 gap-6">

  {{-- KOLOM KIRI --}}
  <div class="lg:col-span-2">
    <form method="POST" action="{{ route('admin.contacts.store') }}">
      @csrf

      {{-- Informasi Sales --}}
      <div class="bg-white shadow-sm mb-5">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Informasi Sales</h3>
        </div>
        <div class="p-6 space-y-5">

          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Nama Sales <span class="text-red-500">*</span>
            </label>
            <input type="text" name="nama_sales" required
                   value="{{ old('nama_sales') }}"
                   placeholder="Contoh: Budi Santoso"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Wilayah <span class="text-red-500">*</span>
            </label>
            <select name="wilayah" required
                    class="w-full border border-gray-200 px-4 py-2.5 text-sm bg-white
                           focus:outline-none focus:border-red-600 transition-colors">
              @foreach(['Utara','Selatan','Barat','Timur','Pusat'] as $w)
              <option value="{{ $w }}" {{ old('wilayah') === $w ? 'selected' : '' }}>
                {{ $w }}
              </option>
              @endforeach
            </select>
          </div>

        </div>
      </div>

      {{-- WhatsApp --}}
      <div class="bg-white shadow-sm mb-5">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">WhatsApp</h3>
        </div>
        <div class="p-6 space-y-5">

          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Nomor WhatsApp <span class="text-red-500">*</span>
            </label>
            <input type="text" name="nomor_wa" required
                   value="{{ old('nomor_wa') }}"
                   placeholder="Contoh: 6281234567890"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
            <p class="text-xs text-gray-400 mt-1.5">
              Format internasional tanpa tanda +. Contoh: <span class="font-mono bg-gray-100 px-1 py-0.5 text-gray-600">6281234567890</span>
            </p>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
              Pesan Default WhatsApp
            </label>
            <textarea name="pesan_default" rows="3"
                      placeholder="Contoh: Halo, saya tertarik dengan Toyota. Boleh info lebih lanjut?"
                      class="w-full border border-gray-200 px-4 py-2.5 text-sm
                             focus:outline-none focus:border-red-600 transition-colors resize-none">{{ old('pesan_default') }}</textarea>
            <p class="text-xs text-gray-400 mt-1.5">
              Pesan ini akan otomatis terisi saat customer klik tombol WhatsApp.
            </p>
          </div>

        </div>
      </div>

      {{-- Publikasi --}}
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Publikasi</h3>
        </div>
        <div class="px-6 py-5">
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', '1') ? 'checked' : '' }}
                   class="w-4 h-4 accent-red-600">
            <div>
              <p class="text-sm font-semibold text-gray-900">Aktif</p>
              <p class="text-xs text-gray-400">Tampil di popup WhatsApp website</p>
            </div>
          </label>
        </div>
        <div class="px-6 pb-6 border-t border-gray-100 pt-4 flex gap-3">
          <button type="submit"
                  class="bg-red-600 text-white font-bold uppercase text-xs
                         tracking-widest px-6 py-3 hover:bg-red-700 transition-colors cursor-pointer">
            Simpan Kontak
          </button>
          <a href="{{ route('admin.contacts.index') }}"
             class="border border-gray-200 text-gray-500 font-semibold uppercase
                    text-xs tracking-widest px-6 py-3 hover:bg-gray-50 transition-colors">
            Batal
          </a>
        </div>
      </div>

    </form>
  </div>

  {{-- SIDEBAR --}}
  <div class="space-y-5">

    {{-- Panduan --}}
    <div class="bg-white shadow-sm">
      <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
        <span class="block w-1 h-5 bg-gray-300 flex-shrink-0"></span>
        <h3 class="font-bold text-xs uppercase tracking-widest text-gray-600">Panduan</h3>
      </div>
      <ul class="px-6 py-5 space-y-3">
        <li class="flex items-start gap-2 text-xs text-gray-600">
          <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
          Nama sales akan tampil sebagai label di popup WhatsApp.
        </li>
        <li class="flex items-start gap-2 text-xs text-gray-600">
          <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
          Wilayah membantu customer memilih sales terdekat.
        </li>
        <li class="flex items-start gap-2 text-xs text-gray-600">
          <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
          Nomor WA harus format internasional tanpa + dan tanpa spasi.
        </li>
        <li class="flex items-start gap-2 text-xs text-gray-600">
          <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
          Pesan default bersifat opsional. Jika kosong, customer akan mengetik sendiri.
        </li>
        <li class="flex items-start gap-2 text-xs text-gray-600">
          <span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span>
          Nonaktifkan sales jika sedang tidak bertugas tanpa harus menghapus data.
        </li>
      </ul>
    </div>

    {{-- Preview Format Nomor --}}
    <div class="bg-white shadow-sm">
      <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
        <span class="block w-1 h-5 bg-gray-300 flex-shrink-0"></span>
        <h3 class="font-bold text-xs uppercase tracking-widest text-gray-600">Contoh Format Nomor</h3>
      </div>
      <div class="px-6 py-5 space-y-3">
        <div class="flex items-center justify-between">
          <span class="text-xs text-red-500 font-semibold">Salah</span>
          <span class="font-mono text-xs bg-red-50 text-red-600 px-2 py-1">+62 812-3456-7890</span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-xs text-red-500 font-semibold">Salah</span>
          <span class="font-mono text-xs bg-red-50 text-red-600 px-2 py-1">08123456789</span>
        </div>
        <div class="border-t border-gray-100 pt-3 flex items-center justify-between">
          <span class="text-xs text-green-600 font-semibold">Benar</span>
          <span class="font-mono text-xs bg-green-50 text-green-700 px-2 py-1">6281234567890</span>
        </div>
      </div>
    </div>

  </div>

</div>

@endsection

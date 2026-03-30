@extends('layouts.admin')
@section('title', 'Tambah Mobil Baru')

@section('admin_content')

<div class="mb-6">
  <a href="{{ route('admin.cars.index') }}"
     class="text-sm text-gray-400 hover:text-gray-700 transition-colors">
    &larr; Kembali ke Daftar Mobil
  </a>
</div>

<form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="grid lg:grid-cols-3 gap-6">

    {{-- FORM UTAMA --}}
    <div class="lg:col-span-2 space-y-5">

      {{-- INFO DASAR --}}
      <div class="bg-white p-6 shadow-sm space-y-4">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3">
          Informasi Dasar
        </h3>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Nama Mobil *
          </label>
          <input type="text" name="nama_mobil" required
                 value="{{ old('nama_mobil') }}"
                 placeholder="Contoh: Toyota Avanza"
                 class="w-full border border-gray-200 px-4 py-2.5 text-sm
                        focus:outline-none focus:border-red-600 transition-colors">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
              Kategori *
            </label>
            <select name="kategori" required
                    class="w-full border border-gray-200 px-4 py-2.5 text-sm
                           focus:outline-none focus:border-red-600">
              @foreach(['SUV','MPV','Hatchback','Sedan','Pickup','Sport'] as $kat)
              <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
                {{ $kat }}
              </option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
              Harga Mulai (Rp) *
            </label>
            <input type="number" name="harga_mulai" required min="0"
                   value="{{ old('harga_mulai') }}"
                   placeholder="Contoh: 228300000"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
          </div>
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Deskripsi
          </label>
          <textarea name="deskripsi" rows="4"
                    placeholder="Deskripsi singkat tentang mobil ini..."
                    class="w-full border border-gray-200 px-4 py-2.5 text-sm
                           focus:outline-none focus:border-red-600 transition-colors resize-none">{{ old('deskripsi') }}</textarea>
        </div>
      </div>

      {{-- SPESIFIKASI --}}
      {{-- SPESIFIKASI --}}
<div class="bg-white p-6 shadow-sm">
  <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
    Spesifikasi Kendaraan
  </h3>

  {{-- Mesin --}}
  <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Mesin</p>
  <div class="grid grid-cols-3 gap-3 mb-5">
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Kapasitas</label>
      <input type="text" name="spek[mesin][kapasitas]"
             value="{{ old('spek.mesin.kapasitas') }}"
             placeholder="1496 cc"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Tenaga</label>
      <input type="text" name="spek[mesin][tenaga]"
             value="{{ old('spek.mesin.tenaga') }}"
             placeholder="98 hp"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Torsi</label>
      <input type="text" name="spek[mesin][torsi]"
             value="{{ old('spek.mesin.torsi') }}"
             placeholder="140 Nm"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
  </div>

  {{-- Transmisi & Bahan Bakar --}}
  <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Umum</p>
  <div class="grid grid-cols-2 gap-3 mb-5">
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Transmisi</label>
      <select name="spek[transmisi]"
              class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
        <option value="">-- Pilih --</option>
        @foreach(['Manual 5-Speed','Manual 6-Speed','AT','CVT','Automatic 4-Speed','Automatic 6-Speed'] as $t)
        <option value="{{ $t }}" {{ old('spek.transmisi') === $t ? 'selected' : '' }}>{{ $t }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Bahan Bakar</label>
      <select name="spek[bahan_bakar]"
              class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
        <option value="">-- Pilih --</option>
        @foreach(['Bensin','Solar','Hybrid','Electric'] as $b)
        <option value="{{ $b }}" {{ old('spek.bahan_bakar') === $b ? 'selected' : '' }}>{{ $b }}</option>
        @endforeach
      </select>
    </div>
  </div>

  {{-- Dimensi --}}
  <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Dimensi</p>
  <div class="grid grid-cols-3 gap-3 mb-5">
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Panjang</label>
      <input type="text" name="spek[dimensi][panjang]"
             value="{{ old('spek.dimensi.panjang') }}"
             placeholder="4395 mm"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Lebar</label>
      <input type="text" name="spek[dimensi][lebar]"
             value="{{ old('spek.dimensi.lebar') }}"
             placeholder="1730 mm"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Tinggi</label>
      <input type="text" name="spek[dimensi][tinggi]"
             value="{{ old('spek.dimensi.tinggi') }}"
             placeholder="1700 mm"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
  </div>

  {{-- Interior --}}
  <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Interior</p>
  <div class="grid grid-cols-2 gap-3 mb-5">
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Kapasitas Penumpang</label>
      <input type="number" name="spek[interior][kapasitas_penumpang]"
             value="{{ old('spek.interior.kapasitas_penumpang') }}"
             placeholder="7"
             min="1" max="10"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">Kapasitas Bagasi</label>
      <input type="text" name="spek[interior][kapasitas_bagasi]"
             value="{{ old('spek.interior.kapasitas_bagasi') }}"
             placeholder="270 L"
             class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
    </div>
  </div>

  {{-- Fitur --}}
  <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Fitur Unggulan</p>
  <div class="grid grid-cols-2 gap-2">
    @foreach([
      'Toyota Safety Sense', 'Android Auto', 'Apple CarPlay',
      'Dual SRS Airbag', 'ABS', 'VSC', 'Hill Start Assist',
      'Rear Parking Camera', 'Wireless Charger', 'Panoramic Roof',
      'Cruise Control', '4x4 AWD', 'Lane Departure Alert', 'Blind Spot Monitor'
    ] as $fitur)
    <label class="flex items-center gap-2 cursor-pointer">
      <input type="checkbox" name="spek[fitur][]" value="{{ $fitur }}"
             {{ is_array(old('spek.fitur')) && in_array($fitur, old('spek.fitur')) ? 'checked' : '' }}
             class="w-4 h-4 accent-red-600">
      <span class="text-sm text-gray-700">{{ $fitur }}</span>
    </label>
    @endforeach
  </div>

</div>
    {{-- WARNA TERSEDIA --}}
    <div class="bg-white p-6 shadow-sm">
    <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
        Warna Tersedia
    </h3>

    <div x-data="{
        warnas: [{ nama: '', hex: '#ffffff' }],
        tambah() { this.warnas.push({ nama: '', hex: '#ffffff' }) },
        hapus(i) { if (this.warnas.length > 1) this.warnas.splice(i, 1) }
    }">

        <div class="space-y-3 mb-4">
        <template x-for="(warna, i) in warnas" :key="i">
            <div class="flex items-center gap-3">
            {{-- Color Picker --}}
            <div class="relative flex-shrink-0">
                <input type="color"
                    :name="'warna[' + i + '][hex]'"
                    x-model="warna.hex"
                    class="w-10 h-10 border border-gray-200 cursor-pointer p-0.5">
            </div>

            {{-- Nama Warna --}}
            <input type="text"
                    :name="'warna[' + i + '][nama]'"
                    x-model="warna.nama"
                    placeholder="Contoh: Putih Pearl, Hitam Metalik"
                    class="flex-1 border border-gray-200 px-3 py-2 text-sm
                            focus:outline-none focus:border-red-600 transition-colors">

            {{-- Preview --}}
            <div class="w-8 h-8 rounded-full border border-gray-200 flex-shrink-0"
                :style="'background-color: ' + warna.hex"></div>

            {{-- Hapus --}}
            <button type="button" @click="hapus(i)"
                    class="text-gray-300 hover:text-red-600 transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            </div>
        </template>
        </div>

        <button type="button" @click="tambah()"
                class="flex items-center gap-2 text-sm font-semibold text-red-600
                    hover:text-red-700 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Warna
        </button>

    </div>
    </div>

      {{-- UPLOAD FOTO GALERI --}}
      <div class="bg-white p-6 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
          Foto Galeri
        </h3>
        <input type="file" name="gallery[]" multiple accept="image/*"
               class="w-full text-sm text-gray-500
                      file:mr-4 file:py-2 file:px-4 file:border-0
                      file:text-xs file:font-semibold file:uppercase
                      file:bg-gray-900 file:text-white
                      hover:file:bg-gray-700 cursor-pointer">
        <p class="text-xs text-gray-400 mt-2">
          Upload beberapa foto sekaligus. Maksimal 2MB per foto.
          Foto 360 derajat bisa diupload setelah data tersimpan.
        </p>
      </div>

    </div>

    {{-- SIDEBAR --}}
    <div class="space-y-5">

      {{-- PUBLIKASI --}}
      <div class="bg-white p-6 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
          Publikasi
        </h3>
        <div class="space-y-3">
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', '1') ? 'checked' : '' }}
                   class="w-4 h-4 accent-red-600">
            <div>
              <p class="text-sm font-medium text-gray-900">Aktif</p>
              <p class="text-xs text-gray-400">Tampil di website</p>
            </div>
          </label>
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_featured" value="1"
                   {{ old('is_featured') ? 'checked' : '' }}
                   class="w-4 h-4 accent-red-600">
            <div>
              <p class="text-sm font-medium text-gray-900">Unggulan</p>
              <p class="text-xs text-gray-400">Tampil di halaman beranda</p>
            </div>
          </label>
        </div>

        <div class="mt-6 space-y-2">
          <button type="submit"
                  class="w-full bg-red-600 text-white font-semibold uppercase text-sm
                         tracking-wide py-3 hover:bg-red-700 transition-colors">
            Simpan Mobil
          </button>
          <a href="{{ route('admin.cars.index') }}"
             class="block text-center text-sm text-gray-400 hover:text-gray-700 py-2 transition-colors">
            Batal
          </a>
        </div>
      </div>

      {{-- INFO --}}
      <div class="bg-blue-50 border border-blue-200 p-4 text-xs text-blue-700 leading-relaxed">
        <p class="font-semibold mb-1">Catatan:</p>
        <p>Setelah menyimpan, Anda bisa menambahkan foto 360 derajat melalui halaman Edit Mobil.</p>
      </div>

    </div>
  </div>

</form>

@endsection
@extends('layouts.admin')
@section('title', 'Edit Mobil – ' . $car->nama_mobil)

@section('admin_content')

<div x-data="{ mainTab: 'info' }">

{{-- ===== PAGE HEADER ===== --}}
<div class="flex items-start justify-between mb-6">
  <div>
    <a href="{{ route('admin.cars.index') }}"
       class="inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-gray-400 hover:text-red-600 transition-colors mb-2">
      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
      </svg>
      Kembali
    </a>
    <h1 class="text-2xl font-bold text-gray-900 leading-tight">Edit Mobil</h1>
    <p class="text-sm text-gray-400 mt-0.5">{{ $car->nama_mobil }} &mdash; {{ $car->kategori }}</p>
  </div>
  <a href="{{ route('cars.show', $car->slug) }}" target="_blank"
     class="inline-flex items-center gap-2 border border-gray-200 text-gray-500 text-xs font-semibold uppercase tracking-wide px-4 py-2.5 hover:border-red-600 hover:text-red-600 transition-colors mt-1">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
    </svg>
    Lihat di Website
  </a>
</div>

{{-- ===== TAB NAVIGATION ===== --}}
<div class="flex border-b border-gray-200 mb-6">
  <button @click="mainTab = 'info'"
          :class="mainTab === 'info' ? 'border-b-2 border-red-600 text-red-600' : 'text-gray-400 hover:text-gray-700'"
          class="px-5 py-3 text-xs font-bold uppercase tracking-widest transition-colors -mb-px whitespace-nowrap">
    Info Dasar
  </button>
  <button @click="mainTab = 'spesifikasi'"
          :class="mainTab === 'spesifikasi' ? 'border-b-2 border-red-600 text-red-600' : 'text-gray-400 hover:text-gray-700'"
          class="px-5 py-3 text-xs font-bold uppercase tracking-widest transition-colors -mb-px whitespace-nowrap">
    Spesifikasi
  </button>
  <button @click="mainTab = 'highlights'"
          :class="mainTab === 'highlights' ? 'border-b-2 border-red-600 text-red-600' : 'text-gray-400 hover:text-gray-700'"
          class="px-5 py-3 text-xs font-bold uppercase tracking-widest transition-colors -mb-px whitespace-nowrap">
    Highlights
  </button>
  <button @click="mainTab = 'foto'"
          :class="mainTab === 'foto' ? 'border-b-2 border-red-600 text-red-600' : 'text-gray-400 hover:text-gray-700'"
          class="px-5 py-3 text-xs font-bold uppercase tracking-widest transition-colors -mb-px whitespace-nowrap">
    Kelola Foto
  </button>
</div>

{{-- ===== MAIN FORM ===== --}}
<form method="POST" action="{{ route('admin.cars.update', $car) }}" id="main-form">
  @csrf
  @method('PUT')

  {{-- ======================================== --}}
  {{-- TAB 1: INFO DASAR                        --}}
  {{-- ======================================== --}}
  <div x-show="mainTab === 'info'" x-cloak>
    <div class="grid lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 space-y-5">

        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Informasi Dasar</h3>
          </div>
          <div class="p-6 space-y-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                Nama Mobil <span class="text-red-500">*</span>
              </label>
              <input type="text" name="nama_mobil" required
                     value="{{ old('nama_mobil', $car->nama_mobil) }}"
                     placeholder="Contoh: Toyota Avanza"
                     class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                  Kategori <span class="text-red-500">*</span>
                </label>
                <select name="kategori" required
                        class="w-full border border-gray-200 px-4 py-2.5 text-sm bg-white focus:outline-none focus:border-red-600 transition-colors">
                  @foreach(['SUV','MPV','Hatchback','Sedan','Pickup','Sport'] as $kat)
                  <option value="{{ $kat }}" {{ old('kategori', $car->kategori) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                  Harga Mulai (Rp) <span class="text-red-500">*</span>
                </label>
                <input type="number" name="harga_mulai" required min="0"
                       value="{{ old('harga_mulai', $car->harga_mulai) }}"
                       placeholder="250000000"
                       class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
              </div>
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Deskripsi</label>
              <textarea name="deskripsi" rows="4" placeholder="Deskripsi singkat tentang mobil ini..."
                        class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors resize-none">{{ old('deskripsi', $car->deskripsi) }}</textarea>
            </div>
          </div>
        </div>

        <div class="bg-white shadow-sm"
             x-data="{
               warnas: {{ json_encode($car->warna_tersedia ?? [['nama'=>'','hex'=>'#ffffff']]) }},
               tambah() { this.warnas.push({ nama: '', hex: '#ffffff' }) },
               hapus(i) { if (this.warnas.length > 1) this.warnas.splice(i, 1) }
             }">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Warna Tersedia</h3>
          </div>
          <div class="p-6">
            <div class="space-y-2 mb-4">
              <template x-for="(warna, i) in warnas" :key="i">
                <div class="flex items-center gap-3 px-3 py-2.5 bg-gray-50 border border-gray-100">
                  <input type="color" :name="'warna[' + i + '][hex]'" x-model="warna.hex"
                         class="w-9 h-9 border-0 cursor-pointer p-0 flex-shrink-0 bg-transparent">
                  <div class="w-5 h-5 rounded-full border border-gray-300 flex-shrink-0"
                       :style="'background-color:' + warna.hex"></div>
                  <input type="text" :name="'warna[' + i + '][nama]'" x-model="warna.nama"
                         placeholder="Contoh: Putih Pearl, Hitam Metalik"
                         class="flex-1 border border-gray-200 bg-white px-3 py-2 text-sm focus:outline-none focus:border-red-600 transition-colors">
                  <button type="button" @click="hapus(i)"
                          class="text-gray-300 hover:text-red-500 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>
              </template>
            </div>
            <button type="button" @click="tambah()"
                    class="w-full flex items-center justify-center gap-2 border border-dashed border-red-300 text-red-600 hover:border-red-500 hover:text-red-700 text-xs font-bold uppercase tracking-widest py-2.5 transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
              </svg>
              Tambah Warna
            </button>
          </div>
        </div>

      </div>

      <div class="space-y-5">
        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Publikasi</h3>
          </div>
          <div class="px-6 pt-5 pb-4 space-y-3">
            <label class="flex items-center gap-3 cursor-pointer">
              <input type="checkbox" name="is_active" value="1"
                     {{ old('is_active', $car->is_active) ? 'checked' : '' }}
                     class="w-4 h-4 accent-red-600">
              <div>
                <p class="text-sm font-semibold text-gray-900">Aktif</p>
                <p class="text-xs text-gray-400">Tampil di website pengunjung</p>
              </div>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
              <input type="checkbox" name="is_featured" value="1"
                     {{ old('is_featured', $car->is_featured) ? 'checked' : '' }}
                     class="w-4 h-4 accent-red-600">
              <div>
                <p class="text-sm font-semibold text-gray-900">Unggulan</p>
                <p class="text-xs text-gray-400">Tampil di halaman beranda</p>
              </div>
            </label>
          </div>
          <div class="px-6 pb-6 space-y-2 border-t border-gray-100 pt-4">
            <button type="submit"
                    class="w-full bg-red-600 text-white font-bold uppercase text-xs tracking-widest py-3 hover:bg-red-700 transition-colors">
              Simpan Perubahan
            </button>
            <a href="{{ route('admin.cars.index') }}"
               class="block w-full text-center border border-gray-200 text-gray-500 font-semibold uppercase text-xs tracking-widest py-3 hover:bg-gray-50 transition-colors">
              Batal
            </a>
          </div>
        </div>

        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-gray-300 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-600">Info</h3>
          </div>
          <dl class="px-6 py-5 space-y-3">
            <div>
              <dt class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Slug</dt>
              <dd class="font-mono text-xs text-gray-600 break-all">{{ $car->slug }}</dd>
            </div>
            <div>
              <dt class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Dibuat</dt>
              <dd class="text-xs text-gray-700">{{ $car->created_at->format('d M Y') }}</dd>
            </div>
            <div>
              <dt class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Diperbarui</dt>
              <dd class="text-xs text-gray-700">{{ $car->updated_at->format('d M Y H:i') }}</dd>
            </div>
          </dl>
        </div>

        <div class="bg-white shadow-sm border border-red-100">
          <div class="px-6 py-4 border-b border-red-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-red-600">Hapus Mobil</h3>
          </div>
          <div class="px-6 py-5">
            <p class="text-xs text-gray-400 mb-4 leading-relaxed">
              Tindakan ini <strong class="text-gray-600">permanen</strong>. Semua foto dan data terkait akan dihapus.
            </p>
            <button type="submit" form="delete-car-form"
                    onclick="return confirm('Yakin hapus mobil ini secara permanen?')"
                    class="w-full border-2 border-red-600 text-red-600 font-bold uppercase text-xs tracking-widest py-2.5 hover:bg-red-600 hover:text-white transition-colors cursor-pointer">
              Hapus Permanen
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ======================================== --}}
  {{-- TAB 2: SPESIFIKASI                       --}}
  {{-- ======================================== --}}
  <div x-show="mainTab === 'spesifikasi'" x-cloak>
    <div class="grid lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 space-y-5">

        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Mesin</h3>
          </div>
          <div class="p-6 grid grid-cols-3 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Kapasitas</label>
              <input type="text" name="spek[mesin][kapasitas]" value="{{ old('spek.mesin.kapasitas', $car->spesifikasi['mesin']['kapasitas'] ?? '') }}" placeholder="1496 cc" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Tenaga</label>
              <input type="text" name="spek[mesin][tenaga]" value="{{ old('spek.mesin.tenaga', $car->spesifikasi['mesin']['tenaga'] ?? '') }}" placeholder="98 hp" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Torsi</label>
              <input type="text" name="spek[mesin][torsi]" value="{{ old('spek.mesin.torsi', $car->spesifikasi['mesin']['torsi'] ?? '') }}" placeholder="140 Nm" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
          </div>
        </div>

        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Umum</h3>
          </div>
          <div class="p-6 grid grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Transmisi</label>
              <select name="spek[transmisi]" class="w-full border border-gray-200 px-4 py-2.5 text-sm bg-white focus:outline-none focus:border-red-600 transition-colors">
                <option value="">-- Pilih --</option>
                @foreach(['Manual 5-Speed','Manual 6-Speed','AT','CVT','Automatic 4-Speed','Automatic 6-Speed'] as $t)
                <option value="{{ $t }}" {{ old('spek.transmisi', $car->spesifikasi['transmisi'] ?? '') === $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Bahan Bakar</label>
              <select name="spek[bahan_bakar]" class="w-full border border-gray-200 px-4 py-2.5 text-sm bg-white focus:outline-none focus:border-red-600 transition-colors">
                <option value="">-- Pilih --</option>
                @foreach(['Bensin','Solar','Hybrid','Electric'] as $b)
                <option value="{{ $b }}" {{ old('spek.bahan_bakar', $car->spesifikasi['bahan_bakar'] ?? '') === $b ? 'selected' : '' }}>{{ $b }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Dimensi</h3>
          </div>
          <div class="p-6 grid grid-cols-3 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Panjang</label>
              <input type="text" name="spek[dimensi][panjang]" value="{{ old('spek.dimensi.panjang', $car->spesifikasi['dimensi']['panjang'] ?? '') }}" placeholder="4395 mm" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Lebar</label>
              <input type="text" name="spek[dimensi][lebar]" value="{{ old('spek.dimensi.lebar', $car->spesifikasi['dimensi']['lebar'] ?? '') }}" placeholder="1730 mm" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Tinggi</label>
              <input type="text" name="spek[dimensi][tinggi]" value="{{ old('spek.dimensi.tinggi', $car->spesifikasi['dimensi']['tinggi'] ?? '') }}" placeholder="1700 mm" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
          </div>
        </div>

        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Interior</h3>
          </div>
          <div class="p-6 grid grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Kapasitas Penumpang</label>
              <input type="number" name="spek[interior][kapasitas_penumpang]" value="{{ old('spek.interior.kapasitas_penumpang', $car->spesifikasi['interior']['kapasitas_penumpang'] ?? '') }}" placeholder="7" min="1" max="10" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Kapasitas Bagasi</label>
              <input type="text" name="spek[interior][kapasitas_bagasi]" value="{{ old('spek.interior.kapasitas_bagasi', $car->spesifikasi['interior']['kapasitas_bagasi'] ?? '') }}" placeholder="270 L" class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
          </div>
        </div>

        <div class="bg-white shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <span class="block w-1 h-5 bg-red-600 flex-shrink-0"></span>
            <h3 class="font-bold text-sm uppercase tracking-widest text-gray-800">Fitur Unggulan</h3>
          </div>
          <div class="p-6">
            @php $activeFitur = old('spek.fitur', $car->spesifikasi['fitur'] ?? []); @endphp
            <div class="grid grid-cols-2 gap-1">
              @foreach(['Toyota Safety Sense','Android Auto','Apple CarPlay','Dual SRS Airbag','ABS','VSC','Hill Start Assist','Rear Parking Camera','Wireless Charger','Panoramic Roof','Cruise Control','4x4 AWD','Lane Departure Alert','Blind Spot Monitor'] as $fitur)
              <label class="flex items-center gap-2.5 cursor-pointer px-3 py-2 hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-colors">
                <input type="checkbox" name="spek[fitur][]" value="{{ $fitur }}"
                       {{ is_array($activeFitur) && in_array($fitur, $activeFitur) ? 'checked' : '' }}
                       class="w-4 h-4 accent-red-600 flex-shrink-0">
                <span class="text-sm text-gray-700">{{ $fitur }}</span>
              </label>
              @endforeach
            </div>
          </div>
        </div>

      </div>

      <div>
        <div class="bg-white shadow-sm sticky top-4">
          <div class="px-6 py-4 border-b border-gray-100">
            <p class="font-bold text-xs uppercase tracking-widest text-gray-500">Simpan</p>
          </div>
          <div class="p-6 space-y-2">
            <button type="submit" class="w-full bg-red-600 text-white font-bold uppercase text-xs tracking-widest py-3 hover:bg-red-700 transition-colors">
              Simpan Perubahan
            </button>
            <a href="{{ route('admin.cars.index') }}"
               class="block w-full text-center border border-gray-200 text-gray-500 font-semibold uppercase text-xs tracking-widest py-3 hover:bg-gray-50 transition-colors">
              Batal
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ======================================== --}}
  {{-- TAB 3: HIGHLIGHTS                        --}}
  {{-- ======================================== --}}
  <div x-show="mainTab === 'highlights'" x-cloak>
    <div class="grid lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2">

        <div class="flex items-start gap-2 bg-blue-50 border border-blue-200 px-4 py-3 text-xs text-blue-700 mb-5">
          <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>Upload gambar terlebih dahulu, lalu klik <strong>Simpan Perubahan</strong>.</span>
        </div>

        <div id="highlights-wrapper" class="space-y-4 mb-4">
          @foreach($car->highlights ?? [] as $i => $hl)
          <div class="bg-white shadow-sm" id="hl-block-{{ $i }}">

            {{-- Section Header --}}
            <div class="flex items-center justify-between px-6 py-3.5 bg-gray-50 border-b border-gray-200">
              <div class="flex items-center gap-3">
                <span class="w-6 h-6 bg-red-600 text-white text-xs font-bold flex items-center justify-center flex-shrink-0">{{ $i + 1 }}</span>
                <span class="font-bold text-xs uppercase tracking-widest text-gray-700">{{ $hl['judul'] ?? 'Section ' . ($i + 1) }}</span>
              </div>
              <button type="button" onclick="removeHighlight({{ $i }})"
                      class="text-xs text-red-500 hover:text-red-700 font-semibold uppercase tracking-wide transition-colors">
                Hapus Section
              </button>
            </div>

            <div class="p-6 space-y-5">

              {{-- Judul & Deskripsi --}}
              <div class="grid grid-cols-1 gap-4">
                <div>
                  <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Judul <span class="text-red-500">*</span></label>
                  <input type="text" name="highlights[{{ $i }}][judul]" value="{{ $hl['judul'] ?? '' }}"
                         placeholder="Contoh: Beyond Eksterior"
                         class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
                </div>
                <div>
                  <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Deskripsi</label>
                  <textarea name="highlights[{{ $i }}][deskripsi]" rows="2" placeholder="Deskripsi singkat..."
                            class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 resize-none">{{ $hl['deskripsi'] ?? '' }}</textarea>
                </div>
              </div>

              {{-- Gambar Hero --}}
              <div class="bg-gray-50 border border-gray-200 p-4">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">Gambar Utama (Hero)</p>
                @if(!empty($hl['gambar_hero']))
                  <input type="hidden" name="highlights[{{ $i }}][gambar_hero_existing]" value="{{ $hl['gambar_hero'] }}">
                  <img src="{{ asset('storage/' . $hl['gambar_hero']) }}" id="hero-preview-{{ $i }}"
                       class="w-full max-h-52 object-cover border border-gray-200 mb-3">
                @else
                  <div id="hero-preview-{{ $i }}"
                       class="w-full h-32 bg-white border-2 border-dashed border-gray-300 flex flex-col items-center justify-center gap-2 mb-3">
                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-xs text-gray-400">Belum ada gambar utama</span>
                  </div>
                @endif
                <div class="flex gap-2 items-center">
                  <input type="file" accept="image/*" id="hero-file-{{ $i }}"
                         class="flex-1 text-xs text-gray-600 border border-gray-200 bg-white px-3 py-2 cursor-pointer
                                file:mr-3 file:py-1.5 file:px-3 file:border-0 file:rounded-none
                                file:text-xs file:font-bold file:uppercase file:tracking-wide
                                file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
                  <button type="button" id="hero-btn-{{ $i }}" onclick="uploadHero({{ $i }}, {{ $car->id }})"
                          class="flex-shrink-0 bg-red-600 text-white text-xs font-bold uppercase tracking-wide px-5 py-2 hover:bg-red-700 transition-colors">
                    Upload
                  </button>
                </div>
              </div>

              {{-- Sub Items --}}
              <div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">Sub Gambar & Caption</p>
                <div id="sub-wrapper-{{ $i }}" class="space-y-3">
                  @foreach($hl['sub_items'] ?? [] as $j => $sub)

                  {{-- SUB ITEM CARD --}}
                  <div class="border border-gray-200 bg-white" id="sub-{{ $i }}-{{ $j }}">
                    {{-- Sub header --}}
                    <div class="flex items-center justify-between px-4 py-2 bg-gray-50 border-b border-gray-100">
                      <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Sub Gambar #{{ $j + 1 }}</span>
                      <button type="button"
                              onclick="document.getElementById('sub-{{ $i }}-{{ $j }}').remove()"
                              class="text-gray-400 hover:text-red-500 text-xs font-semibold transition-colors">
                        Hapus
                      </button>
                    </div>
                    {{-- Sub body --}}
                    <div class="p-4">
                      <div class="flex gap-4">
                        {{-- Preview --}}
                        <div class="flex-shrink-0 w-36">
                          @if(!empty($sub['gambar']))
                            <input type="hidden"
                                   name="highlights[{{ $i }}][sub_items][{{ $j }}][gambar_existing]"
                                   value="{{ $sub['gambar'] }}">
                            <img src="{{ asset('storage/' . $sub['gambar']) }}"
                                 id="sub-preview-{{ $i }}-{{ $j }}"
                                 class="w-36 h-24 object-cover border border-gray-200 mb-2">
                          @else
                            <div id="sub-preview-{{ $i }}-{{ $j }}"
                                 class="w-36 h-24 bg-gray-100 border-2 border-dashed border-gray-300
                                        flex flex-col items-center justify-center gap-1 mb-2">
                              <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                              </svg>
                              <span class="text-[10px] text-gray-400">Belum ada</span>
                            </div>
                          @endif
                          {{-- File input tampak penuh --}}
                          <input type="file" accept="image/*"
                                 id="sub-file-{{ $i }}-{{ $j }}"
                                 class="w-full text-[10px] text-gray-600 border border-gray-200 bg-white px-2 py-1.5 cursor-pointer mb-1.5
                                        file:mr-2 file:py-1 file:px-2 file:border-0 file:rounded-none
                                        file:text-[10px] file:font-bold file:uppercase
                                        file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
                          <button type="button"
                                  id="sub-btn-{{ $i }}-{{ $j }}"
                                  onclick="uploadSub({{ $i }}, {{ $j }}, {{ $car->id }})"
                                  class="w-full bg-red-600 text-white text-[10px] font-bold uppercase tracking-wide py-1.5 hover:bg-red-700 transition-colors">
                            Upload Gambar
                          </button>
                        </div>
                        {{-- Caption & Deskripsi --}}
                        <div class="flex-1 space-y-2 min-w-0">
                          <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Caption</label>
                            <input type="text"
                                   name="highlights[{{ $i }}][sub_items][{{ $j }}][caption]"
                                   value="{{ $sub['caption'] ?? '' }}"
                                   placeholder="Judul / caption gambar"
                                   class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600 transition-colors">
                          </div>
                          <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Deskripsi</label>
                            <textarea name="highlights[{{ $i }}][sub_items][{{ $j }}][deskripsi]"
                                      rows="3" placeholder="Deskripsi gambar (opsional)..."
                                      class="w-full border border-gray-200 px-3 py-2 text-xs focus:outline-none focus:border-red-600 resize-none transition-colors">{{ $sub['deskripsi'] ?? '' }}</textarea>
                          </div>
                          <input type="hidden"
                                 name="highlights[{{ $i }}][sub_items][{{ $j }}][gambar_existing]"
                                 value="{{ $sub['gambar'] ?? '' }}"
                                 id="sub-hidden-{{ $i }}-{{ $j }}">
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- END SUB ITEM CARD --}}

                  @endforeach
                </div>

                {{-- Tambah sub gambar --}}
                <button type="button" onclick="addSubItem({{ $i }}, {{ $car->id }})"
                        class="mt-3 w-full flex items-center justify-center gap-1.5 border border-dashed border-gray-300
                               hover:border-red-400 text-gray-400 hover:text-red-600
                               text-xs font-bold uppercase tracking-widest py-3 transition-colors">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                  </svg>
                  Tambah Sub Gambar
                </button>
              </div>

            </div>
          </div>
          @endforeach
        </div>

        {{-- Tambah section highlight --}}
        <button type="button" onclick="addHighlight({{ $car->id }})"
                class="w-full flex items-center justify-center gap-2 border-2 border-dashed border-red-200
                       hover:border-red-400 text-red-600 hover:text-red-700
                       text-sm font-bold uppercase tracking-widest py-4 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
          </svg>
          Tambah Section Highlight
        </button>

      </div>

      <div>
        <div class="bg-white shadow-sm sticky top-4">
          <div class="px-6 py-4 border-b border-gray-100">
            <p class="font-bold text-xs uppercase tracking-widest text-gray-500">Simpan</p>
          </div>
          <div class="p-6 space-y-2">
            <button type="submit" class="w-full bg-red-600 text-white font-bold uppercase text-xs tracking-widest py-3 hover:bg-red-700 transition-colors">
              Simpan Perubahan
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</form>{{-- END MAIN FORM --}}

{{-- ======================================== --}}
{{-- TAB 4: KELOLA FOTO                       --}}
{{-- ======================================== --}}
<div x-show="mainTab === 'foto'" x-cloak x-data="imageManager({{ $car->id }})">
  <div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">

      <div class="bg-white shadow-sm">
        <div class="flex border-b border-gray-100">
          <button @click="activeTab = 'galeri'"
                  :class="activeTab === 'galeri' ? 'border-b-2 border-red-600 text-red-600' : 'text-gray-400 hover:text-gray-700'"
                  class="px-6 py-3.5 text-xs font-bold uppercase tracking-widest transition-colors -mb-px">
            Foto Galeri
            <span class="ml-1 text-[11px] font-normal">({{ $car->galleryImages->count() }})</span>
          </button>
          <button @click="activeTab = '360_degree'"
                  :class="activeTab === '360_degree' ? 'border-b-2 border-red-600 text-red-600' : 'text-gray-400 hover:text-gray-700'"
                  class="px-6 py-3.5 text-xs font-bold uppercase tracking-widest transition-colors -mb-px">
            Foto 360°
            <span class="ml-1 text-[11px] font-normal">({{ $car->threeSixtyImages->count() }}/8)</span>
          </button>
        </div>

        {{-- GALERI --}}
        <div x-show="activeTab === 'galeri'" class="p-6 space-y-6">

          <div>
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Foto Umum (Penyerahan Unit)</p>
            @if($car->galleryImagesNoWarna->isNotEmpty())
            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2 mb-4">
              @foreach($car->galleryImagesNoWarna as $img)
              <div class="relative group aspect-square">
                <img src="{{ $img->url }}" class="w-full h-full object-cover">
                <button type="button" onclick="deleteImage({{ $img->id }}, this.closest('.relative'))"
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                </button>
              </div>
              @endforeach
            </div>
            @else
            <div class="border-2 border-dashed border-gray-200 p-6 text-center mb-4">
              <p class="text-xs text-gray-400">Belum ada foto umum</p>
            </div>
            @endif
            {{-- Upload Umum --}}
            <form @submit.prevent="uploadImages('galeri', $event.target)">
              @csrf
              <input type="hidden" name="warna_nama" value="">
              <div class="flex gap-2 items-center">
                <input type="file" name="images[]" multiple accept="image/*"
                       class="flex-1 text-xs text-gray-600 border border-gray-200 bg-white px-3 py-2 cursor-pointer
                              file:mr-3 file:py-1.5 file:px-3 file:border-0 file:rounded-none
                              file:text-xs file:font-bold file:uppercase file:tracking-wide
                              file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
                <button type="submit"
                        class="flex-shrink-0 bg-gray-900 text-white font-bold uppercase text-xs tracking-widest px-5 py-2 hover:bg-gray-700 transition-colors">
                  Upload
                </button>
              </div>
            </form>
          </div>

          @if(!empty($car->warna_tersedia))
          <div class="border-t border-gray-100 pt-5">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Foto Per Warna</p>
            <div class="space-y-4">
              @foreach($car->warna_tersedia as $warna)
              <div class="border border-gray-100 p-4">
                <div class="flex items-center gap-2 mb-3">
                  <span class="w-4 h-4 rounded-full border border-gray-300 flex-shrink-0"
                        style="background-color: {{ $warna['hex'] }}"></span>
                  <p class="font-bold text-sm text-gray-800">{{ $warna['nama'] }}</p>
                  <span class="text-xs text-gray-400 ml-auto">{{ $car->imagesByWarna($warna['nama'])->count() }} foto</span>
                </div>
                @if($car->imagesByWarna($warna['nama'])->count() > 0)
                <div class="grid grid-cols-4 sm:grid-cols-5 gap-2 mb-3">
                  @foreach($car->imagesByWarna($warna['nama'])->get() as $img)
                  <div class="relative group aspect-square">
                    <img src="{{ $img->url }}" class="w-full h-full object-cover">
                    <button type="button" onclick="deleteImage({{ $img->id }}, this.closest('.relative'))"
                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                      <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                    </button>
                  </div>
                  @endforeach
                </div>
                @else
                <div class="border-2 border-dashed border-gray-100 p-3 text-center mb-3">
                  <p class="text-[10px] text-gray-400">Belum ada foto untuk warna ini</p>
                </div>
                @endif
                <form @submit.prevent="uploadImages('galeri', $event.target)">
                  @csrf
                  <input type="hidden" name="warna_nama" value="{{ $warna['nama'] }}">
                  <div class="flex gap-2 items-center">
                    <input type="file" name="images[]" multiple accept="image/*"
                           class="flex-1 text-xs text-gray-600 border border-gray-200 bg-white px-3 py-2 cursor-pointer
                                  file:mr-3 file:py-1.5 file:px-3 file:border-0 file:rounded-none
                                  file:text-xs file:font-bold file:uppercase file:tracking-wide
                                  file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
                    <button type="submit"
                            class="flex-shrink-0 bg-gray-900 text-white font-bold uppercase text-xs tracking-widest px-5 py-2 hover:bg-gray-700 transition-colors">
                      Upload
                    </button>
                  </div>
                </form>
              </div>
              @endforeach
            </div>
          </div>
          @else
          <div class="border-t border-gray-100 pt-4">
            <p class="text-xs text-gray-400 bg-yellow-50 border border-yellow-200 px-4 py-3">
              ⚠️ Belum ada warna. Tambahkan warna di tab <strong>Info Dasar</strong>, simpan terlebih dahulu.
            </p>
          </div>
          @endif

        </div>

        {{-- FOTO 360 --}}
        <div x-show="activeTab === '360_degree'" class="p-6">
          <div class="flex items-start gap-2 bg-blue-50 border border-blue-200 px-4 py-3 text-xs text-blue-700 mb-5">
            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Upload tepat <strong>8 foto</strong> berurutan searah jarum jam untuk tampilan 360°.</span>
          </div>

          @if($car->threeSixtyImages->isNotEmpty())
          <div class="grid grid-cols-4 gap-2 mb-5">
            @foreach($car->threeSixtyImages as $img)
            <div class="relative group aspect-square">
              <img src="{{ $img->url }}" class="w-full h-full object-cover">
              <div class="absolute top-1 left-1 bg-black/70 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center">
                {{ $img->urutan + 1 }}
              </div>
              <button type="button" onclick="deleteImage({{ $img->id }}, this.closest('.relative'))"
                      class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
              </button>
            </div>
            @endforeach
          </div>
          @else
          <div class="border-2 border-dashed border-gray-200 p-10 text-center mb-5">
            <p class="text-xs text-gray-400">Belum ada foto 360°</p>
          </div>
          @endif

          <form @submit.prevent="uploadImages('360_degree', $event.target)">
            @csrf
            <div class="flex gap-2 items-center">
              <input type="file" name="images[]" multiple accept="image/*"
                     class="flex-1 text-xs text-gray-600 border border-gray-200 bg-white px-3 py-2 cursor-pointer
                            file:mr-3 file:py-1.5 file:px-3 file:border-0 file:rounded-none
                            file:text-xs file:font-bold file:uppercase file:tracking-wide
                            file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
              <button type="submit"
                      class="flex-shrink-0 bg-gray-900 text-white font-bold uppercase text-xs tracking-widest px-5 py-2 hover:bg-gray-700 transition-colors">
                Upload
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>

    <div>
      <div class="bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
          <span class="block w-1 h-5 bg-gray-300 flex-shrink-0"></span>
          <h3 class="font-bold text-xs uppercase tracking-widest text-gray-600">Panduan Upload</h3>
        </div>
        <ul class="px-6 py-5 space-y-3">
          <li class="flex items-start gap-2 text-xs text-gray-600"><span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span> Format: JPG, PNG, WebP</li>
          <li class="flex items-start gap-2 text-xs text-gray-600"><span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span> Ukuran maks: 5MB per file</li>
          <li class="flex items-start gap-2 text-xs text-gray-600"><span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span> Foto warna: simpan data warna dulu di Info Dasar baru upload</li>
          <li class="flex items-start gap-2 text-xs text-gray-600"><span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span> Foto 360°: tepat 8 foto, urut searah jarum jam</li>
          <li class="flex items-start gap-2 text-xs text-gray-600"><span class="text-red-500 font-bold mt-0.5 flex-shrink-0">•</span> Hover pada foto → klik ikon hapus</li>
        </ul>
      </div>
    </div>

  </div>
</div>


{{-- Standalone form hapus mobil (di luar semua form lain) --}}
<form id="delete-car-form"
      method="POST"
      action="{{ route('admin.cars.destroy', $car) }}"
      style="display:none">
  @csrf
  @method('DELETE')
</form>

</div>{{-- end x-data mainTab --}}


@push('scripts')
<script>
/* ========= IMAGE MANAGER (tab foto) ========= */
function imageManager(carId) {
  return {
    activeTab: 'galeri',
    async uploadImages(tipe, form) {
      const data = new FormData(form);
      data.append('tipe_gambar', tipe);
      const warnaNama = form.querySelector('input[name="warna_nama"]');
      if (warnaNama && warnaNama.value) data.set('warna_nama', warnaNama.value);
      const token = document.querySelector('meta[name=csrf-token]').content;
      const res  = await fetch(`/admin/cars/${carId}/images`, {
        method: 'POST', body: data, headers: { 'X-CSRF-TOKEN': token }
      });
      const json = await res.json();
      if (json.success) { alert('Upload berhasil!'); location.reload(); }
      else alert('Upload gagal, coba lagi.');
    }
  }
}

/* ========= HIGHLIGHT HELPERS ========= */
function addHighlight(carId) {
  const wrapper = document.getElementById('highlights-wrapper');
  const i = wrapper.children.length;
  wrapper.insertAdjacentHTML('beforeend', `
    <div class="bg-white shadow-sm" id="hl-block-${i}">
      <div class="flex items-center justify-between px-6 py-3.5 bg-gray-50 border-b border-gray-200">
        <div class="flex items-center gap-3">
          <span class="w-6 h-6 bg-red-600 text-white text-xs font-bold flex items-center justify-center">${i+1}</span>
          <span class="font-bold text-xs uppercase tracking-widest text-gray-700">Section #${i+1}</span>
        </div>
        <button type="button" onclick="removeHighlight(${i})"
                class="text-xs text-red-500 hover:text-red-700 font-semibold uppercase tracking-wide transition-colors">Hapus Section</button>
      </div>
      <div class="p-6 space-y-5">
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Judul *</label>
            <input type="text" name="highlights[${i}][judul]" placeholder="Contoh: Beyond Eksterior"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 transition-colors">
          </div>
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-1.5">Deskripsi</label>
            <textarea name="highlights[${i}][deskripsi]" rows="2" placeholder="Deskripsi singkat..."
                      class="w-full border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-red-600 resize-none"></textarea>
          </div>
        </div>
        <div class="bg-gray-50 border border-gray-200 p-4">
          <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">Gambar Utama (Hero)</p>
          <div id="hero-preview-${i}"
               class="w-full h-32 bg-white border-2 border-dashed border-gray-300 flex flex-col items-center justify-center gap-2 mb-3">
            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="text-xs text-gray-400">Belum ada gambar utama</span>
          </div>
          <div class="flex gap-2 items-center">
            <input type="file" accept="image/*" id="hero-file-${i}"
                   class="flex-1 text-xs text-gray-600 border border-gray-200 bg-white px-3 py-2 cursor-pointer
                          file:mr-3 file:py-1.5 file:px-3 file:border-0 file:rounded-none
                          file:text-xs file:font-bold file:uppercase file:tracking-wide
                          file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
            <button type="button" id="hero-btn-${i}" onclick="uploadHero(${i},${carId})"
                    class="flex-shrink-0 bg-red-600 text-white text-xs font-bold uppercase tracking-wide px-5 py-2 hover:bg-red-700 transition-colors">Upload</button>
          </div>
        </div>
        <div>
          <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">Sub Gambar & Caption</p>
          <div id="sub-wrapper-${i}" class="space-y-3"></div>
          <button type="button" onclick="addSubItem(${i},${carId})"
                  class="mt-3 w-full flex items-center justify-center gap-1.5 border border-dashed border-gray-300
                         hover:border-red-400 text-gray-400 hover:text-red-600
                         text-xs font-bold uppercase tracking-widest py-3 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Sub Gambar
          </button>
        </div>
      </div>
    </div>`);
}

function removeHighlight(i) {
  if (!confirm('Hapus section ini?')) return;
  document.getElementById('hl-block-' + i)?.remove();
}

function addSubItem(hlIndex, carId) {
  const wrapper = document.getElementById('sub-wrapper-' + hlIndex);
  const j = wrapper.children.length;
  wrapper.insertAdjacentHTML('beforeend', `
    <div class="border border-gray-200 bg-white" id="sub-${hlIndex}-${j}">
      <div class="flex items-center justify-between px-4 py-2 bg-gray-50 border-b border-gray-100">
        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Sub Gambar #${j+1}</span>
        <button type="button" onclick="document.getElementById('sub-${hlIndex}-${j}').remove()"
                class="text-gray-400 hover:text-red-500 text-xs font-semibold transition-colors">Hapus</button>
      </div>
      <div class="p-4">
        <div class="flex gap-4">
          <div class="flex-shrink-0 w-36">
            <div id="sub-preview-${hlIndex}-${j}"
                 class="w-36 h-24 bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center gap-1 mb-2">
              <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
              </svg>
              <span class="text-[10px] text-gray-400">Belum ada</span>
            </div>
            <input type="file" accept="image/*" id="sub-file-${hlIndex}-${j}"
                   class="w-full text-[10px] text-gray-600 border border-gray-200 bg-white px-2 py-1.5 cursor-pointer mb-1.5
                          file:mr-2 file:py-1 file:px-2 file:border-0 file:rounded-none
                          file:text-[10px] file:font-bold file:uppercase
                          file:bg-gray-800 file:text-white file:cursor-pointer hover:file:bg-gray-700">
            <button type="button" id="sub-btn-${hlIndex}-${j}" onclick="uploadSub(${hlIndex},${j},${carId})"
                    class="w-full bg-red-600 text-white text-[10px] font-bold uppercase tracking-wide py-1.5 hover:bg-red-700 transition-colors">
              Upload Gambar
            </button>
          </div>
          <div class="flex-1 space-y-2 min-w-0">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Caption</label>
              <input type="text" name="highlights[${hlIndex}][sub_items][${j}][caption]" placeholder="Judul / caption gambar"
                     class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600 transition-colors">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Deskripsi</label>
              <textarea name="highlights[${hlIndex}][sub_items][${j}][deskripsi]" rows="3" placeholder="Deskripsi gambar (opsional)..."
                        class="w-full border border-gray-200 px-3 py-2 text-xs focus:outline-none focus:border-red-600 resize-none transition-colors"></textarea>
            </div>
            <input type="hidden" name="highlights[${hlIndex}][sub_items][${j}][gambar_existing]"
                   value="" id="sub-hidden-${hlIndex}-${j}">
          </div>
        </div>
      </div>
    </div>`);
}

/* ========= UPLOAD FUNCTIONS ========= */
async function uploadHero(i, carId) {
  const fileInput = document.getElementById('hero-file-' + i);
  const btn = document.getElementById('hero-btn-' + i);
  if (!fileInput.files[0]) { alert('Pilih gambar dulu!'); return; }
  btn.textContent = '...'; btn.disabled = true;
  const fd = new FormData();
  fd.append('gambar', fileInput.files[0]);
  fd.append('index', i); fd.append('tipe', 'hero');
  fd.append('_token', document.querySelector('meta[name=csrf-token]').content);
  try {
    const res = await fetch('/admin/cars/' + carId + '/highlights/image', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      btn.textContent = '✓ Berhasil';
      btn.classList.replace('bg-red-600', 'bg-green-600');
      const preview = document.getElementById('hero-preview-' + i);
      if (preview.tagName === 'DIV') {
        preview.outerHTML = `<img id="hero-preview-${i}" src="${data.url}" class="w-full max-h-52 object-cover border border-gray-200 mb-3">`;
      } else { preview.src = data.url; }
    } else { alert('Upload gagal!'); btn.textContent = 'Upload'; }
  } catch(e) { alert('Upload gagal!'); btn.textContent = 'Upload'; }
  btn.disabled = false;
}

async function uploadSub(i, j, carId) {
  const fileInput = document.getElementById('sub-file-' + i + '-' + j);
  const btn = document.getElementById('sub-btn-' + i + '-' + j);
  if (!fileInput.files[0]) { alert('Pilih gambar dulu!'); return; }
  btn.textContent = '...'; btn.disabled = true;
  const fd = new FormData();
  fd.append('gambar', fileInput.files[0]);
  fd.append('index', i); fd.append('tipe', 'sub'); fd.append('sub_index', j);
  fd.append('_token', document.querySelector('meta[name=csrf-token]').content);
  try {
    const res = await fetch('/admin/cars/' + carId + '/highlights/image', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      btn.textContent = '✓ Berhasil';
      btn.classList.replace('bg-red-600', 'bg-green-600');
      const hidden = document.getElementById('sub-hidden-' + i + '-' + j);
      if (hidden) hidden.value = data.path;
      const preview = document.getElementById('sub-preview-' + i + '-' + j);
      if (preview.tagName === 'DIV') {
        preview.outerHTML = `<img id="sub-preview-${i}-${j}" src="${data.url}" class="w-36 h-24 object-cover border border-gray-200 mb-2">`;
      } else { preview.src = data.url; }
    } else { alert('Upload gagal!'); btn.textContent = 'Upload Gambar'; }
  } catch(e) { alert('Upload gagal!'); btn.textContent = 'Upload Gambar'; }
  btn.disabled = false;
}

async function deleteImage(id, el) {
  if (!confirm('Hapus foto ini?')) return;
  const token = document.querySelector('meta[name=csrf-token]').content;
  const res = await fetch(`/admin/cars/images/${id}`, {
    method: 'DELETE', headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
  });
  const json = await res.json();
  if (json.success) el.remove();
  else alert('Gagal menghapus foto.');
}
</script>
@endpush

@endsection

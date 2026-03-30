@extends('layouts.admin')
@section('title', 'Edit Mobil – ' . $car->nama_mobil)

@section('admin_content')

<div class="mb-6">
  <a href="{{ route('admin.cars.index') }}"
     class="text-sm text-gray-400 hover:text-gray-700 transition-colors">
    &larr; Kembali ke Daftar Mobil
  </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">

  {{-- FORM UTAMA --}}
  <div class="lg:col-span-2 space-y-5">

    {{-- INFO DASAR --}}
    <form method="POST" action="{{ route('admin.cars.update', $car) }}">
      @csrf
      @method('PUT')

      <div class="bg-white p-6 shadow-sm space-y-4">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3">
          Informasi Dasar
        </h3>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Nama Mobil *
          </label>
          <input type="text" name="nama_mobil" required
                 value="{{ old('nama_mobil', $car->nama_mobil) }}"
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
              <option value="{{ $kat }}"
                      {{ old('kategori', $car->kategori) === $kat ? 'selected' : '' }}>
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
                   value="{{ old('harga_mulai', $car->harga_mulai) }}"
                   class="w-full border border-gray-200 px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-600 transition-colors">
          </div>
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
            Deskripsi
          </label>
          <textarea name="deskripsi" rows="4"
                    class="w-full border border-gray-200 px-4 py-2.5 text-sm
                           focus:outline-none focus:border-red-600 transition-colors resize-none">{{ old('deskripsi', $car->deskripsi) }}</textarea>
        </div>

        {{-- SPESIFIKASI --}}
        <div class="border-t border-gray-100 pt-4">
        <p class="font-bold text-sm uppercase tracking-wide text-gray-700 mb-4">Spesifikasi Kendaraan</p>

        {{-- Mesin --}}
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Mesin</p>
        <div class="grid grid-cols-3 gap-3 mb-5">
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Kapasitas</label>
            <input type="text" name="spek[mesin][kapasitas]"
                    value="{{ old('spek.mesin.kapasitas', $car->spesifikasi['mesin']['kapasitas'] ?? '') }}"
                    placeholder="1496 cc"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
            </div>
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Tenaga</label>
            <input type="text" name="spek[mesin][tenaga]"
                    value="{{ old('spek.mesin.tenaga', $car->spesifikasi['mesin']['tenaga'] ?? '') }}"
                    placeholder="98 hp"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
            </div>
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Torsi</label>
            <input type="text" name="spek[mesin][torsi]"
                    value="{{ old('spek.mesin.torsi', $car->spesifikasi['mesin']['torsi'] ?? '') }}"
                    placeholder="140 Nm"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
            </div>
        </div>

        {{-- Umum --}}
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Umum</p>
        <div class="grid grid-cols-2 gap-3 mb-5">
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Transmisi</label>
            <select name="spek[transmisi]"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
                <option value="">-- Pilih --</option>
                @foreach(['Manual 5-Speed','Manual 6-Speed','AT','CVT','Automatic 4-Speed','Automatic 6-Speed'] as $t)
                <option value="{{ $t }}"
                        {{ old('spek.transmisi', $car->spesifikasi['transmisi'] ?? '') === $t ? 'selected' : '' }}>
                {{ $t }}
                </option>
                @endforeach
            </select>
            </div>
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Bahan Bakar</label>
            <select name="spek[bahan_bakar]"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
                <option value="">-- Pilih --</option>
                @foreach(['Bensin','Solar','Hybrid','Electric'] as $b)
                <option value="{{ $b }}"
                        {{ old('spek.bahan_bakar', $car->spesifikasi['bahan_bakar'] ?? '') === $b ? 'selected' : '' }}>
                {{ $b }}
                </option>
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
                    value="{{ old('spek.dimensi.panjang', $car->spesifikasi['dimensi']['panjang'] ?? '') }}"
                    placeholder="4395 mm"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
            </div>
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Lebar</label>
            <input type="text" name="spek[dimensi][lebar]"
                    value="{{ old('spek.dimensi.lebar', $car->spesifikasi['dimensi']['lebar'] ?? '') }}"
                    placeholder="1730 mm"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
            </div>
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Tinggi</label>
            <input type="text" name="spek[dimensi][tinggi]"
                    value="{{ old('spek.dimensi.tinggi', $car->spesifikasi['dimensi']['tinggi'] ?? '') }}"
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
                    value="{{ old('spek.interior.kapasitas_penumpang', $car->spesifikasi['interior']['kapasitas_penumpang'] ?? '') }}"
                    placeholder="7" min="1" max="10"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
            </div>
            <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Kapasitas Bagasi</label>
            <input type="text" name="spek[interior][kapasitas_bagasi]"
                    value="{{ old('spek.interior.kapasitas_bagasi', $car->spesifikasi['interior']['kapasitas_bagasi'] ?? '') }}"
                    placeholder="270 L"
                    class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
            </div>
        </div>

        {{-- Fitur --}}
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Fitur Unggulan</p>
        <div class="grid grid-cols-2 gap-2">
            @php
            $activeFitur = old('spek.fitur', $car->spesifikasi['fitur'] ?? []);
            @endphp
            @foreach([
            'Toyota Safety Sense', 'Android Auto', 'Apple CarPlay',
            'Dual SRS Airbag', 'ABS', 'VSC', 'Hill Start Assist',
            'Rear Parking Camera', 'Wireless Charger', 'Panoramic Roof',
            'Cruise Control', '4x4 AWD', 'Lane Departure Alert', 'Blind Spot Monitor'
            ] as $fitur)
            <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="spek[fitur][]" value="{{ $fitur }}"
                    {{ is_array($activeFitur) && in_array($fitur, $activeFitur) ? 'checked' : '' }}
                    class="w-4 h-4 accent-red-600">
            <span class="text-sm text-gray-700">{{ $fitur }}</span>
            </label>
            @endforeach
        </div>

        {{-- HIGHLIGHTS --}}
        <div class="bg-white p-6 shadow-sm mt-5">
          <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-2">
            Highlights Section
          </h3>
          <p class="text-xs text-gray-400 mb-6">
            Tambahkan section highlight untuk halaman detail mobil.
            Isi judul, deskripsi, upload gambar utama, dan sub gambar langsung di sini.
          </p>

          <div id="highlights-wrapper" class="space-y-6 mb-6">
            @foreach($car->highlights ?? [] as $i => $hl)
            <div class="border border-gray-200 rounded-sm p-5 bg-gray-50"
                id="hl-block-{{ $i }}">

              {{-- Header --}}
              <div class="flex items-center justify-between mb-4">
                <span class="font-bold text-xs uppercase tracking-wider text-gray-600">
                  Section #{{ $i + 1 }}
                </span>
                <button type="button"
                        onclick="removeHighlight({{ $i }})"
                        class="text-xs text-red-500 hover:text-red-700 font-semibold">
                  Hapus Section
                </button>
              </div>

              {{-- Judul --}}
              <div class="mb-3">
                <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
                  Judul Section *
                </label>
                <input type="text"
                      name="highlights[{{ $i }}][judul]"
                      value="{{ $hl['judul'] ?? '' }}"
                      placeholder="Contoh: Beyond Eksterior"
                      class="w-full border border-gray-200 px-3 py-2 text-sm
                              focus:outline-none focus:border-red-600 transition-colors">
              </div>

              {{-- Deskripsi --}}
              <div class="mb-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
                  Deskripsi Section
                </label>
                <textarea name="highlights[{{ $i }}][deskripsi]"
                          rows="2"
                          placeholder="Deskripsi singkat tentang section ini..."
                          class="w-full border border-gray-200 px-3 py-2 text-sm
                                focus:outline-none focus:border-red-600 resize-none">{{ $hl['deskripsi'] ?? '' }}</textarea>
              </div>

              {{-- Gambar Hero --}}
              <div class="mb-5 p-4 bg-white border border-gray-200">
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-3">
                  Gambar Utama (Hero)
                </label>
                @if(!empty($hl['gambar_hero']))
                <input type="hidden"
                      name="highlights[{{ $i }}][gambar_hero_existing]"
                      value="{{ $hl['gambar_hero'] }}">
                <img src="{{ asset('storage/' . $hl['gambar_hero']) }}"
                    alt="Hero"
                    class="w-full max-h-48 object-cover mb-3 border border-gray-100"
                    id="hero-preview-{{ $i }}">
                @else
                <div class="w-full h-32 bg-gray-100 border border-dashed border-gray-300
                            flex items-center justify-center mb-3"
                    id="hero-preview-{{ $i }}">
                  <p class="text-gray-400 text-xs">Belum ada gambar utama</p>
                </div>
                @endif
                <div class="flex gap-2">
                  <input type="file" accept="image/*"
                        id="hero-file-{{ $i }}"
                        class="flex-1 text-xs text-gray-500
                                file:mr-2 file:py-1.5 file:px-3 file:border-0
                                file:text-xs file:font-semibold
                                file:bg-gray-900 file:text-white cursor-pointer">
                  <button type="button"
                          id="hero-btn-{{ $i }}"
                          onclick="uploadHero({{ $i }}, {{ $car->id }})"
                          class="bg-red-600 text-white font-semibold text-xs
                                uppercase px-4 py-1.5 hover:bg-red-700 transition-colors">
                    Upload
                  </button>
                </div>
              </div>

              {{-- Sub Items --}}
              <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-3">
                  Sub Gambar & Caption
                </label>
                <div id="sub-wrapper-{{ $i }}" class="space-y-3">
                  @foreach($hl['sub_items'] ?? [] as $j => $sub)
                  <div class="flex gap-3 p-3 bg-white border border-gray-200"
                      id="sub-{{ $i }}-{{ $j }}">
                    {{-- Preview --}}
                    <div class="flex-shrink-0 w-32">
                      @if(!empty($sub['gambar']))
                      <input type="hidden"
                            name="highlights[{{ $i }}][sub_items][{{ $j }}][gambar_existing]"
                            value="{{ $sub['gambar'] }}">
                      <img src="{{ asset('storage/' . $sub['gambar']) }}"
                          class="w-32 h-20 object-cover border border-gray-100 mb-1"
                          id="sub-preview-{{ $i }}-{{ $j }}">
                      @else
                      <div class="w-32 h-20 bg-gray-100 border border-dashed border-gray-300
                                  flex items-center justify-center mb-1 text-[10px] text-gray-400"
                          id="sub-preview-{{ $i }}-{{ $j }}">
                        Belum ada
                      </div>
                      @endif
                      <div class="flex gap-1">
                        <input type="file" accept="image/*"
                              id="sub-file-{{ $i }}-{{ $j }}"
                              class="hidden">
                        <label for="sub-file-{{ $i }}-{{ $j }}"
                              class="flex-1 text-center bg-gray-900 text-white text-[10px]
                                      font-semibold py-1 cursor-pointer hover:bg-gray-700">
                          Pilih
                        </label>
                        <button type="button"
                                id="sub-btn-{{ $i }}-{{ $j }}"
                                onclick="uploadSub({{ $i }}, {{ $j }}, {{ $car->id }})"
                                class="flex-1 bg-red-600 text-white text-[10px]
                                      font-semibold py-1 hover:bg-red-700">
                          Upload
                        </button>
                      </div>
                    </div>
                    {{-- Caption & Deskripsi --}}
                    <div class="flex-1 space-y-2">
                      <input type="text"
                            name="highlights[{{ $i }}][sub_items][{{ $j }}][caption]"
                            value="{{ $sub['caption'] ?? '' }}"
                            placeholder="Judul/Caption gambar"
                            class="w-full border border-gray-200 px-3 py-1.5 text-sm
                                    focus:outline-none focus:border-red-600">
                      <textarea name="highlights[{{ $i }}][sub_items][{{ $j }}][deskripsi]"
                                rows="2"
                                placeholder="Deskripsi gambar..."
                                class="w-full border border-gray-200 px-3 py-1.5 text-xs
                                      focus:outline-none focus:border-red-600 resize-none">{{ $sub['deskripsi'] ?? '' }}</textarea>
                      <input type="hidden"
                            name="highlights[{{ $i }}][sub_items][{{ $j }}][gambar_existing]"
                            value="{{ $sub['gambar'] ?? '' }}"
                            id="sub-hidden-{{ $i }}-{{ $j }}">
                    </div>
                    <button type="button"
                            onclick="document.getElementById('sub-{{ $i }}-{{ $j }}').remove()"
                            class="text-gray-300 hover:text-red-500 transition-colors flex-shrink-0 self-start">
                      &times;
                    </button>
                  </div>
                  @endforeach
                </div>

                <button type="button"
                        onclick="addSubItem({{ $i }}, {{ $car->id }})"
                        class="mt-3 flex items-center gap-1 text-xs font-semibold
                              text-gray-500 hover:text-red-600 transition-colors border
                              border-dashed border-gray-300 hover:border-red-400 px-4 py-2 w-full
                              justify-center">
                  + Tambah Sub Gambar
                </button>
              </div>

            </div>
            @endforeach
          </div>

          {{-- Tambah Section Baru --}}
          <button type="button"
                  onclick="addHighlight({{ $car->id }})"
                  class="flex items-center gap-2 text-sm font-semibold text-red-600
                        hover:text-red-700 transition-colors border border-red-200
                        hover:border-red-400 px-5 py-2.5 w-full justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Section Highlight
          </button>

        </div>

        {{-- WARNA TERSEDIA --}}
        <div class="bg-white p-6 shadow-sm mt-5">
        <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
            Warna Tersedia
        </h3>

        <div x-data="{
            warnas: {{ json_encode($car->warna_tersedia ?? [['nama' => '', 'hex' => '#ffffff']]) }},
            tambah() { this.warnas.push({ nama: '', hex: '#ffffff' }) },
            hapus(i) { if (this.warnas.length > 1) this.warnas.splice(i, 1) }
        }">

            <div class="space-y-3 mb-4">
            <template x-for="(warna, i) in warnas" :key="i">
                <div class="flex items-center gap-3">
                <input type="color"
                        :name="'warna[' + i + '][hex]'"
                        x-model="warna.hex"
                        class="w-10 h-10 border border-gray-200 cursor-pointer p-0.5">

                <input type="text"
                        :name="'warna[' + i + '][nama]'"
                        x-model="warna.nama"
                        placeholder="Contoh: Putih Pearl, Hitam Metalik"
                        class="flex-1 border border-gray-200 px-3 py-2 text-sm
                                focus:outline-none focus:border-red-600 transition-colors">

                <div class="w-8 h-8 rounded-full border border-gray-200 flex-shrink-0"
                    :style="'background-color: ' + warna.hex"></div>

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
        </div>

        <div class="space-y-3 pt-2">
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', $car->is_active) ? 'checked' : '' }}
                   class="w-4 h-4 accent-red-600">
            <div>
              <p class="text-sm font-medium text-gray-900">Aktif</p>
              <p class="text-xs text-gray-400">Tampil di website</p>
            </div>
          </label>
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_featured" value="1"
                   {{ old('is_featured', $car->is_featured) ? 'checked' : '' }}
                   class="w-4 h-4 accent-red-600">
            <div>
              <p class="text-sm font-medium text-gray-900">Unggulan</p>
              <p class="text-xs text-gray-400">Tampil di halaman beranda</p>
            </div>
          </label>
        </div>

        <div class="flex gap-3 pt-2">
          <button type="submit"
                  class="bg-red-600 text-white font-semibold uppercase text-sm
                         tracking-wide px-6 py-3 hover:bg-red-700 transition-colors">
            Simpan Perubahan
          </button>
          <a href="{{ route('admin.cars.index') }}"
             class="border border-gray-200 text-gray-500 font-semibold uppercase
                    text-sm tracking-wide px-6 py-3 hover:bg-gray-50 transition-colors">
            Batal
          </a>
        </div>
      </div>

    </form>

    {{-- KELOLA FOTO --}}
    <div class="bg-white p-6 shadow-sm" x-data="imageManager({{ $car->id }})">
      <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
        Kelola Foto
      </h3>

      {{-- Tab --}}
      <div class="flex gap-2 mb-5">
        <button @click="activeTab = 'galeri'"
                :class="activeTab === 'galeri' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600'"
                class="px-4 py-2 text-xs font-semibold uppercase tracking-wide transition-colors">
          Foto Galeri ({{ $car->galleryImages->count() }})
        </button>
        <button @click="activeTab = '360_degree'"
                :class="activeTab === '360_degree' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600'"
                class="px-4 py-2 text-xs font-semibold uppercase tracking-wide transition-colors">
          Foto 360 ({{ $car->threeSixtyImages->count() }}/8)
        </button>
      </div>
      {{-- Foto Galeri --}}
        <div x-show="activeTab === 'galeri'">

        {{-- Gambar Umum (tanpa warna) --}}
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
            Foto Umum
        </p>
        @if($car->galleryImagesNoWarna->isNotEmpty())
        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mb-3">
            @foreach($car->galleryImagesNoWarna as $img)
            <div class="relative group aspect-square">
            <img src="{{ $img->url }}" class="w-full h-full object-cover">
            <button type="button"
                    onclick="deleteImage({{ $img->id }}, this.closest('.relative'))"
                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100
                            flex items-center justify-center text-white text-xs font-semibold
                            transition-opacity">
                Hapus
            </button>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-400 text-xs mb-3">Belum ada foto umum.</p>
        @endif

        <form @submit.prevent="uploadImages('galeri', $event.target)" class="space-y-2 mb-6">
            @csrf
            <input type="hidden" name="warna_nama" value="">
            <input type="file" name="images[]" multiple accept="image/*"
                class="w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4 file:border-0
                        file:text-xs file:font-semibold file:uppercase
                        file:bg-gray-900 file:text-white
                        hover:file:bg-gray-700 cursor-pointer">
            <button type="submit"
                    class="w-full bg-gray-900 text-white font-semibold uppercase
                        text-xs tracking-wide py-2.5 hover:bg-gray-700 transition-colors">
            Upload Foto Umum
            </button>
        </form>

        {{-- Gambar Per Warna --}}
        @if(!empty($car->warna_tersedia))
        <div class="border-t border-gray-100 pt-4">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">
            Foto Per Warna
            </p>

            @foreach($car->warna_tersedia as $warna)
            <div class="mb-5 bg-gray-50 p-4">
            {{-- Header warna --}}
            <div class="flex items-center gap-2 mb-3">
                <div class="w-5 h-5 rounded-full border border-gray-200"
                    style="background-color: {{ $warna['hex'] }}"></div>
                <p class="font-semibold text-sm text-gray-900">{{ $warna['nama'] }}</p>
                <span class="text-xs text-gray-400">
                ({{ $car->imagesByWarna($warna['nama'])->count() }} foto)
                </span>
            </div>

            {{-- Grid foto warna --}}
            @if($car->imagesByWarna($warna['nama'])->count() > 0)
            <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mb-3">
                @foreach($car->imagesByWarna($warna['nama'])->get() as $img)
                <div class="relative group aspect-square">
                <img src="{{ $img->url }}" class="w-full h-full object-cover">
                <button type="button"
                        onclick="deleteImage({{ $img->id }}, this.closest('.relative'))"
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100
                                flex items-center justify-center text-white text-xs font-semibold
                                transition-opacity">
                    Hapus
                </button>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 text-xs mb-3">Belum ada foto untuk warna ini.</p>
            @endif

            {{-- Form upload warna --}}
            <form @submit.prevent="uploadImages('galeri', $event.target)" class="space-y-2">
                @csrf
                <input type="hidden" name="warna_nama" value="{{ $warna['nama'] }}">
                <input type="file" name="images[]" multiple accept="image/*"
                    class="w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4 file:border-0
                            file:text-xs file:font-semibold file:uppercase
                            file:bg-gray-900 file:text-white
                            hover:file:bg-gray-700 cursor-pointer">
                <button type="submit"
                        class="w-full bg-gray-900 text-white font-semibold uppercase
                            text-xs tracking-wide py-2.5 hover:bg-gray-700 transition-colors">
                Upload Foto {{ $warna['nama'] }}
                </button>
            </form>
            </div>
            @endforeach
        </div>
        @else
        <div class="border-t border-gray-100 pt-4">
            <p class="text-xs text-gray-400">
            Belum ada warna tersedia. Tambahkan warna dulu di form di atas,
            lalu simpan sebelum upload foto per warna.
            </p>
        </div>
        @endif

        </div>

      {{-- Foto 360 --}}
      <div x-show="activeTab === '360_degree'">
        <div class="bg-blue-50 border border-blue-200 p-3 text-xs text-blue-700 mb-4">
          Upload tepat 8 foto secara berurutan searah jarum jam untuk tampilan 360 derajat.
        </div>

        @if($car->threeSixtyImages->isNotEmpty())
        <div class="grid grid-cols-4 gap-2 mb-4">
          @foreach($car->threeSixtyImages as $img)
          <div class="relative group aspect-square">
            <img src="{{ $img->url }}" class="w-full h-full object-cover">
            <div class="absolute top-1 left-1 bg-black/70 text-white text-[10px] px-1 font-bold">
              {{ $img->urutan + 1 }}
            </div>
            <button type="button"
                    onclick="deleteImage({{ $img->id }}, this.closest('.relative'))"
                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100
                           flex items-center justify-center text-white text-xs font-semibold
                           transition-opacity">
              Hapus
            </button>
          </div>
          @endforeach
        </div>
        @else
        <p class="text-gray-400 text-sm mb-4">Belum ada foto 360 derajat.</p>
        @endif

        <form @submit.prevent="uploadImages('360_degree', $event.target)" class="space-y-2">
          @csrf
          <input type="file" name="images[]" multiple accept="image/*"
                 class="w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4 file:border-0
                        file:text-xs file:font-semibold file:uppercase
                        file:bg-gray-900 file:text-white
                        hover:file:bg-gray-700 cursor-pointer">
          <button type="submit"
                  class="w-full bg-gray-900 text-white font-semibold uppercase
                         text-xs tracking-wide py-2.5 hover:bg-gray-700 transition-colors">
            Upload Foto 360
          </button>
        </form>
      </div>
    </div>

  </div>

  {{-- SIDEBAR INFO --}}
  <div class="space-y-5">
    <div class="bg-white p-6 shadow-sm">
      <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3 mb-4">
        Info Mobil
      </h3>
      <dl class="space-y-3 text-sm">
        <div>
          <dt class="text-xs text-gray-400 uppercase tracking-wide">Slug</dt>
          <dd class="font-mono text-xs text-gray-700 mt-0.5">{{ $car->slug }}</dd>
        </div>
        <div>
          <dt class="text-xs text-gray-400 uppercase tracking-wide">Dibuat</dt>
          <dd class="text-gray-700 mt-0.5">{{ $car->created_at->format('d M Y') }}</dd>
        </div>
        <div>
          <dt class="text-xs text-gray-400 uppercase tracking-wide">Diperbarui</dt>
          <dd class="text-gray-700 mt-0.5">{{ $car->updated_at->format('d M Y H:i') }}</dd>
        </div>
      </dl>
      <div class="mt-4 pt-4 border-t border-gray-100">
        <a href="{{ route('cars.show', $car->slug) }}" target="_blank"
           class="block text-center text-xs font-semibold uppercase tracking-wide
                  border border-gray-200 py-2 text-gray-500
                  hover:border-red-600 hover:text-red-600 transition-colors">
          Lihat di Website
        </a>
      </div>
    </div>

    <div class="bg-white p-6 shadow-sm">
      <h3 class="font-bold text-sm uppercase tracking-wide text-red-600 border-b border-gray-100 pb-3 mb-4">
        Hapus Mobil
      </h3>
      <p class="text-xs text-gray-400 mb-4">
        Menghapus mobil akan menghapus semua foto terkait secara permanen.
      </p>
      <form method="POST" action="{{ route('admin.cars.destroy', $car) }}"
            onsubmit="return confirm('Hapus mobil ini secara permanen?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="w-full border-2 border-red-600 text-red-600 font-semibold
                       uppercase text-xs tracking-wide py-2.5
                       hover:bg-red-600 hover:text-white transition-colors">
          Hapus Mobil Ini
        </button>
      </form>
    </div>
  </div>

</div>

<script>
function addHighlight(carId) {
  const wrapper = document.getElementById('highlights-wrapper');
  const i       = wrapper.children.length;
  const html    = `
    <div class="border border-gray-200 rounded-sm p-5 bg-gray-50" id="hl-block-${i}">
      <div class="flex items-center justify-between mb-4">
        <span class="font-bold text-xs uppercase tracking-wider text-gray-600">Section #${i + 1}</span>
        <button type="button" onclick="removeHighlight(${i})"
                class="text-xs text-red-500 hover:text-red-700 font-semibold">Hapus Section</button>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">Judul Section *</label>
        <input type="text" name="highlights[${i}][judul]"
               placeholder="Contoh: Beyond Eksterior"
               class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600">
      </div>
      <div class="mb-5">
        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">Deskripsi Section</label>
        <textarea name="highlights[${i}][deskripsi]" rows="2"
                  placeholder="Deskripsi singkat..."
                  class="w-full border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-red-600 resize-none"></textarea>
      </div>
      <div class="mb-5 p-4 bg-white border border-gray-200">
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-3">Gambar Utama (Hero)</label>
        <div class="w-full h-32 bg-gray-100 border border-dashed border-gray-300
                    flex items-center justify-center mb-3 text-xs text-gray-400"
             id="hero-preview-${i}">Belum ada gambar utama</div>
        <div class="flex gap-2">
          <input type="file" accept="image/*" id="hero-file-${i}"
                 class="flex-1 text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3
                        file:border-0 file:text-xs file:font-semibold file:bg-gray-900
                        file:text-white cursor-pointer">
          <button type="button" id="hero-btn-${i}"
                  onclick="uploadHero(${i}, ${carId})"
                  class="bg-red-600 text-white font-semibold text-xs uppercase px-4 py-1.5 hover:bg-red-700">
            Upload
          </button>
        </div>
      </div>
      <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-3">Sub Gambar & Caption</label>
        <div id="sub-wrapper-${i}" class="space-y-3"></div>
        <button type="button" onclick="addSubItem(${i}, ${carId})"
                class="mt-3 flex items-center gap-1 text-xs font-semibold text-gray-500
                       hover:text-red-600 border border-dashed border-gray-300
                       hover:border-red-400 px-4 py-2 w-full justify-center">
          + Tambah Sub Gambar
        </button>
      </div>
    </div>`;
  wrapper.insertAdjacentHTML('beforeend', html);
}

function removeHighlight(i) {
  if (!confirm('Hapus section ini?')) return;
  document.getElementById('hl-block-' + i).remove();
}

function addSubItem(hlIndex, carId) {
  const wrapper = document.getElementById('sub-wrapper-' + hlIndex);
  const j       = wrapper.children.length;
  const html    = `
    <div class="flex gap-3 p-3 bg-white border border-gray-200" id="sub-${hlIndex}-${j}">
      <div class="flex-shrink-0 w-32">
        <div class="w-32 h-20 bg-gray-100 border border-dashed border-gray-300
                    flex items-center justify-center mb-1 text-[10px] text-gray-400"
             id="sub-preview-${hlIndex}-${j}">Belum ada</div>
        <div class="flex gap-1">
          <input type="file" accept="image/*" id="sub-file-${hlIndex}-${j}" class="hidden">
          <label for="sub-file-${hlIndex}-${j}"
                 class="flex-1 text-center bg-gray-900 text-white text-[10px]
                        font-semibold py-1 cursor-pointer hover:bg-gray-700">Pilih</label>
          <button type="button" id="sub-btn-${hlIndex}-${j}"
                  onclick="uploadSub(${hlIndex}, ${j}, ${carId})"
                  class="flex-1 bg-red-600 text-white text-[10px] font-semibold py-1 hover:bg-red-700">
            Upload
          </button>
        </div>
      </div>
      <div class="flex-1 space-y-2">
        <input type="text"
               name="highlights[${hlIndex}][sub_items][${j}][caption]"
               placeholder="Judul/Caption gambar"
               class="w-full border border-gray-200 px-3 py-1.5 text-sm focus:outline-none focus:border-red-600">
        <textarea name="highlights[${hlIndex}][sub_items][${j}][deskripsi]"
                  rows="2" placeholder="Deskripsi gambar..."
                  class="w-full border border-gray-200 px-3 py-1.5 text-xs focus:outline-none focus:border-red-600 resize-none"></textarea>
        <input type="hidden"
               name="highlights[${hlIndex}][sub_items][${j}][gambar_existing]"
               value=""
               id="sub-hidden-${hlIndex}-${j}">
      </div>
      <button type="button"
              onclick="document.getElementById('sub-${hlIndex}-${j}').remove()"
              class="text-gray-300 hover:text-red-500 transition-colors flex-shrink-0 self-start">&times;</button>
    </div>`;
  wrapper.insertAdjacentHTML('beforeend', html);
}
</script>


@push('scripts')
<script>
function imageManager(carId) {
  return {
    activeTab: 'galeri',
    async uploadImages(tipe, form) {
    const data = new FormData(form);
    data.append('tipe_gambar', tipe);

    // Pastikan warna_nama ikut terkirim
    const warnaNama = form.querySelector('input[name="warna_nama"]');
    if (warnaNama && warnaNama.value) {
      data.set('warna_nama', warnaNama.value);
    }

    const token = document.querySelector('meta[name=csrf-token]').content;
    const res = await fetch(`/admin/cars/${carId}/images`, {
      method: 'POST',
      body: data,
      headers: { 'X-CSRF-TOKEN': token }
    });
    const json = await res.json();
    if (json.success) {
      alert('Upload berhasil! Halaman akan dimuat ulang.');
      location.reload();
    } else {
      alert('Upload gagal, coba lagi.');
    }
  }
  }
}

// ===== HIGHLIGHT FUNCTIONS =====

async function uploadHero(i, carId) {
  const fileInput = document.getElementById('hero-file-' + i);
  const btn       = document.getElementById('hero-btn-' + i);
  const file      = fileInput.files[0];
  if (!file) { alert('Pilih gambar dulu!'); return; }

  btn.textContent = '...';
  btn.disabled    = true;

  const fd = new FormData();
  fd.append('gambar',    file);
  fd.append('index',     i);
  fd.append('tipe',      'hero');
  fd.append('_token',    document.querySelector('meta[name=csrf-token]').content);

  try {
    const res  = await fetch('/admin/cars/' + carId + '/highlights/image', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      btn.textContent = 'OK';
      btn.classList.replace('bg-red-600', 'bg-green-600');
      const preview = document.getElementById('hero-preview-' + i);
      if (preview.tagName === 'DIV') {
        preview.outerHTML = '<img id="hero-preview-' + i + '" src="' + data.url + '" class="w-full max-h-48 object-cover mb-3 border border-gray-100">';
      } else {
        preview.src = data.url;
      }
    }
  } catch(e) {
    alert('Upload gagal!');
  }
  btn.disabled = false;
}

async function uploadSub(i, j, carId) {
  const fileInput = document.getElementById('sub-file-' + i + '-' + j);
  const btn       = document.getElementById('sub-btn-' + i + '-' + j);
  const file      = fileInput.files[0];
  if (!file) { alert('Pilih gambar dulu!'); return; }

  btn.textContent = '...';
  btn.disabled    = true;

  const fd = new FormData();
  fd.append('gambar',     file);
  fd.append('index',      i);
  fd.append('tipe',       'sub');
  fd.append('sub_index',  j);
  fd.append('_token',     document.querySelector('meta[name=csrf-token]').content);

  try {
    const res  = await fetch('/admin/cars/' + carId + '/highlights/image', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      btn.textContent = 'OK';
      // Update hidden input
      const hidden = document.getElementById('sub-hidden-' + i + '-' + j);
      if (hidden) hidden.value = data.path;
      // Update preview
      const preview = document.getElementById('sub-preview-' + i + '-' + j);
      if (preview.tagName === 'DIV') {
        preview.outerHTML = '<img id="sub-preview-' + i + '-' + j + '" src="' + data.url + '" class="w-32 h-20 object-cover border border-gray-100 mb-1">';
      } else {
        preview.src = data.url;
      }
    }
  } catch(e) {
    alert('Upload gagal!');
  }
  btn.disabled = false;
}



async function deleteImage(id, el) {
  if (!confirm('Hapus foto ini?')) return;
  const token = document.querySelector('meta[name=csrf-token]').content;
  const res = await fetch(`/admin/cars/images/${id}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': token,
      'Accept': 'application/json'
    }
  });
  const json = await res.json();
  if (json.success) {
    el.remove();
  } else {
    alert('Gagal menghapus foto.');
  }
}
</script>
@endpush

@endsection
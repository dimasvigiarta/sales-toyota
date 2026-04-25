@extends('layouts.admin')
@section('title', 'Tambah Mobil Baru')

@section('admin_content')

{{-- HEADER --}}
<div class="flex items-end justify-between mb-8">
  <div>
    <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Manajemen Mobil</p>
    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Tambah Mobil Baru</h2>
  </div>
  <a href="{{ route('admin.cars.index') }}"
     class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-700 transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
    Kembali
  </a>
</div>

{{-- STEP INDICATOR --}}
<div class="flex items-center gap-3 mb-8" id="step-indicator">
  <div class="flex items-center gap-2">
    <div class="w-7 h-7 rounded-full bg-red-600 text-white text-xs font-bold
                flex items-center justify-center" id="step1-circle">1</div>
    <span class="text-sm font-semibold text-gray-700" id="step1-label">Data Mobil</span>
  </div>
  <div class="flex-1 h-px bg-gray-200" id="step-line"></div>
  <div class="flex items-center gap-2">
    <div class="w-7 h-7 rounded-full bg-gray-200 text-gray-400 text-xs font-bold
                flex items-center justify-center" id="step2-circle">2</div>
    <span class="text-sm font-semibold text-gray-400" id="step2-label">Upload Foto</span>
  </div>
</div>

{{-- STEP 1: FORM DATA --}}
<div id="step1">
  <form id="form-car" class="space-y-0">
    @csrf
    <div class="grid lg:grid-cols-3 gap-6">

      <div class="lg:col-span-2 space-y-5">

        {{-- INFO DASAR --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm space-y-4">
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100">
            Informasi Dasar
          </h3>
          <div>
            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1.5">
              Nama Mobil *
            </label>
            <input type="text" name="nama_mobil" required
                   placeholder="Contoh: Toyota Avanza"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors">
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1.5">
                Kategori *
              </label>
              <select name="kategori" required
                      class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm
                             focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                @foreach(['SUV','MPV','Hatchback','Sedan','Pickup','Sport'] as $kat)
                <option value="{{ $kat }}">{{ $kat }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1.5">
                Harga Mulai (Rp) *
              </label>
              <input type="number" name="harga_mulai" required min="0"
                     placeholder="228300000"
                     class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm
                            focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors">
            </div>
          </div>
          <div>
            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1.5">
              Deskripsi
            </label>
            <textarea name="deskripsi" rows="3"
                      placeholder="Deskripsi singkat tentang mobil ini..."
                      class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm
                             focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500
                             transition-colors resize-none"></textarea>
          </div>
        </div>

        {{-- SPESIFIKASI --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100 mb-5">
            Spesifikasi Kendaraan
          </h3>
          <p class="text-xs font-bold uppercase tracking-widest text-gray-300 mb-3">Mesin</p>
          <div class="grid grid-cols-3 gap-3 mb-6">
            @foreach([
              ['name'=>'spek[mesin][kapasitas]','label'=>'Kapasitas','ph'=>'1496 cc'],
              ['name'=>'spek[mesin][tenaga]',   'label'=>'Tenaga',   'ph'=>'103 hp'],
              ['name'=>'spek[mesin][torsi]',    'label'=>'Torsi',    'ph'=>'136 Nm'],
            ] as $f)
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1.5">{{ $f['label'] }}</label>
              <input type="text" name="{{ $f['name'] }}" placeholder="{{ $f['ph'] }}"
                     class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm
                            focus:outline-none focus:border-red-500 transition-colors">
            </div>
            @endforeach
          </div>

          <p class="text-xs font-bold uppercase tracking-widest text-gray-300 mb-3">Umum</p>
          <div class="grid grid-cols-2 gap-3 mb-6">
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1.5">Transmisi</label>
              <select name="spek[transmisi]"
                      class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm
                             focus:outline-none focus:border-red-500">
                <option value="">-- Pilih --</option>
                @foreach(['Manual 5-Speed','Manual 6-Speed','AT','CVT','Automatic 4-Speed','Automatic 6-Speed'] as $t)
                <option value="{{ $t }}">{{ $t }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1.5">Bahan Bakar</label>
              <select name="spek[bahan_bakar]"
                      class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm
                             focus:outline-none focus:border-red-500">
                <option value="">-- Pilih --</option>
                @foreach(['Bensin','Solar','Hybrid','Electric'] as $b)
                <option value="{{ $b }}">{{ $b }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <p class="text-xs font-bold uppercase tracking-widest text-gray-300 mb-3">Dimensi</p>
          <div class="grid grid-cols-3 gap-3 mb-6">
            @foreach([
              ['name'=>'spek[dimensi][panjang]','label'=>'Panjang','ph'=>'4395 mm'],
              ['name'=>'spek[dimensi][lebar]',  'label'=>'Lebar',  'ph'=>'1730 mm'],
              ['name'=>'spek[dimensi][tinggi]', 'label'=>'Tinggi', 'ph'=>'1700 mm'],
            ] as $f)
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1.5">{{ $f['label'] }}</label>
              <input type="text" name="{{ $f['name'] }}" placeholder="{{ $f['ph'] }}"
                     class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm
                            focus:outline-none focus:border-red-500 transition-colors">
            </div>
            @endforeach
          </div>

          <p class="text-xs font-bold uppercase tracking-widest text-gray-300 mb-3">Interior</p>
          <div class="grid grid-cols-2 gap-3 mb-6">
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1.5">Kapasitas Penumpang</label>
              <input type="number" name="spek[interior][kapasitas_penumpang]"
                     placeholder="7" min="1" max="10"
                     class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm
                            focus:outline-none focus:border-red-500 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1.5">Kapasitas Bagasi</label>
              <input type="text" name="spek[interior][kapasitas_bagasi]"
                     placeholder="270 L"
                     class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm
                            focus:outline-none focus:border-red-500 transition-colors">
            </div>
          </div>

          <p class="text-xs font-bold uppercase tracking-widest text-gray-300 mb-3">Fitur Unggulan</p>
          <div class="grid grid-cols-2 gap-2">
            @foreach([
              'Toyota Safety Sense','Android Auto','Apple CarPlay','Dual SRS Airbag',
              'ABS','VSC','Hill Start Assist','Rear Parking Camera',
              'Wireless Charger','Panoramic Roof','Cruise Control','4x4 AWD',
              'Lane Departure Alert','Blind Spot Monitor'
            ] as $fitur)
            <label class="flex items-center gap-2.5 cursor-pointer p-2.5 rounded-xl hover:bg-gray-50 transition-colors">
              <input type="checkbox" name="spek[fitur][]" value="{{ $fitur }}"
                     class="w-4 h-4 accent-red-600 flex-shrink-0">
              <span class="text-sm text-gray-700">{{ $fitur }}</span>
            </label>
            @endforeach
          </div>
        </div>

        {{-- WARNA --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm"
             x-data="{
               warnas: [{ nama: '', hex: '#ffffff' }],
               tambah() { this.warnas.push({ nama: '', hex: '#ffffff' }) },
               hapus(i) { if (this.warnas.length > 1) this.warnas.splice(i, 1) }
             }">
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100 mb-5">
            Warna Tersedia
          </h3>
          <div class="space-y-3 mb-4">
            <template x-for="(warna, i) in warnas" :key="i">
              <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <input type="color" :name="'warna[' + i + '][hex]'" x-model="warna.hex"
                       class="w-10 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5 flex-shrink-0">
                <input type="text" :name="'warna[' + i + '][nama]'" x-model="warna.nama"
                       placeholder="Contoh: Putih Pearl"
                       class="flex-1 border border-gray-200 rounded-xl px-3 py-2 text-sm
                              focus:outline-none focus:border-red-500 bg-white transition-colors">
                <div class="w-8 h-8 rounded-full border-2 border-white shadow-sm flex-shrink-0"
                     :style="'background-color: ' + warna.hex"></div>
                <button type="button" @click="hapus(i)"
                        class="text-gray-300 hover:text-red-500 transition-colors flex-shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </div>
            </template>
          </div>
          <button type="button" @click="tambah()"
                  class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Warna
          </button>
        </div>

      </div>

      {{-- SIDEBAR --}}
      <div class="space-y-5">
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
          <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100 mb-4">
            Publikasi
          </h3>
          <div class="space-y-3 mb-6">
            <label class="flex items-center gap-3 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-colors">
              <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 accent-red-600">
              <div>
                <p class="text-sm font-semibold text-gray-900">Aktif</p>
                <p class="text-xs text-gray-400">Tampil di website</p>
              </div>
            </label>
            <label class="flex items-center gap-3 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-colors">
              <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 accent-red-600">
              <div>
                <p class="text-sm font-semibold text-gray-900">Unggulan</p>
                <p class="text-xs text-gray-400">Tampil di halaman beranda</p>
              </div>
            </label>
          </div>
          <button type="button" id="btn-simpan-mobil"
                  class="w-full bg-red-600 text-white font-bold uppercase text-xs
                         tracking-wider py-3.5 rounded-xl hover:bg-red-700 transition-colors
                         flex items-center justify-center gap-2">
            <span id="btn-simpan-text">Simpan & Lanjut Upload Foto</span>
            <svg id="btn-simpan-spinner" class="hidden w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
          </button>
          <a href="{{ route('admin.cars.index') }}"
             class="block text-center text-sm text-gray-400 hover:text-gray-700 py-2.5 mt-2 transition-colors">
            Batal
          </a>
        </div>

        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
          <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
              <p class="text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">Alur Upload</p>
              <p class="text-xs text-amber-600 leading-relaxed">
                Isi data mobil terlebih dahulu, lalu klik simpan. Form upload foto akan muncul otomatis di bawah.
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>

{{-- STEP 2: UPLOAD FOTO (hidden dulu) --}}
<div id="step2" class="hidden mt-8">

  {{-- Success notice --}}
  <div class="bg-green-50 border border-green-200 rounded-2xl p-4 mb-6 flex items-center gap-3">
    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <p class="text-sm text-green-700 font-semibold">
      Mobil berhasil disimpan! Sekarang upload foto di bawah ini.
    </p>
    <a id="link-lihat-mobil" href="#" target="_blank"
       class="ml-auto text-xs text-green-600 font-bold hover:underline flex-shrink-0">
      Lihat di Website →
    </a>
  </div>

  <div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">

      {{-- FOTO PER WARNA --}}
      <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" id="foto-warna-container">
        <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100 mb-5">
          Foto Per Warna
        </h3>
        <p class="text-xs text-gray-400 mb-4">
          Upload foto mobil untuk setiap warna. Foto ini yang akan tampil saat pengunjung memilih warna.
        </p>
        <div id="warna-upload-list" class="space-y-4">
          {{-- Diisi via JavaScript --}}
        </div>
      </div>

      {{-- FOTO 360° --}}
      <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100 mb-4">
          Foto 360° <span class="text-gray-300 font-normal normal-case text-xs ml-1">(8 foto diperlukan)</span>
        </h3>
        <p class="text-xs text-gray-400 mb-4">
          Upload tepat 8 foto berurutan untuk tampilan 360 derajat.
        </p>
        <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-red-300 transition-colors">
          <input type="file" id="foto360-input" multiple accept="image/*"
                 class="text-sm text-gray-500
                        file:mr-3 file:py-2 file:px-4 file:border-0 file:rounded-lg
                        file:text-xs file:font-semibold file:uppercase
                        file:bg-gray-900 file:text-white hover:file:bg-gray-700 cursor-pointer">
        </div>
        <button type="button" id="btn-upload-360"
                class="mt-3 w-full bg-gray-900 text-white font-bold uppercase text-xs
                       tracking-wider py-3 rounded-xl hover:bg-gray-700 transition-colors">
          Upload 360°
        </button>
        <div id="result-360" class="mt-3 hidden">
          <p class="text-xs text-green-600 font-semibold">360° berhasil diupload!</p>
        </div>
      </div>

      {{-- FOTO PENYERAHAN UNIT --}}
      <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100 mb-4">
          Foto Penyerahan Unit
        </h3>
        <p class="text-xs text-gray-400 mb-4">
          Upload foto momen penyerahan unit ke customer. Tampil di bagian galeri halaman detail.
        </p>
        <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-red-300 transition-colors">
          <input type="file" id="foto-galeri-input" multiple accept="image/*"
                 class="text-sm text-gray-500
                        file:mr-3 file:py-2 file:px-4 file:border-0 file:rounded-lg
                        file:text-xs file:font-semibold file:uppercase
                        file:bg-gray-900 file:text-white hover:file:bg-gray-700 cursor-pointer">
        </div>
        <button type="button" id="btn-upload-galeri"
                class="mt-3 w-full bg-gray-900 text-white font-bold uppercase text-xs
                       tracking-wider py-3 rounded-xl hover:bg-gray-700 transition-colors">
          Upload Foto Penyerahan
        </button>
        <div id="result-galeri" class="mt-3 hidden">
          <p class="text-xs text-green-600 font-semibold">Foto berhasil diupload!</p>
        </div>
      </div>

    </div>

    {{-- SIDEBAR STEP 2 --}}
    <div class="space-y-5">
      <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <h3 class="font-bold text-sm uppercase tracking-widest text-gray-400 pb-3 border-b border-gray-100 mb-4">
          Selesai
        </h3>
        <p class="text-xs text-gray-400 mb-4">
          Upload foto sudah selesai? Klik tombol di bawah untuk ke halaman edit atau lihat daftar mobil.
        </p>
        <a id="btn-ke-edit" href="#"
           class="block w-full text-center bg-red-600 text-white font-bold uppercase text-xs
                  tracking-wider py-3.5 rounded-xl hover:bg-red-700 transition-colors mb-2">
          Lanjut ke Edit Mobil
        </a>
        <a href="{{ route('admin.cars.index') }}"
           class="block text-center text-sm text-gray-400 hover:text-gray-700 py-2 transition-colors">
          Kembali ke Daftar Mobil
        </a>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
let savedCarId  = null;
let savedCarSlug = null;
let warnaList   = [];

// Simpan data mobil via AJAX
document.getElementById('btn-simpan-mobil').addEventListener('click', async function() {
  const form    = document.getElementById('form-car');
  const fd      = new FormData(form);
  const btn     = this;
  const text    = document.getElementById('btn-simpan-text');
  const spinner = document.getElementById('btn-simpan-spinner');

  btn.disabled    = true;
  text.textContent = 'Menyimpan...';
  spinner.classList.remove('hidden');

  try {
    const res  = await fetch('{{ route('admin.cars.store.ajax') }}', {
      method: 'POST',
      body: fd,
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
    });
    const data = await res.json();

    if (data.success) {
      savedCarId   = data.car_id;
      savedCarSlug = data.slug;

      // Update links
      document.getElementById('btn-ke-edit').href      = '/admin/cars/' + savedCarId + '/edit';
      document.getElementById('link-lihat-mobil').href = '/mobil/' + savedCarSlug;

      // Ambil warna dari form
      warnaList = [];
      const warnaNames = form.querySelectorAll('input[name^="warna["][name$="[nama]"]');
      warnaNames.forEach(input => {
        if (input.value.trim()) warnaList.push(input.value.trim());
      });

      // Build warna upload UI
      buildWarnaUpload();

      // Update step indicator
      document.getElementById('step1-circle').classList.replace('bg-red-600', 'bg-green-600');
      document.getElementById('step2-circle').classList.replace('bg-gray-200', 'bg-red-600');
      document.getElementById('step2-circle').classList.replace('text-gray-400', 'text-white');
      document.getElementById('step2-label').classList.replace('text-gray-400', 'text-gray-700');
      document.getElementById('step2-label').classList.add('font-semibold');

      // Show step 2
      document.getElementById('step1').classList.add('hidden');
      document.getElementById('step2').classList.remove('hidden');
      window.scrollTo({ top: 0, behavior: 'smooth' });

    } else {
      alert('Gagal menyimpan. Periksa kembali data yang diisi.');
      btn.disabled    = false;
      text.textContent = 'Simpan & Lanjut Upload Foto';
      spinner.classList.add('hidden');
    }
  } catch(e) {
    alert('Terjadi kesalahan: ' + e.message);
    btn.disabled    = false;
    text.textContent = 'Simpan & Lanjut Upload Foto';
    spinner.classList.add('hidden');
  }
});

// Build warna upload UI
function buildWarnaUpload() {
  const container = document.getElementById('warna-upload-list');
  container.innerHTML = '';

  if (warnaList.length === 0) {
    container.innerHTML = '<p class="text-xs text-gray-400">Tidak ada warna yang ditambahkan.</p>';
    return;
  }

  warnaList.forEach((warna, i) => {
    container.innerHTML += `
      <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
        <p class="text-sm font-bold text-gray-700 mb-3">${warna}</p>
        <div class="flex gap-3">
          <input type="file" multiple accept="image/*"
                 id="warna-file-${i}"
                 class="flex-1 text-xs text-gray-500
                        file:mr-2 file:py-1.5 file:px-3 file:border-0 file:rounded-lg
                        file:text-xs file:font-semibold file:bg-gray-900 file:text-white
                        hover:file:bg-gray-700 cursor-pointer">
          <button type="button" onclick="uploadFotoWarna(${i}, '${warna}')"
                  id="btn-warna-${i}"
                  class="flex-shrink-0 bg-red-600 text-white font-bold text-xs
                         uppercase px-4 py-1.5 rounded-lg hover:bg-red-700 transition-colors">
            Upload
          </button>
        </div>
        <div id="result-warna-${i}" class="mt-2 hidden">
          <p class="text-xs text-green-600 font-semibold">Berhasil diupload!</p>
        </div>
      </div>
    `;
  });
}

// Upload foto per warna
async function uploadFotoWarna(index, warna) {
  const input = document.getElementById('warna-file-' + index);
  const btn   = document.getElementById('btn-warna-' + index);
  const files = input.files;

  if (!files.length) { alert('Pilih foto dulu!'); return; }

  btn.textContent = '...';
  btn.disabled    = true;

  const fd = new FormData();
  Array.from(files).forEach(f => fd.append('images[]', f));
  fd.append('tipe_gambar', 'galeri');
  fd.append('warna_nama',  warna);
  fd.append('_token',      document.querySelector('meta[name=csrf-token]').content);

  try {
    const res  = await fetch('/admin/cars/' + savedCarId + '/images', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      btn.textContent = 'OK';
      btn.classList.replace('bg-red-600', 'bg-green-600');
      document.getElementById('result-warna-' + index).classList.remove('hidden');
    }
  } catch(e) {
    btn.textContent = 'Upload';
    btn.disabled    = false;
    alert('Upload gagal!');
  }
}

// Upload 360°
document.getElementById('btn-upload-360').addEventListener('click', async function() {
  const input = document.getElementById('foto360-input');
  const btn   = this;
  if (!input.files.length) { alert('Pilih foto 360° dulu!'); return; }

  btn.textContent = 'Uploading...';
  btn.disabled    = true;

  const fd = new FormData();
  Array.from(input.files).forEach(f => fd.append('images[]', f));
  fd.append('tipe_gambar', '360_degree');
  fd.append('_token',      document.querySelector('meta[name=csrf-token]').content);

  try {
    const res  = await fetch('/admin/cars/' + savedCarId + '/images', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      btn.textContent = 'Berhasil!';
      btn.classList.replace('bg-gray-900', 'bg-green-600');
      document.getElementById('result-360').classList.remove('hidden');
    }
  } catch(e) {
    btn.textContent = 'Upload 360°';
    btn.disabled    = false;
    alert('Upload gagal!');
  }
});

// Upload galeri penyerahan
document.getElementById('btn-upload-galeri').addEventListener('click', async function() {
  const input = document.getElementById('foto-galeri-input');
  const btn   = this;
  if (!input.files.length) { alert('Pilih foto dulu!'); return; }

  btn.textContent = 'Uploading...';
  btn.disabled    = true;

  const fd = new FormData();
  Array.from(input.files).forEach(f => fd.append('images[]', f));
  fd.append('tipe_gambar', 'galeri');
  fd.append('_token',      document.querySelector('meta[name=csrf-token]').content);

  try {
    const res  = await fetch('/admin/cars/' + savedCarId + '/images', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      btn.textContent = 'Berhasil!';
      btn.classList.replace('bg-gray-900', 'bg-green-600');
      document.getElementById('result-galeri').classList.remove('hidden');
    }
  } catch(e) {
    btn.textContent = 'Upload Foto';
    btn.disabled    = false;
    alert('Upload gagal!');
  }
});
</script>
@endpush

@endsection

@extends('layouts.admin')
@section('title', 'Edit Kontak – ' . $contact->nama_sales)

@section('admin_content')

<div class="mb-6">
  <a href="{{ route('admin.contacts.index') }}"
     class="text-sm text-gray-400 hover:text-gray-700 transition-colors">
    &larr; Kembali ke Daftar Kontak
  </a>
</div>

<div class="max-w-2xl">
  <form method="POST" action="{{ route('admin.contacts.update', $contact) }}">
    @csrf
    @method('PUT')

    <div class="bg-white p-6 shadow-sm space-y-4">
      <h3 class="font-bold text-sm uppercase tracking-wide border-b border-gray-100 pb-3">
        Informasi Sales
      </h3>

      <div>
        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
          Nama Sales *
        </label>
        <input type="text" name="nama_sales" required
               value="{{ old('nama_sales', $contact->nama_sales) }}"
               class="w-full border border-gray-200 px-4 py-2.5 text-sm
                      focus:outline-none focus:border-red-600 transition-colors">
      </div>

      <div>
        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
          Wilayah *
        </label>
        <select name="wilayah" required
                class="w-full border border-gray-200 px-4 py-2.5 text-sm
                       focus:outline-none focus:border-red-600">
          @foreach(['Utara','Selatan','Barat','Timur','Pusat'] as $w)
          <option value="{{ $w }}"
                  {{ old('wilayah', $contact->wilayah) === $w ? 'selected' : '' }}>
            {{ $w }}
          </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
          Nomor WhatsApp *
        </label>
        <input type="text" name="nomor_wa" required
               value="{{ old('nomor_wa', $contact->nomor_wa) }}"
               class="w-full border border-gray-200 px-4 py-2.5 text-sm
                      focus:outline-none focus:border-red-600 transition-colors">
        <p class="text-xs text-gray-400 mt-1">
          Format internasional tanpa tanda +. Contoh: 6281234567890
        </p>
      </div>

      <div>
        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">
          Pesan Default WhatsApp
        </label>
        <textarea name="pesan_default" rows="3"
                  class="w-full border border-gray-200 px-4 py-2.5 text-sm
                         focus:outline-none focus:border-red-600 transition-colors resize-none">{{ old('pesan_default', $contact->pesan_default) }}</textarea>
        <p class="text-xs text-gray-400 mt-1">
          Pesan ini akan otomatis terisi saat customer klik tombol WhatsApp.
        </p>
      </div>

      <div>
        <label class="flex items-center gap-3 cursor-pointer">
          <input type="checkbox" name="is_active" value="1"
                 {{ old('is_active', $contact->is_active) ? 'checked' : '' }}
                 class="w-4 h-4 accent-red-600">
          <div>
            <p class="text-sm font-medium text-gray-900">Aktif</p>
            <p class="text-xs text-gray-400">Tampil di popup WhatsApp website</p>
          </div>
        </label>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit"
                class="bg-red-600 text-white font-semibold uppercase text-sm
                       tracking-wide px-6 py-3 hover:bg-red-700 transition-colors">
          Simpan Perubahan
        </button>
        <a href="{{ route('admin.contacts.index') }}"
           class="border border-gray-200 text-gray-500 font-semibold uppercase
                  text-sm tracking-wide px-6 py-3 hover:bg-gray-50 transition-colors">
          Batal
        </a>
      </div>

    </div>

  </form>

  {{-- HAPUS --}}
  <div class="bg-white p-6 shadow-sm mt-5">
    <h3 class="font-bold text-sm uppercase tracking-wide text-red-600 border-b border-gray-100 pb-3 mb-4">
      Hapus Kontak
    </h3>
    <p class="text-xs text-gray-400 mb-4">
      Kontak yang dihapus tidak dapat dikembalikan.
    </p>
    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
          onsubmit="return confirm('Hapus kontak ini secara permanen?')">
      @csrf
      @method('DELETE')
      <button type="submit"
              class="border-2 border-red-600 text-red-600 font-semibold
                     uppercase text-xs tracking-wide px-6 py-2.5
                     hover:bg-red-600 hover:text-white transition-colors">
        Hapus Kontak Ini
      </button>
    </form>
  </div>

</div>

@endsection
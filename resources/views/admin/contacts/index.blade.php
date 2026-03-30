@extends('layouts.admin')
@section('title', 'Kontak Sales')

@section('admin_content')

<div class="flex items-center justify-between mb-6">
  <p class="text-gray-500 text-sm">Total: <strong class="text-gray-900">{{ $contacts->count() }}</strong> sales</p>
  <a href="{{ route('admin.contacts.create') }}"
     class="bg-red-600 text-white font-semibold text-sm uppercase tracking-wide
            px-5 py-2.5 hover:bg-red-700 transition-colors">
    + Tambah Kontak
  </a>
</div>

<div class="bg-white shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-gray-50 border-b border-gray-200">
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Nama Sales</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs hidden md:table-cell">Wilayah</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs hidden md:table-cell">Nomor WA</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Status</th>
        <th class="text-left px-6 py-3 font-semibold text-gray-500 uppercase tracking-wide text-xs">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @forelse($contacts as $contact)
      <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-6 py-4">
          <p class="font-semibold text-gray-900">{{ $contact->nama_sales }}</p>
        </td>
        <td class="px-6 py-4 hidden md:table-cell">
          <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-2 py-1 uppercase">
            {{ $contact->wilayah }}
          </span>
        </td>
        <td class="px-6 py-4 hidden md:table-cell text-gray-500 font-mono text-xs">
          {{ $contact->nomor_wa }}
        </td>
        <td class="px-6 py-4">
          <span class="text-xs px-2 py-0.5
                       {{ $contact->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
            {{ $contact->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>
        <td class="px-6 py-4">
          <div class="flex items-center gap-3">
            <a href="{{ route('admin.contacts.edit', $contact) }}"
               class="text-xs text-red-600 hover:underline font-semibold">
              Edit
            </a>
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                  onsubmit="return confirm('Hapus kontak ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="text-xs text-gray-400 hover:text-red-600 font-semibold transition-colors">
                Hapus
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
          Belum ada data kontak sales.
          <a href="{{ route('admin.contacts.create') }}" class="text-red-600 hover:underline ml-1">Tambah sekarang</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection
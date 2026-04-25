@extends('layouts.admin')
@section('title', 'Kontak Sales')

@section('admin_content')

{{-- HEADER --}}
<div class="flex items-end justify-between mb-8">
  <div>
    <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Manajemen</p>
    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Kontak Sales</h2>
    <p class="text-sm text-gray-400 mt-1">{{ $contacts->count() }} sales terdaftar</p>
  </div>
  <a href="{{ route('admin.contacts.create') }}"
     class="inline-flex items-center gap-2 bg-red-600 text-white font-bold
            uppercase text-xs tracking-wider px-5 py-3
            hover:bg-red-700 transition-colors">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>
    Tambah Kontak
  </a>
</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full">
    <thead>
      <tr class="border-b border-gray-100 bg-gray-50">
        <th class="text-left px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
          Sales
        </th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">
          Wilayah
        </th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">
          Nomor WA
        </th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">
          Status
        </th>
        <th class="text-right px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
          Aksi
        </th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      @forelse($contacts as $contact)
      <tr class="hover:bg-gray-50/70 transition-colors group">

        {{-- Sales --}}
        <td class="px-6 py-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center
                        justify-center flex-shrink-0">
              <span class="text-white font-bold text-sm">
                {{ strtoupper(substr($contact->nama_sales, 0, 1)) }}
              </span>
            </div>
            <div>
              <p class="font-bold text-sm text-gray-900 group-hover:text-red-600
                        transition-colors">{{ $contact->nama_sales }}</p>
              <p class="text-xs text-gray-400 mt-0.5 md:hidden">
                {{ $contact->wilayah }}
              </p>
            </div>
          </div>
        </td>

        {{-- Wilayah --}}
        <td class="px-4 py-4 hidden md:table-cell">
          <span class="text-xs font-bold text-gray-600 bg-gray-100 px-2.5 py-1 rounded-full uppercase">
            {{ $contact->wilayah }}
          </span>
        </td>

        {{-- Nomor WA --}}
        <td class="px-4 py-4 hidden md:table-cell">
          <a href="https://wa.me/{{ $contact->nomor_wa }}" target="_blank"
             class="inline-flex items-center gap-1.5 text-sm text-gray-700
                    font-medium hover:text-green-600 transition-colors group/wa">
            <svg class="w-3.5 h-3.5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            {{ $contact->nomor_wa }}
          </a>
        </td>

        {{-- Status --}}
        <td class="px-4 py-4 hidden md:table-cell">
          <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                       {{ $contact->is_active
                         ? 'bg-green-50 text-green-700'
                         : 'bg-gray-100 text-gray-400' }}">
            {{ $contact->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>

        {{-- Aksi --}}
        <td class="px-6 py-4">
          <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.contacts.edit', $contact) }}"
               class="text-xs font-bold text-red-600 hover:text-red-700 transition-colors">
              Edit
            </a>
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                  onsubmit="return confirm('Hapus kontak ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="text-xs font-semibold text-gray-400 hover:text-red-600 transition-colors">
                Hapus
              </button>
            </form>
          </div>
        </td>

      </tr>
      @empty
      <tr>
        <td colspan="5" class="px-6 py-16 text-center">
          <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
          <p class="text-gray-400 text-sm mb-3">Belum ada data kontak sales.</p>
          <a href="{{ route('admin.contacts.create') }}"
             class="text-xs text-red-600 font-bold hover:underline">
            Tambah kontak pertama
          </a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection

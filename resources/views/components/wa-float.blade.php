<div
  x-data="{
    open: false,
    contacts: [],
    loading: false,

    async fetchContacts() {
      if (this.contacts.length) { this.open = !this.open; return; }
      this.loading = true;
      this.open = true;
      try {
        const res = await fetch('/api/sales-contacts');
        this.contacts = await res.json();
      } catch(e) { console.error(e); }
      this.loading = false;
    }
  }"
  class="fixed bottom-6 right-4 sm:right-6 z-50 flex flex-col items-end gap-4"
>
  {{-- Popup --}}
  <div
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    @click.outside="open = false"
    class="bg-white rounded-[1.5rem] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-slate-100 p-5 w-[22rem] mb-2"
  >
    {{-- Header Popup --}}
    <div class="flex items-start justify-between mb-5">
      <div>
        <p class="font-bold text-sm text-red-600 uppercase tracking-widest mb-1">Hubungi Sales</p>
        <p class="text-xl font-bold text-slate-900 leading-tight">Pilih Tim Kami</p>
        <p class="text-sm text-slate-500 mt-1">Siap membantu konsultasi pembelian Anda.</p>
      </div>
      <button @click="open = false"
              class="w-8 h-8 rounded-full bg-slate-50 hover:bg-slate-100 hover:text-red-500
                     flex items-center justify-center text-slate-400 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
      </button>
    </div>

    {{-- Loading State --}}
    <div x-show="loading" class="flex flex-col items-center justify-center py-8">
      <div class="w-8 h-8 border-4 border-red-100 border-t-red-600 rounded-full animate-spin mb-3"></div>
      <span class="text-sm font-medium text-slate-500">Memuat kontak...</span>
    </div>

    {{-- Daftar Sales --}}
    <div x-show="!loading" class="space-y-3">
      <template x-if="contacts.length === 0 && !loading">
        <div class="text-center py-6 bg-slate-50 rounded-xl border border-slate-100">
           <p class="text-sm text-slate-500">Belum ada kontak sales yang tersedia.</p>
        </div>
      </template>

      {{-- Looping Kontak --}}
      <template x-for="contact in contacts" :key="contact.id">
        {{-- DI SINI PERBAIKANNYA: Tag <a> pembuka yang sebelumnya hilang --}}
        <a 
          :href="contact.wa_link"
          target="_blank"
          rel="noopener"
          class="flex items-center gap-4 p-3 rounded-xl border border-slate-100 bg-white
                 hover:border-green-500 hover:shadow-md hover:-translate-y-0.5
                 transition-all duration-300 group"
        >
          {{-- Avatar / Inisial --}}
          <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-700 group-hover:bg-red-600 group-hover:text-white
                      flex items-center justify-center text-lg font-bold flex-shrink-0 transition-colors">
            <span x-text="contact.nama_sales.charAt(0)"></span>
          </div>
          
          {{-- Info Sales --}}
          <div class="flex-1 min-w-0">
            <p class="font-bold text-sm text-slate-900 truncate group-hover:text-red-600 transition-colors" x-text="contact.nama_sales"></p>
            <p class="text-xs font-medium text-slate-500 mt-0.5" x-text="'Wilayah ' + contact.wilayah"></p>
          </div>

          {{-- Icon WA --}}
          <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center group-hover:bg-green-500 transition-colors flex-shrink-0">
            <svg class="w-5 h-5 text-green-500 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
              <path d="M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652a12.062 12.062 0 005.71 1.447h.006c6.585 0 11.946-5.336 11.949-11.896 0-3.176-1.24-6.165-3.48-8.45z"/>
            </svg>
          </div>
        </a>
      </template>
      
      {{-- Footer Popup --}}
      <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-center gap-1.5">
        <span class="relative flex h-2.5 w-2.5">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
        </span>
        <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">
          Respon Cepat via WhatsApp
        </p>
      </div>
    </div>
  </div>

  {{-- Tombol WA Mengambang (Dipercantik) --}}
  <button
    @click="fetchContacts()"
    class="w-14 h-14 sm:w-[4.25rem] sm:h-[4.25rem] rounded-full bg-green-500 shadow-[0_8px_30px_rgba(34,197,94,0.4)]
           flex items-center justify-center relative group
           hover:scale-110 active:scale-95 transition-all duration-300"
    aria-label="Hubungi via WhatsApp"
  >
    <span class="absolute inset-0 rounded-full bg-green-400 animate-ping opacity-20"></span>
    <svg class="w-7 h-7 sm:w-8 sm:h-8 fill-white relative z-10 transform group-hover:-rotate-12 transition-transform duration-300" viewBox="0 0 24 24">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
      <path d="M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652a12.062 12.062 0 005.71 1.447h.006c6.585 0 11.946-5.336 11.949-11.896 0-3.176-1.24-6.165-3.48-8.45z"/>
    </svg>
  </button>
</div>
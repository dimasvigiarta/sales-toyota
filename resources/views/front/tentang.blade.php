@extends('layouts.app')
@section('title', 'Tentang Kami – Rama Toyota Jember')

@section('content')
<div class="pt-16 lg:pt-20 bg-slate-50">

 {{-- HEADER: Konsep "The Real Dealership" dengan Tipografi Profesional --}}
  <div class="relative bg-slate-900 py-20 md:py-24 lg:py-32 overflow-hidden">
    
    {{-- Background Image --}}
    <div class="absolute inset-0">
      <img src="{{ asset('images/tentangkami.png') }}" 
           alt="Gedung Rama Toyota Jember Resmi" 
           class="w-full h-full object-cover object-center" />
    </div>

    {{-- Dark Overlay: Menjaga kontras agar teks mudah dibaca --}}
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/80 to-slate-950/40"></div>
    <div class="absolute inset-0 bg-black/20"></div>

    {{-- Konten Teks --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      {{-- Membatasi lebar kontainer teks agar kalimatnya memotong (wrap) dengan cantik --}}
      <div class="max-w-2xl lg:max-w-3xl"> 
        
        {{-- Label Profil Perusahaan --}}
        <div class="flex items-center gap-3 mb-4 md:mb-5">
          <div class="w-8 h-0.5 bg-red-600"></div>
          <p class="text-red-500 font-bold text-xs md:text-sm uppercase tracking-[0.2em]">
            Profil Perusahaan
          </p>
        </div>
        
        {{-- Judul Utama: Ukuran diperkecil (3xl s/d 5xl) & pakai font-bold agar lebih rapi --}}
        <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-white tracking-tight leading-snug mb-4 md:mb-6 drop-shadow-md">
          Melayani Perjalanan Keluarga Jember Sejak 2010.
        </h1>
        
        {{-- Deskripsi: Ukuran teks disesuaikan agar seimbang dengan judul --}}
        <p class="text-slate-200 text-sm md:text-base lg:text-lg leading-relaxed font-normal max-w-xl drop-shadow">
          Rama Toyota hadir lebih dari sekadar dealer resmi. Kami adalah mitra perjalanan yang berkomitmen menghadirkan produk berkualitas, layanan purnajual prima, dan pengalaman memiliki kendaraan yang tanpa rasa khawatir.
        </p>
      </div>
    </div>
  </div>

 {{-- PROFIL: Clean, Professional & Mobile-First Design --}}
  <section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      {{-- flex-col untuk Mobile (Teks di atas, Kotak di bawah), lg:flex-row untuk Laptop --}}
      <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-center">
        
        {{-- KOLOM KIRI: Teks --}}
        <div class="w-full lg:w-1/2">
          
          {{-- PENGGANTI GARIS MERAH: Pill Badge Modern --}}
          <div class="inline-flex items-center rounded-full bg-red-50 px-4 py-1.5 mb-6 border border-red-100">
            <span class="text-xs sm:text-sm font-bold text-red-600 tracking-wide uppercase">
              Tentang Kami
            </span>
          </div>
          
          {{-- Judul: Ukuran dioptimalkan untuk layar HP (3xl) dan membesar di Laptop (5xl) --}}
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 tracking-tight leading-[1.2] mb-6">
            Mitra Resmi Toyota di Jember.
          </h2>
          
          {{-- Paragraf: Jarak baris lega agar mudah dibaca di HP --}}
          <div class="space-y-4 text-slate-600 text-sm sm:text-base leading-relaxed">
            <p class="font-medium text-slate-800">
              Sejak tahun 2010, Rama Toyota Jember telah menjadi destinasi utama bagi keluarga dan bisnis untuk menemukan kendaraan impian mereka.
            </p>
            <p>
              Kami tidak sekadar menjual mobil, tetapi memberikan pengalaman kepemilikan yang tenang. Mulai dari pilihan MPV hingga SUV terbaru, tim profesional kami siap mendampingi perjalanan Anda dengan layanan purnajual dan bengkel resmi yang terjamin.
            </p>
          </div>
        </div>

        {{-- KOLOM KANAN: Statistik (Grid 2x2 yang Rapi di Mobile) --}}
        <div class="w-full lg:w-1/2">
          {{-- gap-3 di HP agar tidak terlalu renggang, gap-6 di Laptop --}}
          <div class="grid grid-cols-2 gap-3 sm:gap-6">
            
            {{-- Card 1 --}}
            <div class="bg-slate-50/70 rounded-2xl p-5 md:p-8 border border-slate-100 hover:border-red-100 hover:bg-red-50/30 transition-colors duration-300">
              <p class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-1 sm:mb-2">
                14<span class="text-red-600">+</span>
              </p>
              <p class="text-[10px] sm:text-xs md:text-sm text-slate-500 font-semibold uppercase tracking-wider">
                Tahun Melayani
              </p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-slate-50/70 rounded-2xl p-5 md:p-8 border border-slate-100 hover:border-red-100 hover:bg-red-50/30 transition-colors duration-300">
              <p class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-1 sm:mb-2">
                5k<span class="text-red-600">+</span>
              </p>
              <p class="text-[10px] sm:text-xs md:text-sm text-slate-500 font-semibold uppercase tracking-wider">
                Pelanggan Puas
              </p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-slate-50/70 rounded-2xl p-5 md:p-8 border border-slate-100 hover:border-red-100 hover:bg-red-50/30 transition-colors duration-300">
              <p class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-1 sm:mb-2">
                50<span class="text-red-600">+</span>
              </p>
              <p class="text-[10px] sm:text-xs md:text-sm text-slate-500 font-semibold uppercase tracking-wider">
                Model Tersedia
              </p>
            </div>

            {{-- Card 4 --}}
            <div class="bg-slate-50/70 rounded-2xl p-5 md:p-8 border border-slate-100 hover:border-red-100 hover:bg-red-50/30 transition-colors duration-300">
              <p class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-1 sm:mb-2">
                3
              </p>
              <p class="text-[10px] sm:text-xs md:text-sm text-slate-500 font-semibold uppercase tracking-wider">
                Layanan Utama
              </p>
            </div>

          </div>
        </div>
        
      </div>
    </div>
  </section>

{{-- KEUNGGULAN KAMI: Modern Grid dengan Interaksi Halus --}}
  <section class="py-16 md:py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      {{-- Header Section --}}
      <div class="text-center max-w-2xl mx-auto mb-16">
        <div class="inline-flex items-center rounded-full bg-red-50 px-4 py-1.5 mb-4 border border-red-100">
          <span class="text-xs sm:text-sm font-bold text-red-600 tracking-wide uppercase">
            Mengapa Memilih Kami
          </span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mb-4">
          Keunggulan Pelayanan Rama Toyota
        </h2>
        <p class="text-slate-600 text-sm md:text-base">
          Lebih dari sekadar transaksi, kami menawarkan pengalaman memiliki kendaraan yang tenang, aman, dan menguntungkan.
        </p>
      </div>

      {{-- Grid 8 Keunggulan: 1 Kolom (Mobile), 2 Kolom (Tablet), 4 Kolom (Laptop) --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        
        @php
          $keunggulan = [
            ['title' => 'Harga Transparan', 'desc' => 'Dapatkan penawaran harga OTR dan diskon jujur tanpa biaya tersembunyi.', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['title' => 'Test Drive Gratis', 'desc' => 'Coba langsung performa mobil impian Anda sebelum membuat keputusan.', 'icon' => 'M3 13l1-4a2 2 0 0 1 2-1.5h8a2 2 0 0 1 2 1.5l1 4M5 13h10M6 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM5 13v2a1 1 0 0 0 1 1h1m8-3v2a1 1 0 0 1-1 1h-1'],
            ['title' => 'Proses Cepat', 'desc' => 'Pengajuan kredit dan proses administrasi kami bantu agar selesai tepat waktu.', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['title' => 'After Sales Prima', 'desc' => 'Layanan bengkel resmi Toyota dengan teknisi handal dan tersertifikasi.', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
            ['title' => 'Garansi Resmi', 'desc' => 'Ketenangan pikiran ekstra dengan garansi resmi langsung dari pabrikan Toyota.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
            ['title' => 'Trade In', 'desc' => 'Tukar tambah mobil lama Anda merek apapun dengan valuasi harga terbaik.', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
            ['title' => 'Delivery Service', 'desc' => 'Unit mobil impian diantar langsung dengan aman hingga ke depan rumah Anda.', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
            ['title' => 'Konsultasi Gratis', 'desc' => 'Tim sales profesional kami siap membantu Anda memilih kendaraan yang tepat.', 'icon' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z']
          ];
        @endphp

        @foreach($keunggulan as $item)
        {{-- Card Item --}}
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-100 group hover:border-red-100 hover:shadow-[0_8px_30px_rgb(220,38,38,0.08)] transition-all duration-300">
          
          {{-- Ikon: Berubah warna saat kotak di-hover --}}
          <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-700 flex items-center justify-center mb-5 group-hover:bg-red-600 group-hover:text-white group-hover:-translate-y-1 transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
          </div>
          
          <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-red-600 transition-colors">
            {{ $item['title'] }}
          </h3>
          <p class="text-slate-500 text-sm leading-relaxed">
            {{ $item['desc'] }}
          </p>
        </div>
        @endforeach

      </div>
    </div>
  </section>

  {{-- VISI MISI: Gaya Corporate Resmi & Profesional --}}
  <section class="py-16 md:py-24 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      {{-- Header Section Resmi --}}
      <div class="text-center mb-14">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 uppercase tracking-tight">
          Visi & Misi
        </h2>
        {{-- Garis Aksen Merah Toyota --}}
        <div class="w-16 h-1 bg-red-600 mx-auto mt-4"></div>
      </div>

      {{-- Grid 2 Kolom Seimbang --}}
      <div class="grid md:grid-cols-2 gap-8 lg:gap-10">
        
        {{-- Card Visi --}}
        <div class="p-8 md:p-10 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
          <div class="flex items-center gap-4 mb-6">
            {{-- Ikon Target (Profesional) --}}
            <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center text-red-600 flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" class="hidden"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Visi Perusahaan</h3>
          </div>
          <p class="text-slate-600 text-base md:text-lg leading-relaxed">
            Menjadi dealer Toyota terpercaya dan terdepan di Jawa Timur yang memberikan pengalaman pembelian kendaraan terbaik dengan pelayanan prima dan integritas tinggi.
          </p>
        </div>

        {{-- Card Misi --}}
        <div class="p-8 md:p-10 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
          <div class="flex items-center gap-4 mb-6">
            {{-- Ikon Checklist (Profesional) --}}
            <div class="w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center text-slate-900 flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Misi Perusahaan</h3>
          </div>
          
          <ul class="space-y-4">
            @foreach([
              'Memberikan pelayanan yang jujur, transparan, dan profesional.',
              'Menyediakan produk Toyota berkualitas dengan harga terbaik.',
              'Membangun hubungan jangka panjang dengan pelanggan.',
              'Mendukung mobilitas keluarga dengan kendaraan handal.',
            ] as $misi)
            <li class="flex items-start gap-3">
              {{-- Centang Merah Standar --}}
              <div class="mt-1 flex-shrink-0 text-red-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
              </div>
              <span class="text-slate-600 text-base leading-relaxed">{{ $misi }}</span>
            </li>
            @endforeach
          </ul>
        </div>
        
      </div>
    </div>
  </section>

  {{-- FASILITAS DEALER --}}
  <section class="py-16 md:py-24 bg-slate-50 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      {{-- Header Section --}}
      <div class="text-center mb-14">
        <p class="text-red-500 font-bold text-sm uppercase tracking-widest mb-3">
          Kenyamanan Anda
        </p>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
          Fasilitas Dealer Kami
        </h2>
        {{-- Garis Aksen Merah --}}
        <div class="w-16 h-1 bg-red-600 mx-auto mt-5 mb-6"></div>
        <p class="text-slate-500 mt-4 text-base md:text-lg max-w-2xl mx-auto">
          Kami memastikan setiap kunjungan Anda, baik untuk proses pembelian maupun perawatan rutin kendaraan, terasa nyaman dan menyenangkan.
        </p>
      </div>

      {{-- Grid Galeri Fasilitas --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Item 1: Showroom --}}
        <div class="group rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-xl transition-all duration-300">
          <div class="relative h-64 overflow-hidden">
            {{-- Ganti URL src di bawah dengan foto asli showroom --}}
            <img src="https://images.unsplash.com/photo-1562426509-5044a121aa49?auto=format&fit=crop&q=80" alt="Showroom Luas" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <h3 class="absolute bottom-5 left-6 text-xl font-bold text-white tracking-wide">Showroom Luas</h3>
          </div>
          <div class="p-6 border-t border-slate-100">
            <p class="text-slate-600 text-sm leading-relaxed">
              Area pameran kendaraan ber-AC yang didesain elegan untuk memudahkan Anda mengeksplorasi unit Toyota impian secara langsung dengan leluasa.
            </p>
          </div>
        </div>

        {{-- Item 2: Ruang Tunggu --}}
        <div class="group rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-xl transition-all duration-300">
          <div class="relative h-64 overflow-hidden">
            {{-- Ganti URL src di bawah dengan foto asli ruang tunggu --}}
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80" alt="Ruang Tunggu VIP" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <h3 class="absolute bottom-5 left-6 text-xl font-bold text-white tracking-wide">Ruang Tunggu VIP</h3>
          </div>
          <div class="p-6 border-t border-slate-100">
            <p class="text-slate-600 text-sm leading-relaxed">
              Fasilitas *lounge* eksklusif yang dilengkapi dengan sofa empuk, koneksi Wi-Fi gratis, serta sajian kopi dan *snack* hangat untuk Anda.
            </p>
          </div>
        </div>

        {{-- Item 3: Bengkel Resmi --}}
        <div class="group rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-xl transition-all duration-300">
          <div class="relative h-64 overflow-hidden">
            {{-- Ganti URL src di bawah dengan foto asli area bengkel --}}
            <img src="https://images.unsplash.com/photo-1613214149922-f1809c99b414?auto=format&fit=crop&q=80" alt="Bengkel Resmi Toyota" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <h3 class="absolute bottom-5 left-6 text-xl font-bold text-white tracking-wide">Bengkel Tersertifikasi</h3>
          </div>
          <div class="p-6 border-t border-slate-100">
            <p class="text-slate-600 text-sm leading-relaxed">
              Area servis bengkel yang selalu bersih, didukung peralatan modern standar Toyota Astra Motor dan mekanik ahli bersertifikat resmi.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>


{{-- TIM SALES: Corporate & Professional Style --}}
  @if($contacts->isNotEmpty())
  {{-- Hanya gunakan satu tag section saja agar jarak tidak ganda/bertumpuk --}}
  <section id="sales" class="py-16 md:py-24 bg-slate-900 border-t border-slate-800 scroll-mt-[70px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      {{-- Header Section Resmi (Konsisten dengan Visi Misi) --}}
      <div class="text-center mb-14">
        <p class="text-red-500 font-bold text-sm uppercase tracking-widest mb-3">
          Tim Kami
        </p>
        <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">
          Sales Representative
        </h2>
        
        {{-- Garis Aksen Merah sudah dihapus --}}
        
        <p class="text-slate-400 mt-6 text-base md:text-lg max-w-2xl mx-auto">
          Hubungi tim representatif kami langsung untuk mendapatkan konsultasi dan penawaran harga terbaik.
        </p>
      </div>

      {{-- Grid Card Sales --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        @foreach($contacts as $contact)
        
        {{-- Card Sales: Solid, Elegan, Tanpa Efek Kaca (Glassmorphism) --}}
        <div class="bg-slate-800 border border-slate-700 p-6 md:p-8 rounded-xl hover:border-slate-500 hover:shadow-lg hover:shadow-black/20 transition-all duration-300 flex flex-col h-full">
          
          <div class="flex items-center gap-5 mb-8">
            {{-- Avatar: Kotak Tegas dengan Sudut Proporsional --}}
            <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center font-bold text-2xl text-white flex-shrink-0 shadow-sm">
              {{ strtoupper(substr($contact->nama_sales, 0, 1)) }}
            </div>
            
            <div>
              <h3 class="font-bold text-xl text-white tracking-tight mb-1.5">
                {{ $contact->nama_sales }}
              </h3>
              {{-- Badge Wilayah: Simple & Bersih --}}
              <span class="inline-flex items-center bg-slate-700 text-slate-300 text-xs px-2.5 py-1 rounded font-medium">
                Wilayah {{ $contact->wilayah }}
              </span>
            </div>
          </div>

          {{-- Tombol WA: Rata Bawah (mt-auto) agar sejajar jika nama sales panjang/pendek --}}
          <div class="mt-auto">
            <a href="{{ $contact->wa_link }}" target="_blank" rel="noopener"
               class="flex items-center justify-center gap-2.5 w-full py-3 
                      bg-[#25D366] hover:bg-[#20bd5a] text-white font-semibold 
                      text-sm rounded-lg transition-colors duration-200">
              <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652a12.062 12.062 0 005.71 1.447h.006c6.585 0 11.946-5.336 11.949-11.896 0-3.176-1.24-6.165-3.48-8.45z"/>
              </svg>
              Hubungi via WhatsApp
            </a>
          </div>

        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

 {{-- LOKASI KAMI: Corporate Style --}}
  <section id="kontak" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
        
        {{-- Kolom Info Lokasi --}}
        <div class="flex flex-col">
          
          {{-- Header Section Resmi (Konsisten dengan atasnya) --}}
          <div class="mb-10">
            <p class="text-red-500 font-bold text-sm uppercase tracking-widest mb-3">
              Kunjungi Kami
            </p>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
              Lokasi Kami
            </h2>
            {{-- Garis Aksen Merah --}}
            <div class="w-16 h-1 bg-red-600 mt-4"></div>
          </div>

          {{-- List Info (Alamat, Telp, Jam) --}}
          <div class="space-y-6">
            
            {{-- Item: Alamat --}}
            <div class="flex items-start gap-4 p-4 rounded-xl border border-transparent hover:border-slate-100 hover:bg-slate-50 transition-colors duration-200">
              <div class="w-12 h-12 bg-red-50 text-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <div class="pt-1">
                <p class="font-bold text-slate-900 mb-1">Alamat Dealer</p>
                <p class="text-slate-600 leading-relaxed text-sm md:text-base">Jl. Ahmad Yani No.1, Jember, Jawa Timur 68121</p>
              </div>
            </div>

            {{-- Item: Telepon --}}
            <div class="flex items-start gap-4 p-4 rounded-xl border border-transparent hover:border-slate-100 hover:bg-slate-50 transition-colors duration-200">
              <div class="w-12 h-12 bg-red-50 text-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
              </div>
              <div class="pt-1">
                <p class="font-bold text-slate-900 mb-1">Telepon & Layanan</p>
                <p class="text-slate-600 text-sm md:text-base">(0331) 123-4567</p>
              </div>
            </div>

            {{-- Item: Jam Operasional --}}
            <div class="flex items-start gap-4 p-4 rounded-xl border border-transparent hover:border-slate-100 hover:bg-slate-50 transition-colors duration-200">
              <div class="w-12 h-12 bg-red-50 text-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <div class="pt-1">
                <p class="font-bold text-slate-900 mb-1">Jam Operasional</p>
                <div class="text-slate-600 text-sm md:text-base space-y-1">
                  <p>Senin – Sabtu: 08.00 – 17.00 WIB</p>
                  <p>Minggu: 09.00 – 15.00 WIB</p>
                </div>
              </div>
            </div>

          </div>
        </div>

        {{-- Kolom Peta (Map) --}}
        <div class="bg-slate-100 rounded-xl overflow-hidden border border-slate-200 shadow-sm h-80 lg:h-[420px] w-full">
          {{-- Catatan: Ganti src iframe di bawah ini dengan link Google Maps embed asli milik dealer --}}
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.423985449556!2d113.700145!3d-8.159985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69435b6b6630b%3A0x6b8bd7c5e5e6b0b0!2sJember%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            class="grayscale-[20%] contrast-100">
          </iframe>
        </div>
        
      </div>
    </div>
  </section>
</div>
@endsection
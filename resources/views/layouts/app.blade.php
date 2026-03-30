<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- SEO Meta Tags yang Dioptimalkan --}}
  <title>@yield('title', 'Dealer Resmi Toyota Jember | Promo & Harga OTR Terbaru 2026')</title>
  <meta name="description" content="@yield('meta_desc', 'Dapatkan penawaran harga OTR termurah, promo diskon DP ringan, dan cicilan mudah untuk semua tipe mobil Toyota di Jember. Hubungi sales Rama Toyota sekarang!')">
  <meta name="keywords" content="toyota jember, promo toyota jember, harga mobil toyota jember, dealer resmi rama toyota jember, sales toyota jember, kredit toyota jember">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans">

  {{-- NAVBAR --}}
    <nav
    x-data="{ open: false, scrolled: false }"
    x-init="
        scrolled = {{ request()->routeIs('home') ? 'false' : 'true' }};
        window.addEventListener('scroll', () => {
        if ({{ request()->routeIs('home') ? 'true' : 'false' }}) {
            scrolled = window.scrollY > 80;
        }
        })
    "
    :class="scrolled ? 'bg-white shadow-sm' : 'bg-transparent'"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500"
    >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
            <img 
            src="{{ asset('images/logo-toyota.png') }}" 
            alt="Logo Toyota" 
            class="w-8 h-8 md:w-10 md:h-10 lg:w-11 lg:h-11 object-contain flex-shrink-0"
            />

            <div class="leading-none">
            <p class="font-black text-sm uppercase tracking-[0.15em] transition-colors"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Rama Toyota
            </p>
            <p class="text-[9px] uppercase tracking-[0.3em] mt-0.5 transition-colors"
                :class="scrolled ? 'text-gray-400' : 'text-white/50'">
                Jember
            </p>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-1">
            @foreach([
            ['route' => 'home',      'label' => 'Beranda',     'match' => 'home'],
            ['route' => 'cars.index','label' => 'Daftar Mobil','match' => 'cars*'],
            ['route' => 'promos.index','label' => 'Promo',     'match' => 'promos*'],
            ['route' => 'tentang',   'label' => 'Tentang Kami','match' => 'tentang'],
            ] as $item)
            <a href="{{ route($item['route']) }}"
            class="relative px-4 py-2 font-semibold text-xs uppercase tracking-[0.12em]
                    transition-all duration-200 group"
            :class="scrolled ? 'text-gray-700 hover:text-red-600' : 'text-white/80 hover:text-white'">
            {{ $item['label'] }}
            {{-- Active indicator --}}
            <span class="absolute bottom-0 left-4 right-4 h-0.5 bg-red-600 transition-all duration-200
                        {{ request()->routeIs($item['match']) ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }}">
            </span>
            </a>
            @endforeach

            <div class="w-px h-5 bg-gray-300 mx-2"></div>

            <a href="{{ route('tentang') }}#sales"
            class="ml-1 bg-red-600 text-white font-bold uppercase text-xs
                    tracking-[0.12em] px-5 py-2.5 rounded-md
                    hover:bg-red-700 transition-colors duration-200">
            Kontak Kami
            </a>
        </div>

        {{-- Mobile Hamburger --}}
        <button @click="open = !open"
                class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 p-2"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
            <span class="block w-5 h-0.5 bg-current transition-all duration-300"
                :class="open ? 'rotate-45 translate-y-2' : ''"></span>
            <span class="block w-5 h-0.5 bg-current transition-all duration-300"
                :class="open ? 'opacity-0' : ''"></span>
            <span class="block w-5 h-0.5 bg-current transition-all duration-300"
                :class="open ? '-rotate-45 -translate-y-2' : ''"></span>
        </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
        @foreach([
            ['route' => 'home',        'label' => 'Beranda',     'match' => 'home'],
            ['route' => 'cars.index',  'label' => 'Daftar Mobil','match' => 'cars*'],
            ['route' => 'promos.index','label' => 'Promo',       'match' => 'promos*'],
            ['route' => 'tentang',     'label' => 'Tentang Kami','match' => 'tentang'],
        ] as $item)
        <a href="{{ route($item['route']) }}"
            class="flex items-center justify-between px-4 py-3 font-semibold text-xs
                    uppercase tracking-[0.12em] transition-colors
                    {{ request()->routeIs($item['match'])
                    ? 'text-red-600 bg-red-50'
                    : 'text-gray-700 hover:text-red-600 hover:bg-gray-50' }}">
            {{ $item['label'] }}
            @if(request()->routeIs($item['match']))
            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
            @endif
        </a>
        @endforeach
        <div class="pt-2">
            <a href="{{ route('tentang') }}#sales"
            class="block text-center bg-red-600 text-white font-bold uppercase
                    text-xs tracking-[0.12em] px-5 py-3
                    hover:bg-red-700 transition-colors">
            Kontak Kami
            </a>
        </div>
        </div>
    </div>
    </nav>

  {{-- CONTENT --}}
  <main>
    @yield('content')
  </main>

  <footer class="bg-gray-900 text-white">

  {{-- Main Footer --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

      {{-- Kolom 1: Brand --}}
      <div class="lg:col-span-1">
        <div class="flex items-center gap-3 mb-5">
        <img 
            src="{{ asset('images/logo-toyota.png') }}" 
            alt="Logo Toyota" 
            class="w-8 h-8 md:w-10 md:h-10 lg:w-11 lg:h-11 object-contain flex-shrink-0"
            />
        
        <div>
            <p class="font-black text-sm uppercase tracking-[0.15em] text-white">Rama Toyota</p>
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mt-0.5">Jember</p>
        </div>
        </div>
        <p class="text-gray-400 text-sm leading-relaxed font-light mb-6">
          Dealer resmi Toyota di Jember. Melayani pembelian kendaraan,
          test drive, dan after-sales sejak 2010.
        </p>
        {{-- Jam Operasional --}}
        <div class="space-y-1.5">
          <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-semibold mb-2">
            Jam Operasional
          </p>
          <p class="text-gray-400 text-xs">Senin – Sabtu: 08.00 – 17.00</p>
          <p class="text-gray-400 text-xs">Minggu: 09.00 – 15.00</p>
        </div>
      </div>

      {{-- Kolom 2: Menu --}}
      <div>
        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-semibold mb-5">
          Menu
        </p>
        <ul class="space-y-3">
          @foreach([
            ['route' => 'home',         'label' => 'Beranda'],
            ['route' => 'cars.index',   'label' => 'Daftar Mobil'],
            ['route' => 'promos.index', 'label' => 'Promo'],
            ['route' => 'tentang',      'label' => 'Tentang Kami'],
          ] as $item)
          <li>
            <a href="{{ route($item['route']) }}"
               class="text-gray-400 text-sm hover:text-white
                      transition-colors duration-200 flex items-center gap-2 group">
              <span class="w-0 group-hover:w-3 h-px bg-red-600
                           transition-all duration-200"></span>
              {{ $item['label'] }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- Kolom 3: Layanan --}}
      <div>
        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-semibold mb-5">
          Layanan
        </p>
        <ul class="space-y-3">
          @foreach([
            'Test Drive Gratis',
            'Simulasi Kredit',
            'Tukar Tambah',
            'After Sales',
            'Book Service',
          ] as $item)
          <li>
            <a href="#"
               class="text-gray-400 text-sm hover:text-white
                      transition-colors duration-200 flex items-center gap-2 group">
              <span class="w-0 group-hover:w-3 h-px bg-red-600
                           transition-all duration-200"></span>
              {{ $item }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- Kolom 4: Kontak --}}
      <div id="kontak">
        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-semibold mb-5">
          Kontak Kami
        </p>
        <ul class="space-y-4">
          <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="text-gray-400 text-sm leading-relaxed">
              Jl. Ahmad Yani No.1,<br>Jember, Jawa Timur 68121
            </span>
          </li>
          <li class="flex items-center gap-3">
            <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <a href="tel:03311234567"
               class="text-gray-400 text-sm hover:text-white transition-colors">
              (0331) 123-4567
            </a>
          </li>
          <li class="flex items-center gap-3">
            <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <a href="mailto:info@ramatoyotajember.com"
               class="text-gray-400 text-sm hover:text-white transition-colors">
              info@ramatoyotajember.com
            </a>
          </li>
        </ul>

        {{-- Sosial Media --}}
        <div class="mt-6 pt-6 border-t border-white/10">
          <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">
            Ikuti Kami
          </p>
          <div class="flex gap-3">
            @foreach([
              ['label' => 'Facebook',  'path' => 'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z'],
              ['label' => 'Instagram', 'path' => 'M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01M6.5 19.5h11a3 3 0 003-3v-11a3 3 0 00-3-3h-11a3 3 0 00-3 3v11a3 3 0 003 3z'],
              ['label' => 'YouTube',   'path' => 'M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z'],
              ['label' => 'TikTok',    'path' => 'M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.76a4.85 4.85 0 01-1.01-.07z'],
            ] as $sosmed)
            <a href="#"
               class="w-8 h-8 border border-white/10 flex items-center justify-center
                      text-gray-500 hover:border-red-600 hover:text-red-500
                      transition-all duration-200"
               aria-label="{{ $sosmed['label'] }}">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="1.5" d="{{ $sosmed['path'] }}"/>
              </svg>
            </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Bottom Bar --}}
  <div class="border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="text-gray-600 text-xs">
          &copy; {{ date('Y') }} Rama Toyota Jember. All rights reserved.
        </p>
        <div class="flex items-center gap-4">
          <a href="#" class="text-gray-600 text-xs hover:text-gray-400 transition-colors">
            Kebijakan Privasi
          </a>
          <span class="text-gray-700">·</span>
          <a href="#" class="text-gray-600 text-xs hover:text-gray-400 transition-colors">
            Syarat & Ketentuan
          </a>
        </div>
      </div>
    </div>
  </div>

</footer>

  {{-- FLOATING WA --}}
  @include('components.wa-float')

  @stack('scripts')

</body>
</html>
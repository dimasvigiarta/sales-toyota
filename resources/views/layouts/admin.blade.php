<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') — Rama Toyota Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

  {{-- SIDEBAR --}}
  <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
         class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900
                transform transition-transform duration-300
                lg:relative lg:translate-x-0 flex flex-col shadow-2xl">

    {{-- Logo --}}
    <div class="p-6 border-b border-white/10">
      <div class="flex items-center gap-3">
        <img 
            src="{{ asset('images/logo-toyota.png') }}" 
            alt="Logo Toyota" 
            class="w-8 h-8 object-contain flex-shrink-0"
            />
        <div>
          <div class="font-bold text-base text-white uppercase tracking-wider leading-none">
            Rama Toyota
          </div>
          <div class="text-gray-400 text-xs mt-0.5">Panel Admin</div>
        </div>
      </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">

      <p class="text-gray-500 text-xs uppercase tracking-widest px-4 py-2 font-semibold">
        Menu Utama
      </p>

      <a href="{{ route('admin.dashboard') }}"
         class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium
                transition-all duration-200 rounded-sm
                {{ request()->routeIs('admin.dashboard')
                   ? 'bg-red-600 text-white'
                   : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span>Dashboard</span>
      </a>

      <a href="{{ route('admin.cars.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium
                transition-all duration-200 rounded-sm
                {{ request()->routeIs('admin.cars*')
                   ? 'bg-red-600 text-white'
                   : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        <span>Manajemen Mobil</span>
        <span class="ml-auto bg-white/10 text-white text-xs px-2 py-0.5 rounded-full">
          {{ \App\Models\Car::count() }}
        </span>
      </a>

      <a href="{{ route('admin.promos.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium
                transition-all duration-200 rounded-sm
                {{ request()->routeIs('admin.promos*')
                   ? 'bg-red-600 text-white'
                   : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 10V5a2 2 0 012-2z"/>
        </svg>
        <span>Manajemen Promo</span>
        <span class="ml-auto bg-white/10 text-white text-xs px-2 py-0.5 rounded-full">
          {{ \App\Models\Promo::active()->count() }}
        </span>
      </a>

      <a href="{{ route('admin.contacts.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium
                transition-all duration-200 rounded-sm
                {{ request()->routeIs('admin.contacts*')
                   ? 'bg-red-600 text-white'
                   : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <span>Kontak Sales</span>
      </a>

    </nav>

    {{-- Bottom --}}
    <div class="p-4 border-t border-white/10 space-y-1">
      <a href="{{ route('home') }}" target="_blank"
         class="flex items-center gap-3 px-4 py-2.5 text-gray-400
                hover:text-white text-sm transition-colors rounded-sm hover:bg-white/5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
        </svg>
        <span>Lihat Website</span>
      </a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
            class="w-full flex items-center gap-3 px-4 py-2.5 text-gray-400
                    hover:text-red-500 text-sm transition-colors rounded-sm hover:bg-white/5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        <span>Logout</span>
    </button>
    </form>
  </aside>

  {{-- Overlay mobile --}}
  <div x-show="sidebarOpen" @click="sidebarOpen = false"
       class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

  {{-- MAIN --}}
  <div class="flex-1 flex flex-col overflow-hidden">

    {{-- TOPBAR --}}
    <header class="bg-white border-b border-gray-200 px-6 py-0 flex items-center gap-4 h-16 flex-shrink-0">
      <button @click="sidebarOpen = !sidebarOpen"
              class="lg:hidden text-gray-500 hover:text-gray-900 p-1">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

      {{-- Breadcrumb --}}
      <div class="flex-1">
        <h1 class="font-bold text-base uppercase text-gray-900 tracking-wide">
          @yield('title', 'Dashboard')
        </h1>
        <p class="text-xs text-gray-400">Rama Toyota Jember — Panel Admin</p>
      </div>

      {{-- User info --}}
      <div class="flex items-center gap-3">
        <div class="text-right hidden sm:block">
          <p class="text-sm font-semibold text-gray-900">Administrator</p>
          <p class="text-xs text-gray-400">rama-toyota.test</p>
        </div>
        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
          <span class="text-white font-bold text-xs">A</span>
        </div>
      </div>
    </header>

    {{-- CONTENT --}}
    <main class="flex-1 overflow-y-auto p-6 bg-gray-50">

      @if(session('success'))
      <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-800
                  px-4 py-3 text-sm flex items-center gap-3">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
      </div>
      @endif

      @if($errors->any())
      <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 text-sm">
        <p class="font-semibold mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside space-y-0.5">
          @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      @yield('admin_content')
    </main>
  </div>
</div>

@stack('scripts')
</body>
</html>